$(document).ready(function(){
	$('#groomingTable').DataTable({
		"processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": 'get_services',
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

	$('#groomListForm').submit(function(event){
		event.preventDefault();
		var data = $(this).serialize();

		$.ajax({
			method:'post',
			url:'add_groom_type',
			data:data,
			success:function(response){
				if(response == 1){
                    swal({
                        title : "Grooming Service",
                        text : "You sucessfully add a grooming service",
                        icon : "success",
                    }).then(function() {
                        window.location.reload();
                    });
                }else if(response == 0){
                    swal({
                        title : "Error",
                        text : "Service not been added",
                        icon : "error",
                    }).then(function() {
                        window.location.reload();
                    });
                }else{
                    swal({
                        title : "Warning",
                        text : response,
                        icon : "warning",
                    });
                }
			},
			error:function(xhr){
				console.log(xhr.responseText);
			}
		});
	});

	$('#groomingTable tbody').on('click','.grooming-service-delete',function(){
		var id = $(this).data('id');
		var data = {id:id, csrf_test_name:csrf_token};
		var title;
		var text;
		var icon;
		swal("Do you want to delete this groom service?", {
            buttons: {
                cancel: "Cancel",
                ok: true,
            },
        })
        .then((value) => {
            if (value == "ok") {
				$.ajax({
					method:'get',
					url:'delete_groom_type',
					data:data,
					success:function(response){
						if(response == 1){
		                    title = "Grooming Service";
		                    text = "You sucessfully deleted a grooming service";
		                    icon = "success";
		                }else{
		                    title = "Error";
		                    text = "Service not been deleted";
		                    icon = "error";
		                }

		                swal({
		                    title : title,
		                    text : text,
		                    icon : icon,
		                }).then(function() {
		                    window.location.reload();
		                });
					},
					error:function(xhr){
						console.log(xhr.responseText);
					}
				});
		   	}
        });
	});

	$('#groomingTable tbody').on('click','.grooming-service-update',function(){
		var id = $(this).data('id');
		var data = {id:id, csrf_test_name:csrf_token};
		$.ajax({
			method:'post',
			url:'get_groom_type_data',
			data:data,
			success:function(response){
				$('#updateGroomForm input[name=id]').val(response[0].id);
				$('#updateGroomForm .groomType').val(response[0].type);
				$('#updateGroomForm .description').val(response[0].description);
				$('#updateGroomForm .price').val(response[0].price);
				$('#updateGroomModal').modal();
			},
			error:function(xhr){
				console.log(xhr.responseText);
			}
		});
	});

	$('#updateGroomForm').submit(function(event){
		event.preventDefault();
		var data = $(this).serialize();
		$.ajax({
			method:'post',
			url:'update_groom_type',
			data:data,
			success:function(response){
				console.log(response);
			},
			error:function(xhr){
				console.log(xhr.responseText);
			}
		});
	});
});