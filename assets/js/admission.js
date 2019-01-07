$(document).ready(function(){
	$('#admissionTable').DataTable({
		"processing":true,
		"serverSide":true,
		"ajax":{
			"dataType":'json',
            "url": 'get_admitted',
            "type": "POST",
            "data": {csrf_test_name:csrf_token}
		},
		"columnDefs":[{
			"targets":[0],
			"visible":false
		}]
	});

	$('#admitForm #owner').change(function(){
		var id = $(this).val();
		var data = {id:id, csrf_test_name:csrf_token};
		$.ajax({
			method:'post',
			url:'get_owner_pets',
			data:data,
			dataType:'json',
			success:function(response){
				var option = '';
				$.each(response,function(key, value){
					option += '<option value="'+key+'">'+value+'</option>';
				});
				$('#admitForm #pet').html(option);
			},
			error:function(xhr){
				console.log(xhr.responseText);
			}
		});
	});

	$('#admitForm').submit(function(e){
		e.preventDefault();
		var data = $(this).serialize();
		var owner = $('#admitForm #owner').val();
		var pet = $('#admitForm #pet').val();
		var complaint = $('#admitForm #complaint').val();
		var service = $('#admitForm #service').val();
		var date_admit = $('#admitForm #dateAdmit').val();

		if(owner == 0 || pet == 0 || complaint == "" || service == 0 || date_admit == ""){
			swal({
				title:'Required',
				text:'All fields in Client & Pets are required',
				icon:'warning'
			});
		}else{
			$.ajax({
				method:'post',
				url:'admit',
				data:data,
				success:function(response){
					if(response == 1){
						swal({
							title:'Pet Admission',
							text:'Pet is now admitted',
							icon:'success'
						}).then(function(){
							window.location.reload();
						});
					}else if(response == 0){
						swal({
							title:'Error',
							text:'Failed to admit pet',
							icon:'error'
						}).then(function(){
							window.location.reload();
						});
					}else{
						swal({
							title:'Warning',
							text:response,
							icon:'warning'
						}).then(function(){
							$('#admitForm').trigger('reset')
						});
					}
				},
				error:function(xhr){
					console.log(xhr.responseText);
				}
			});
		}
	});

	$('#admissionTable tbody').on('click','.admission-lab-update',function(){
		var id = $(this).data('id');
		var data = {id:id,csrf_test_name:csrf_token};
		$.ajax({
			method:'get',
			url:'get_pet_lab_data',
			data:data,
			dataType:'json',
			success:function(response){
				$.each(response[0],function(key,value){
					if(value != ""){
						switch(key){
							case 'blood':
								$('#labForm #blood').val(value);
								break;
							case 'distemper':
								$('#labForm #distemper').val(value);
								break;
							case 'ear_swabbing':
								$('#labForm #swabbing').val(value);
								break;
							case 'ehrlichia':
								$('#labForm #ehrlichia').val(value);
								break;
							case 'heartworm':
								$('#labForm #heartworm').val(value);
								break;
							case 'other_test':
								$('#labForm #other').val(value);
								break;
							case 'parvo':
								$('#labForm #parvo').val(value);
								break;
							case 'skin_scrapping':
								$('#labForm #scrapping').val(value);
								break;
							case 'stool':
								$('#labForm #stool').val(value);
								break;
							case 'ultrasound':
								$('#labForm #ultrasound').val(value);
								break;
							case 'urine':
								$('#labForm #urine').val(value);
								break;
							case 'vaginal_smear':
								$('#labForm #vaginal').val(value);
								break;
							default:
								$('#labForm #xrays').val(value);
								break;
						}
					}
				});

				$('#labForm input[name=id]').val(id);
				$('#labModal').modal();		
			},
			error:function(xhr){
				console.log(xhr.responseText);
			}
		});
	});

	$('#admissionTable tbody').on('click','.admission-med-update',function(){
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
		$('#medicalForm input[name=id]').val($(this).data('id'));
		$('#medicalForm #releasedate').val(currentDate);
		$('#medicalForm #for').find('input').attr("disabled", "disabled");
		$('#medicalForm #specific').attr('disabled', 'disabled');
		$('#releaseModal').modal();
	});

	$('#updateLab').click(function(e){
		e.preventDefault();
		var data = $('#labForm').serialize();
		$.ajax({
			method:'post',
			url:'update_lab_test',
			data:data,
			success:function(response){
				var title;
				var text;
				var icon;
				if(response == 1){
					title='Laboratory Test';
					text='Lab test updated';
					icon='success';
				}else{
					title:'Error';;
					text:'Failed to update Lab test';;
					icon:'error';
				}

				swal({
					title:title,
					text:text,
					icon:icon
				}).then(function(){
					$('#labForm').trigger('reset');
					$('#labModal').modal('toggle');
				});
			}
		});
	});

	$('#medicalForm #follow-up').change(function(){
		if($(this).val() == 'yes'){
			$('#medicalForm #nextsched').removeAttr('disabled');
			$('#medicalForm #for').find('input').removeAttr("disabled");
			$('#medicalForm #specific').removeAttr("disabled");
		}else{
			$('#medicalForm #nextsched').attr('disabled','disabled');
			$('#medicalForm #for').find('input').attr("disabled", "disabled");
			$('#medicalForm #specific').attr("disabled", "disabled");
		}
	});

	$('#medicalForm #fee').keyup(function(){
		var fee = parseInt($(this).val());
		var cash = $('#medicalForm #cash').val();
		if (cash != ""){
			var change = cash-fee;
			$('#medicalForm #change').val(change);
		}
	});

	$('#medicalForm #cash').keyup(function(){
		var cash = parseInt($(this).val());
		var fee = $('#medicalForm #fee').val();
		if (fee != ""){
			var change = cash-fee;
			$('#medicalForm #change').val(change);
		}
	});

	$('#releasePet').click(function(e){
		e.preventDefault();
		var follow = $('#medicalForm #follow-up').val();
		var releaseDate = $('#medicalForm #releasedate').val();
		var schedfor = $('#for input:checkbox:checked').length;
		var nextsched = $('#medicalForm #nextsched').val();
		var change = $('#medicalForm #change').val();
		if(follow == '0'){
			swal({
				title:'Warning',
				text:'Please choose if for follow-up',
				icon:'warning'
			});
		}else if(follow == 'yes'){
			if(releaseDate == "" || nextsched == ""){
				swal({
					title:'Dates',
					text:'Please put valid date in releasing and next sched date',
					icon:'warning'
				});
			}else{
				if(schedfor == 0 && $('#medicalForm #specific').val() == ""){
					swal({
						title:'Next Schedule',
						text:'Please check the boxes for next schedule or fill the specic field',
						icon:'warning'
					});
				}else{
					if(change == "" || parseInt($('#medicalForm #change').val()) < 0){
						swal({
							title:'Service Fee',
							text:'Please input valid amount',
							icon:'warning'
						});
					}else{
						release_pet();
					}
				}
			}
		}else{
			if(change == "" || parseInt($('#medicalForm #change').val()) < 0){
				swal({
					title:'Service Fee',
					text:'Please input valid amount',
					icon:'warning'
				});
			}else{
				release_pet();
			}
		}
	});
});

function release_pet(){
	var data = $('#medicalForm').serialize();
	$.ajax({
		method:'post',
		url:'release_pet',
		data:data,
		success:function(response){
			if(response == 1){
				swal({
					title:'Pet Released',
					text:'Pet is now released',
					icon:'success'
				}).then(function(){
					window.location.reload();
				});
			}else{
				swal({
					title:'Error',
					text:'Failed to release pet',
					icon:'error'
				}).then(function(){
					$('#medicalForm').trigger('reset');
				});
			}
		},
		error:function(xhr){
			console.log(xhr.responseText);
		}
	});
}

