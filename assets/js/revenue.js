$(document).ready(function(){
	$('#serviceRevTable').DataTable({
		"processing":true,
		"serverSide":true,
		"ajax":{
			"dataType":'json',
            "url": 'get_revenue',
            "type": "POST",
            "data": {csrf_test_name:csrf_token}
		},
		"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var json = api.ajax.json();
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                '₱'+pageTotal +' ( ₱'+ json.total +' total)'
            );
        }
	});
});