$(document).ready(function() {
   
    var newcs = $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "order": [[0, 'asc']],
        "ajax": {
            "url": baseUrl+"conf/premium/json",
            "type": "POST"
        },
        "aLengthMenu": [[5,10,25,50, 100],[5,10,25,50, 100]],
        "pageLength": 10,
        "language": { 
            "processing": 'Loading...'
        },
        "columns": [
            {"data": "id"},
            {"data": "value"},
            {"data": "satuan","render": function(data, type, row, meta) { 
                if(data == 'BULAN'){
                    var html = '<label class="label label-warning">'+data+'</label>';
                }else{
                    var html = '<label class="label label-success">'+data+'</label>';
                }
                return html;
            }},
             {"data": "harga", "render": $.fn.dataTable.render.number('.', '.', 0,'')},
            {"data": "view","orderable":false},
            ],

        'columnDefs': [
             { "className": "text-center", "targets": [0,1,4] },
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

