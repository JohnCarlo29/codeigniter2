$(document).ready(function(){
	$('#stocksTable').DataTable({
		"processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
        	"dataType":'json',
            "url": 'stocks_items',
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

	$('#stocksTable tbody').on('click', '.adjust', function(){
    	var id = $(this).data('id');
        swal("Do you want to adjust this stocks?", {
            buttons: {
                cancel: "Cancel",
                ok: true,
            },
        })
        .then((value) => {
            if (value == "ok") {
                $.ajax({
                    method:'post',
                    url:'get_stock_item',
                    data: {id:id, csrf_test_name:csrf_token},
                    dataType:'json',
                    success:function(response){
                        $('#stocksForm input[name=id]').val(response[0].id);
                        $('#stocksForm #sku').val(response[0].sku);
                        $('#stocksForm #name').val(response[0].name);
                        $('#stocksForm #qty').val(response[0].quantity);
                        $('#stocksModal').modal();
                    },
                    error:function(xhr){
                        console.log(xhr.responseText);
                    }
                });
            }
        });
	});

    $('#stocksForm').submit(function(event){
        event.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            method:'post',
            url:'adjust_stocks',
            data:data,
            success:function(response){
               if(response == 1){
                    swal({
                        title: "Item Adjustment",
                        text: "items has been adjust successfully",
                        icon: "success",
                    }).then(function() {
                        window.location.reload();
                    });
                }else{
                    swal({
                        title: "Error",
                        text: "items failed to adjust",
                        icon: "error",
                    });
                }
            },
            error:function(xhr){
                console.log(xhr.responseText);
            }
        });
    });

    //critical items
    $('#criticalTable').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "dataType":'json',
            "url": 'critical_items',
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
});