$(document).ready(function(){
	$('#incomingTable').DataTable({
		"processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
        	"dataType":'json',
            "url": 'incoming_items',
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

	$('#incomingTable tbody').on('click','.receive', function(){
		var id = $(this).data('id');
		swal("Do you want to receive this order?", {
            buttons: {
                cancel: "Cancel",
                ok: true,
            },
        })
        .then((value) => {
            if (value == "ok") {
                var id = $(this).data('id');
                $.ajax({
                    method: 'post',
                    url: 'receive_order',
                    data: {id:id,csrf_test_name:csrf_token },
                    success: function(response){
                        if(response == 1){
                            swal({
                                title: "Order Receiving",
                                text: "order has been received",
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
});