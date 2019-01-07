$(document).ready(function(){
	$('#suppliersTable').DataTable({
		"processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": 'suppliers/get_suppliers',
            "type": "POST",
            "data": {csrf_test_name:csrf_token}
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
               // "orderable": false, //set not orderable
               "visible":false
            }
        ]
	});

	$('#newSupplierForm').submit(function(event){
		event.preventDefault();
		var data = $(this).serialize();
		var title;
        var text;
        var icon;
		$.ajax({
			method: 'post',
			url: 'suppliers/insert_supplier',
			data : data,
			success : function(response){
		        if(response == 1){
		        	swal({
	                    title: "New Supplier Added",
	                    text: "You sucessfully add a supplier",
	                    icon: "success",
	                }).then(function() {
	                    window.location.reload();
	                });
                }else if(response == 0){
                	swal({
	                    title: "Error",
	                    text: "Failed to add Supplier",
	                    icon: "error",
	                }).then(function() {
	                    window.location.reload();
	                });
                }else{
                	swal({
	                    title: "Warning",
	                    text: response,
	                    icon: "warning",
	                });
                }
			},
			error:function(xhr){
				console.log(xhr.responseText);
			}
		});
	});

	$('#suppliersTable tbody').on('click', '.supplier-delete', function(){
		swal("Do you want to delete this product?", {
            buttons: {
                cancel: "Cancel",
                ok: true,
            },
        })
        .then((value) => {
            if (value == "ok") {
				var id = $(this).data('id');
				console.log(id);
				$.ajax({
					method:'get',
					url:'suppliers/delete_supplier',
					data:{csrf_test_name:csrf_token, id:id},
					success:function(response){
						if(response == 1){
		                    swal({
		                        title: "Supplier Deleted",
		                        text: "Data has been successfully deleted",
		                        icon: "success",
		                    }).then(function() {
		                        window.location.reload()
		                    });
		                }else{
		                    swal({
		                        title: "Error",
		                        text: "Failed to delete the data",
		                        icon: "error",
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

	$('#suppliersTable tbody').on('click', '.supplier-update', function(){
		var id = $(this).data('id');
		console.log(id);
		$.ajax({
			method:'post',
			url:'suppliers/get_supplier_data',
			data:{csrf_test_name:csrf_token, id:id},
			dataType:'json',
			success:function(response){
				console.log(response)
				var address = response[0].address.split(', ');
				$('#updateSupplierForm input[name=id]').val(response[0].id);
				$('#updateSupplierForm input[name=name]').val(response[0].name);
				$('#updateSupplierForm input[name=st_address]').val(address[0]);
				$('#updateSupplierForm input[name=barangay]').val(address[1]);
				$('#updateSupplierForm input[name=city]').val(address[2]);
				$('#updateSupplierForm input[name=phone]').val(response[0].phone);
				$('#updateSupplierForm input[name=person]').val(response[0].contact_person);
				$('#updateSupplierModal').modal();
			},
			error:function(xhr){
				console.log(xhr.responseText);
			}
		});
	});

	//updating products using ajax 
    $('#updateSupplierForm').submit(function(event){
        event.preventDefault();

        var data = $(this).serialize();
        console.log(data);
        $.ajax({
            method: 'post',
            url: 'suppliers/update_supplier',
            data: data,
            success: function(response){
                if(response == 1){
                    swal({
                        title: "Supplier Updated",
                        text: "You sucessfully update the supplier",
                        icon: "success",
                    }).then(function(){
                         window.location.reload()
                    });
                }else if(response == 0){
                    swal({
                        title: "Error",
                        text: "Update Failed",
                        icon: "error",
                    }).then(function(){
                        window.location.reload()
                    });

                }else{
                    swal({
                        title: "Warning",
                        text: response,
                        icon: "warning",
                    }); 
                }
            },
            error:function(xhr){
            	console.log(xhr.responseText);
            }
        });
    });
});