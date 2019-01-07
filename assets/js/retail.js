$(document).ready(function(){

	generateInvoice();

	$('#retailForm #pname').change(function(){
		var id = $(this).val();
		var qty = $('#retailForm .qty').val();
		if(id != 0){
			$.ajax({
				url:'get_product_price',
				method:'post',
				dataType:'json',
				data:{csrf_test_name:csrf_token, id:id},
				success: function(response){
					$('#retailForm #sku').val(response[0].sku);
					$('#retailForm #price').val(response[0].price);
				},
				error:function(xhr){
					console.log(xhr.responseText);
				}
			});
		}
	});

	$('#retailForm #add-to-cart').click(function(event){
		event.preventDefault();
		var id = $('#retailForm #pname').val();
		var qty = $('#retailForm #qty').val();
		var sku = $('#retailForm #sku').val();
		var pname = $('#retailForm #pname option:selected').text();
		var price = $('#retailForm #price').val();
		var stotal = $('#retailForm #stotal').val();

		if(pname == 0){

		}else{
			if(qty == null || qty == 0){
				swal({
                    title: "Warning",
                    text: "Quantity is empty",
                    icon: "warning",
                });
			}else{
				$.ajax({
					method:'post',
					url:'check_stock',
					data:{id:id,csrf_test_name:csrf_token},
					success:function(response){
						if(parseInt(response) < parseInt(qty)){
							swal({
		                        title: "Error",
		                        text: "Stock items is not sufficient",
		                        icon: "error",
		                    });
						}else{
							var row = '<tr><td>'+sku+'</td><td>'+pname+'</td><td>'+price+'</td><td>'+qty+'</td><td>'+stotal+'</td><td><button class="btn btn-sm btn-danger removeItem"><i class="fa fa-remove"></i></button></td></tr>';
							$('#retailTable tbody').append(row);
							calculateTotal();
						}
					},
					error:function(xhr){
						console.log(xhr.responseText);
					}
				});
			}
		}
	});


	$('#retailForm #qty').keyup(function(){
		var qty = $(this).val();
		var price = $('#retailForm #price').val();
		if(price != ""){
			var total = price * qty;
			$('#retailForm #stotal').val(total);
		}
	});

	$('#retailTable tbody').on('click', '.removeItem', function(event){
		event.preventDefault();
		$(this).closest('tr').remove();
		calculateTotal();
	});

	$('#retailForm #cash').keyup(function(){
		var cash = $(this).val();
		var total = $('#retailForm #total').val();
		if(total != ""){
			var change = parseFloat(cash) - parseFloat(total);
			$('#retailForm #change').val(change);
		}
	});
	

	$('#retailForm #check-out').click(function(){
		event.preventDefault();


		var total = parseInt($('#retailForm #total').val());
		var cash = parseInt($('#retailForm #cash').val());
		var change = parseInt($('#retailForm #change').val());
		var values = [];

		if(isNaN(total) || total == 0 || isNaN(cash)  || cash == 0 || change < 0 ){
			swal({
				title:'Warning',
				text:'Please settle the payment first',
				icon:'warning'
			});
		}else{
			$('#retailTable tbody tr').each(function(){
				var invoice = $('#retailForm #invoice').val()
				var cust = $('#retailForm #customer').val();
				var sku = $(this).children('td:nth-child(1)').html();
				var qty = $(this).children('td:nth-child(4)').html();
				var stotal = $(this).children('td:nth-child(5)').html();
				var date = new Date();
				var month;
				var day = date.getDate();
				if((date.getMonth()+1) < 10){
					month = "0"+(date.getMonth()+1);
				}

				if(day < 10){
					day = "0"+date.getDate();
				}

				var currentDate = date.getFullYear()+"-"+month+"-"+day;

				$.ajax({
					method:'post',
					url:'get_product_id',
					data:{sku:sku, csrf_test_name:csrf_token},
					async: false,
					success:function(response){
						values.push({
							"invoice_no":invoice,
							"product_id":response,
							"quantity":qty,
							"subtotal":stotal,
							"customer":cust,
							"purchased_date":currentDate
						});
					},
					error:function(xhr){
						console.log(xhr.responseText);
					}
				});
			});

			
			$.ajax({
				url:'avail_retail',
				method:'post',
				data:{retails:values,csrf_test_name:csrf_token},
				success:function(response){
					if(response == 1 ){
						swal({
							title:'Transaction',
							text:'Transaction completed',
							icon:'success'
						}).then(function(){
							window.location.reload();
						});
					}else{
						swal({
							title:'Error',
							text:'Transaction Failed',
							icon:'error'
						}).then(function(){
							window.location.reload();
						});
					}
				},
				error:function(xhr){
					console.log(xhr.responseText);
				}
			});
		}
	});
});

function calculateTotal(){
	var total = 0;
	$('#retailTable tbody tr').each(function(){
		var value = $(this).children('td:nth-child(5)').html();

		total = total + parseInt(value);
	});
	$('#retailForm #total').val(total);
}

function generateInvoice(){
	var date = new Date();
	var month;
	var day = date.getDate();
	if((date.getMonth()+1) < 10){
		month = "0"+(date.getMonth()+1);
	}

	if(day < 10){
		day = "0"+date.getDate();
	}

	var currentDate = date.getFullYear()+month+day;
	console.log(currentDate);
	$.ajax({
		method:'post',
		url:'get_last_invoice',
		data:{date:currentDate,csrf_test_name:csrf_token},
		success:function(response){
			if(response == "" || response == null){
				$('#retailForm #invoice').val(currentDate+"1");
			}else{
				$('#retailForm #invoice').val(currentDate+(parseInt(response)+1));
			}
		},
		error:function(xhr){
			console.log(xhr.responseText);
		}
	});
}