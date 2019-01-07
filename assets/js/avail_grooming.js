$(document).ready(function(){

	generateInvoice();

	$('#grooming').change(function(){
		var id = $(this).val();
		if(id != 0){
			$.ajax({
				method:'post',
				url:'get_service_data',
				data:{id:id,csrf_test_name:csrf_token},
				dataType:'json',
				success:function(response){
					$('#desc').val(response[0].description);
					$('#price').val(response[0].price);
				},
				error:function(xhr){
					console.log(xhr.responseText);
				}
			});
		}else{
			$('#desc').val('');
			$('#price').val('');
		}
	});

	$('#avail').click(function(e){
		e.preventDefault();
		var id = $('#grooming').val();
		var type = $('#grooming :selected').text();
		var desc = $('#desc').val();
		var price = $('#price').val();

		if(id == 0){
			swal({
				title:'Grooming Type',
				text:'Please select grooming type to avail',
				icon:'warning'
			});
		}else{
			var tr="<tr>";
			tr += '<td>'+id+'</td><td>'+type+'</td><td>'+desc+'</td><td>'+price+'</td><td><button class="btn btn-sm btn-danger removeAvail"><i class="fa fa-remove"></i></button></td></tr>'
			$('#availTable tbody').append(tr);
			totalfee();
		}
	});

	$('#availTable tbody').on('click','.removeAvail',function(){
		$(this).closest('tr').remove();
		totalfee();
	});

	$('#customer').change(function(){
		var cust_id = $(this).val();
		$.ajax({
			method:'post',
			url:'../pets/get_owner_pets',
			data:{id:cust_id,csrf_test_name:csrf_token},
			dataType:'json',
			success:function(response){
				var option = '';
				$.each(response, function(key, value){
					option += '<option value="'+key+'">'+value+'</option>';
				});
				$('#pet').html(option);
			}
		});
	});

	$('#cash').keyup(function(){
		var cash = $(this).val();
		var fee = $('#fee').val();
		if (/\D/g.test(cash))
		{
		    // Filter non-digits from input value.
		    this.value = this.value.replace(/\D/g, '');
		}
		if(cash != "" && fee != ""){
			$('#change').val(parseInt(cash)-parseInt(fee));
		}
	});

	$('#availService').click(function(e){
		e.preventDefault();
		var change = $('#change').val();
		var values = []
		var cust = $('#customer').val();
		var pet = $('#pet').val();
		var groomer = $('#groomer').val();
		var invoice = $('#availForm #invoice').val();
		var date = new Date();
		var month;
		var day = date.getDate();
		if((date.getMonth()+1) < 10){
			month = "0"+(date.getMonth()+1);
		}

		if(day < 10){
			day = "0"+date.getDate();
		}

		var currdate = date.getFullYear()+'-'+month+'-'+day;


		if(cust == 0 && pet == 0){
			swal({
				title:'Service Avail',
				text:'Please Choose customer and pet who avail',
				icon:'warning'
			});
		}else if(change == "" || parseInt(change) < 0){
			swal({
				title:'Valid Amout',
				text:'Please input valid amount',
				icon:'warning'
			});
		}else{
			$('#availTable tbody tr').each(function(){
				values.push({
					'invoice_no':invoice,
					'grooming_id':$(this).children('td:nth-child(1)').html(),
					'owner': cust,
					'pet': pet,
					'groomer':groomer,
					'date_availed':currdate
				})
			});

			$.ajax({
				method:'post',
				url:'avail_grooming',
				data:{service:values, csrf_test_name:csrf_token},
				success:function(response){
					if(response == 1 ){
						swal({
							title:'Avail',
							text:'Avail completed',
							icon:'success'
						}).then(function(){
							window.location.reload();
						});
					}else{
						swal({
							title:'Error',
							text:'Avail Failed',
							icon:'error'
						}).then(function(){
							window.location.reload();
						});
					}
				},
				error:function(xhr){
					console.log(xhr);
				}
			});
		}
	});

});

function totalfee(){
	var total = 0;
	$('#availTable tbody tr').each(function(){
		var value = $(this).children('td:nth-child(4)').html();

		total = total + parseInt(value);
	});
	$('#fee').val(total);
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

	var invoice ="S-"+date.getFullYear()+month+day;
	$.ajax({
		method:'post',
		url:'get_last_invoice',
		data:{invoice:invoice,csrf_test_name:csrf_token},
		success:function(response){
			if(response == "" || response == null){
				$('#availForm #invoice').val(invoice+"1");
			}else{
				$('#availForm #invoice').val(invoice+(parseInt(response)+1));
			}
		},
		error:function(xhr){
			console.log(xhr.responseText);
		}
	});
}
