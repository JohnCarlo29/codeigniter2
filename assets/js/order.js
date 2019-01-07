$(document).ready(function(){

	$('#orderItemsModal').on('hidden.bs.modal', function () {
 		window.location.reload();
	});

	$('#ordersTable').DataTable({
		"processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": 'order_items',
            "type": "POST",
            "data": {csrf_test_name:csrf_token}
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "visible": false, //set not visible
            }
        ]
	});

	$('#orderItemsForm .product').change(function(){
		var id = $(this).val();
		var qty = $('#orderItemsForm .qty').val();
		if(id != 0){
			$.ajax({
				url:'get_product_price',
				method:'post',
				data:{csrf_test_name:csrf_token, id:id},
				dataType:'json',
				success: function(response){
					
					$('#orderItemsForm .price').val(response[0].price);
					$('#orderItemsForm .sku').val(response[0].sku);
					if(qty != ""){
						var total = parseInt(response) * parseInt(qty);
						console.log(total);
						$('#orderItemsForm .total').val(total);
					}
				},
				error:function(xhr){
					console.log(xhr.responseText);
				}
			});
		}
	});


	$('#orderItemsForm .qty').keyup(function(){

		var price = $('#orderItemsForm .price').val();
		var qty = $(this).val();
		var total;
		if(qty != "" && price != ""){
			total = price * qty;
			$('#orderItemsForm .total').val(total);
		}

	});

	$('#updateOrderItemsForm .product').change(function(){
		var id = $(this).val();
		var qty = $('#updateOrderItemsForm .qty').val();
		if(id != 0){
			$.ajax({
				url:'get_product_price',
				method:'post',
				data:{csrf_test_name:csrf_token, id:id},
				success: function(response){
					$('#updateOrderItemsForm .price').val(response);
					if(qty != ""){
						total = response * qty;
						$('#updateOrderItemsForm .total').val(total);
					}
				},
				error:function(xhr){
					console.log(xhr.responseText);
				}
			});
		}
	});


	$('#updateOrderItemsForm .qty').change(function(){
		var price = $('#updateOrderItemsForm .price').val();
		var qty = $(this).val();
		var total;
		if(qty != "" && price != ""){
			total = price * qty;
			$('#updateOrderItemsForm .total').val(total);
		}
	});

	$('#orderItemsForm').submit(function(event){
		event.preventDefault();
		var product = $('#orderItemsForm orderItemsForm .product').val();
		var total = $('#orderItemsForm .total').val();
		var supplier = $('#orderItemsForm .supplier').val();
		var date = $('#orderItemsForm .orderDate').val();
		var data = $(this).serialize();

		if(product != 0 && total != "" && supplier != 0 && date != ""){
			$.ajax({
				method:'post',
				data:data,
				url:'insert_orderItems',
				success:function(response){
					if(response == 1){
						swal({
	                        title: "Order Item",
	                        text: "You sucessfully order an Item",
	                        icon: "success",
	                    }).then(function(){
	                         $("#orderItemsForm")[0].reset();
	                    });
					}
				},
				error:function(xhr){
					console.log(xhr.responseText);
				}
			});
		}else{
			swal({
                title: "Warning",
                text: "Please input product, qty, supplier and date",
                icon: "warning",
            })
		}
	});

	$('#ordersTable tbody').on('click','.order-delete',function(){
		var id = $(this).data('id');
		swal("Do you want to delete this order?", {
            buttons: {
                cancel: "Cancel",
                ok: true,
            },
        })
        .then((value) => {
            if (value == "ok") {
                var id = $(this).data('id');
                $.ajax({
                    method: 'get',
                    url: 'delete_orderItems',
                    data: {id:id,csrf_test_name:csrf_token },
                    success: function(response){
                        if(response == 1){
                            swal({
                                title: "Order Cancelling",
                                text: "order has been canceled",
                                icon: "success",
                            }).then(function() {
                                window.location.reload();
                            });
                        }else{
                            swal({
                                title: "Error",
                                text: "Failed to cancel ordered items",
                                icon: "error",
                            });
                        }
                    }
                });
            }
        });
	});

	$('#ordersTable tbody').on('click','.order-update',function(){
		var id = $(this).data('id');
		$.ajax({
			method:'post',
			url:'get_order_data',
			data: {id:id, csrf_test_name:csrf_token},
			dataType:'json',
			success:function(response){
				var id = response[0].product_id;
				$.ajax({
					url:'get_product_price',
					method:'post',
					data:{csrf_test_name:csrf_token, id:id},
					success: function(response){
						$('#updateOrderItemsForm .price').val(response);
					},
					error:function(xhr){
						console.log(xhr.responseText);
					}
				});
				$('#updateOrderItemsForm input[name=id]').val(response[0].id);
				$('#updateOrderItemsForm .product').val(response[0].product_id);
				$('#updateOrderItemsForm .qty').val(response[0].quantity);
				$('#updateOrderItemsForm .total').val(response[0].total_order);
				$('#updateOrderItemsForm .orderDate').val(response[0].ordered_date);
				$('#updateOrderItemsForm .supplier').val(response[0].supplier_id);
				$('#updateOrderItemsModal').modal();
			},
			error:function(xhr){
				console.log(xhr.responseText);
			}
		});
	});

	$('#updateOrderItemsForm').submit(function(event){
		event.preventDefault();
		
		var product = $('#updateOrderItemsForm .product').val();
		var total = $('#updateOrderItemsForm .total').val();
		var supplier = $('#updateOrderItemsForm .supplier').val();
		var date = $('#updateOrderItemsForm .orderDate').val();
		var data = $(this).serialize();

		console.log(data);
		if(product != 0 && total != "" && supplier != 0 && date != ""){
			$.ajax({
				method:'post',
				data:data,
				url:'update_orderItems',
				success:function(response){
					if(response == 1){
						swal({
	                        title: "Order Item",
	                        text: "You sucessfully update the order items",
	                        icon: "success",
	                    }).then(function(){
	                         //$("#updateOrderItemsForm")[0].reset();
	                         //$('#updateOrderItemsModal').modal();
	                         window.location.reload();
	                    });
					}
				},
				error:function(xhr){
					console.log(xhr.responseText);
				}
			});
		}else{
			swal({
                title: "Warning",
                text: "Please input product, qty, supplier and date",
                icon: "warning",
            })
		}
	});
});