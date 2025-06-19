$(document).ready(function() {
   
    var newcs = $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "order": [[0, 'desc']],
        "ajax": {
            "url": baseUrl+"conf/pengguna/json",
            "type": "POST"
        },
        "aLengthMenu": [[5,10,25,50, 100],[5,10,25,50, 100]],
        "pageLength": 10,
        "language": { 
            "processing": '<div class="lds-hourglass"></div>'
        },
        "columns": [
            {"data": "id"},
            {"data": "nama"},
            {"data": "username"},
            {"data": "created_at"},
            {"data": "subscription_type","render": function(data, type, row, meta) { 
                if(data == 'Free'){
                    var html = '<label class="label label-inverse">'+data+'</label>';
                }else{
                    var html = '<label class="label label-success">'+data+'</label>';
                }
                return html;
            }},
            {"data": "totalchild"},
            {"data": "view","orderable":false},


            ],

        'columnDefs': [
           { "className": "text-center", "targets": [0,4,5,6] },
           { "orderable": false, "targets": [0] },
           { "searchable": false, "targets": [0] },
           ],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        }
    });

    
    
} );


$(document).on("click", ".edit", function () {
    var id = $(this).attr('data-id');
    location.href = baseUrl + 'conf/pengguna/detail/'+id;
});

