$(document).ready(function() {
   
    var newcs = $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "order": [[0, 'asc']],
        "ajax": {
            "url": baseUrl+"conf/rekening/json",
            "type": "POST"
        },
        "aLengthMenu": [[5,10,25,50, 100],[5,10,25,50, 100]],
        "pageLength": 10,
        "language": { 
            "processing": 'Loading...'
        },
        "columns": [
            {"data": "id"},
            {
                "data": "logo_bank",
                "render": function (data, type, full, meta) {
                    return '<img src="' +baseUrl+ data + '" alt="Logo" style="max-width: 100px; max-height: 50px;">';
                }
            },
            {"data": "nama_bank"},
            {"data": "nomor_rekening"},
            {"data": "nama_rekening"},
            {"data": "view","orderable":false}
            ],

        'columnDefs': [
             { "className": "text-center vCenter", "targets": [0,1,5] },
             { "className": "vCenter", "targets": [0,1,2,3,4,5] },
           ],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        },
    });

    
} );

