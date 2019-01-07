$(document).ready(function(){
	$('#petsTable').DataTable({
		"processing":true,
		"serverSide":true,
		"ajax":{
			"dataType":'json',
            "url": 'pets/get_pets',
            "type": "POST",
            "data": {csrf_test_name:csrf_token}
		},
		"columnDefs":[{
			"targets":[0],
			"visible":false
		}]
	});

	$('#petForm').submit(function(e){
		e.preventDefault();
		var data = $(this).serialize();	
		console.log(data);
		if($('#petForm .owner').val() == 0 || $('#petForm .pet').val() == ''){
			swal({
				title:'Warning',
				text:'Pet and Owner field are required',
				icon:'warning'
			});
		}else{
			$.ajax({
				method:'post',
				url:'pets/add_pet',
				data:data,
				success:function(response){
					var title;
					var text;
					var icon;
					if(response == 1){
						title='Pet Added';
						text='Pet successfully register';
						icon='success';
					}else{
						title='Error';
						text='Failed to add pet';
						icon='error';
					}

					swal({
						title:title,
						text:text,
						icon:icon
					}).then(function(){
						window.location.reload();
					});
				},
				error:function(xhr){
					console.log(xhr.responseText);
				}
			});
		}
	});

	$('#petsTable tbody').on('click','.pet-delete',function(){
		var id = $(this).data('id');
		var data = {id:id,csrf_test_name:csrf_token};
		swal("Do you want to remove this pet?",{
			buttons:{
				cancel:'Cancel',
				ok: true,
			}
		}).then((value) => {
			if(value == 'ok'){
				$.ajax({
					method:'get',
					url:'pets/delete_pet',
					data:data,
					success:function(response){
						if(response == 1){
							swal({
								title:"Remove Pet",
								text:"Pet deleted",
								icon:'success'
							}).then(function(){
								window.location.reload();
							});
						}else{
							swal({
								title:"Error",
								text:"Failed to remove pet data",
								icon:'error'
							});
						}
					}
				});
			}
		});
	});

	$('#petsTable tbody').on('click','.pet-update',function(){
		var id = $(this).data('id');
		var data = {id:id,csrf_test_name:csrf_token};
		$.ajax({
			method:'post',
			url:'pets/get_pet_data',
			data: data,
			dataType:'json',
			success:function(response) {
				console.log(response);
				$('#updatePetForm input[name=id]').val(response[0].id);
				$('#updatePetForm .pet').val(response[0].name);
				$('#updatePetForm .owner').val(response[0].client_id);
				$('#updatePetForm .breed').val(response[0].breed);
				$('#updatePetForm .bday').val(response[0].birthday);
				$('#updatePetForm input[name=gender][value='+response[0].sex+']').attr('checked', 'checked');

				$('#updatePetModal').modal();
			},
			error:function(xhr){
				console.log(xhr.responseText);
			}
		});
	});

	$('#updatePetForm').submit(function(e){
		e.preventDefault();
		var data = $(this).serialize();
		$.ajax({
			method:'post',
			url:'pets/update_pet',
			data:data,
			success:function(response){
				if(response == 1){
					swal({
						title:"Update Pet",
						text:"Pet data updated",
						icon:'success'
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
});