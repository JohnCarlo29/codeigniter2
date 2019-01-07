$(document).ready(function(){
	$('#clientsTable').DataTable({
		"processing":true,
		"serverSide":true,
		"ajax":{
			"dataType":'json',
            "url": 'clients/get_clients',
            "type": "POST",
            "data": {csrf_test_name:csrf_token}
		},
		"columnDefs":[{
			"targets":[0],
			"visible":false
		}]
	});

	$('#clientForm').submit(function(e){
		e.preventDefault();
		var lname = $('#clientForm .lname').val();
		var fname = $('#clientForm .fname').val();
		var mi = $('#clientForm .mi').val();
		var address = $('#clientForm .address').val();
		var contact;
		if($('#clientForm .optionContact').val() != ""){
			contact = $('#clientForm .contact').val()+'/'+$('#clientForm .optionContact').val();
		}else{
			contact = $('#clientForm .contact').val();
		}
		var data = {
			lastname:lname,
			firstname:fname,
			mi:mi,
			address:address,
			contact:contact,
			csrf_test_name:csrf_token
		};

		$.ajax({
			method:'post',
			url:'clients/register',
			data:data,
			success:function(response){
				if(response == 1){
					swal({
						title:'New Client',
						text:'New Client added',
						icon:'success'
					}).then(function(){
						window.location.reload();
					});
				}else{
					swal({
						title:'Error',
						text:'failed to add new client',
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
	});

	$('#clientsTable tbody').on('click','.client-delete', function(){
		var id = $(this).data('id');
		swal("Do you want to remove this client?", {
            buttons: {
                cancel: "Cancel",
                ok: true,
            },
        })
        .then((value) => {
            if (value == "ok") {
                $.ajax({
                    method: 'get',
                    url: 'clients/delete_client',
                    data: {id:id,csrf_test_name:csrf_token },
                    success: function(response){
                        if(response == 1){
                            swal({
                                title: "Remove client",
                                text: "client has been deleted",
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

	$('#clientsTable tbody').on('click','.client-update', function(){
		var id = $(this).data('id');
		$.ajax({
			method:'get',
			url:'clients/get_client_data',
			data:{id:id,csrf_test_name:csrf_token},
			success:function(response){
				console.log(response);
				$('#updateClientForm input[name=id]').val(response[0].id);
				$('#updateClientForm .lname').val(response[0].lastname);
				$('#updateClientForm .fname').val(response[0].firstname);
				$('#updateClientForm .mi').val(response[0].mi);
				$('#updateClientForm .address').val(response[0].address);
				var contact = response[0].contact;
				var contacts;
				if(contact.indexOf('/') > -1){
					contacts = contact.split('/');
					$('#updateClientForm .contact').val($.trim(contacts[0]));
					$('#updateClientForm .optionContact').val($.trim(contacts[1]));
				}else{
					$('#updateClientForm .contact').val(response[0].contact);
				}
				$('#updateClientModal').modal();
			},
			error:function(xhr){
				console.log(xhr.responseText);
			}
		});
	});

	$('#updateClientForm').submit(function(e){
		e.preventDefault();
		var id = $('#updateClientForm input[name=id]').val();
		var lname = $('#updateClientForm .lname').val();
		var fname = $('#updateClientForm .fname').val();
		var mi = $('#updateClientForm .mi').val();
		var address = $('#updateClientForm .address').val();
		var contact;
		if($('#updateClientForm .optionContact').val() != ""){
			contact = $('#updateClientForm .contact').val()+' / '+$('#updateClientForm .optionContact').val();
		}else{
			contact = $('#updateClientForm .contact').val();
		}
		var data = {
			id:id,
			lastname:lname,
			firstname:fname,
			mi:mi,
			address:address,
			contact:contact,
			csrf_test_name:csrf_token
		};

		console.log(data);
		$.ajax({
			method:'post',
			url:'clients/update_client',
			data:data,
			success:function(response){
				if(response == 1){
                    swal({
                        title: "Update client",
                        text: "client has been updated",
                        icon: "success",
                    }).then(function() {
                        window.location.reload();
                    });
                }else{
                    swal({
                        title: "Error",
                        text: "Failed to cancel ordered items",
                        icon: "error",
                    }).then(function() {
                        window.location.reload();
                    });
                }
			},
			error:function(xhr){
				console.log(xhr.responseText);
			}
		});
	});
});