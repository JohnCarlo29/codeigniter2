$(document).ready(function(){
	var table = $('#historyTable').DataTable( {
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
        "ajax": {
        	"dataType":'json',
            "url": 'get_history',
            "type": "POST",
            "data": {csrf_test_name:csrf_token}
        },
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
         	{ "data": "id" },
            { "data": "owner" },
            { "data": "pet" },
            { "data": "service" },
            { "data": "complaint" },
            { "data": "diagnosis" },
            { "data": "recommendation" },
            { "data": "medication" },
            { "data": "prescribe" },
            { "data": "date_admit" },
            { "data": "date_release" },
            { "data": "action" }
        ],
        "order": [],
        "columnDefs": [
            { 
                "targets": [ 1 ], //first column / numbering column
                "visible": false, //set not visible
            },
            { 
                "targets": [ 0,4,5,6,7,8 ], //first column / numbering column
                "searchable": false, //set not visible
            },
             { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not visible
            }
        ]
    } );

    table.on( 'xhr', function ( e, settings, json ) {
    console.log( 'Ajax event occurred. Returned data: ', json );
	} );
     
    // Add event listener for opening and closing details
    $('#historyTable tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
});

function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Blood:</td>'+
            '<td>'+d.blood+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Distemper:</td>'+
            '<td>'+d.distemper+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Parvo:</td>'+
            '<td>'+d.parvo+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Ehrlichia:</td>'+
            '<td>'+d.ehrlichia+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Heartworm:</td>'+
            '<td>'+d.heartworm+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Ultrasound:</td>'+
            '<td>'+d.ultrasound+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Urine:</td>'+
            '<td>'+d.urine+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Vaginal Smear:</td>'+
            '<td>'+d.vaginal_smear+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>X-rays:</td>'+
            '<td>'+d.xrays+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Skin Scrapping:</td>'+
            '<td>'+d.skin_scrapping+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Ear Swabbing</td>'+
            '<td>'+d.ear_swabbing+'</td>'+
        '</tr>'+
         '<tr>'+
            '<td>Stool:</td>'+
            '<td>'+d.stool+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Other Test:</td>'+
            '<td>'+d.other_test+'</td>'+
        '</tr>'
        
    '</table>';
}