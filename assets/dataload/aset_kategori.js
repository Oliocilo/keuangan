$(document).ready(function() {
   var visaksi = true;
    var newcs = $('#example').DataTable({
      
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "order": [[0, 'desc']],
        "ajax": {
            "url": baseUrl+"master/aset_kategori/jsonData",
            "type": "POST"
        },
        "aLengthMenu": [[5,10,25,50, 100],[5,10,25,50, 100]],
        "pageLength": 10,
        "language": { 
            "processing": '<div class="lds-hourglass"></div>'
        },
        "columns": [
            {"data": "id"},
            {"data": "kode_kategori"},
            {"data": "nama_kategori"},
            {"data": "view","orderable":false},


            ],

        'columnDefs': [
           { "className": "text-center", "targets": [0] },
           { "orderable": false, "targets": [0] },
           { "searchable": false, "targets": [0] }
           ],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
            if (data[3] === 'F') {
                visaksi = false;
            }
        },
        drawCallback: function(settings) {
            var allDataIsF = newcs.column(3).data().toArray().every(function(value) {
                return value === 'F';
            });

            // Hide the entire "view" column if all data is 'F'
            newcs.column(3).visible(!allDataIsF);
        }
    });

  newcs.columns([3]).every(function() {
        var column = this;
        console.log(column.data()[3])
        // Check the value in the first row
        if (column.data()[0] === 'F') {
            column.visible(false);
        }
    });

    
    
} );

$('#add').click(function(){
   $('#titlemodal').removeClass('bg-danger bg-primary').addClass('bg-success').html('<i class="fa fa-plus"></i> Buat Kategori Aset');
   $('.loadformModal').load(baseUrl+'master/aset_kategori/add');
})

$(document).on("click", ".edit", function () {
    $('#default-Modal').modal('show');
    var id = $(this).attr('data-id');
    $('#titlemodal').removeClass('bg-danger bg-primary bg-success').addClass('bg-primary').html('<i class="fa fa-edit"></i> Edit Kategori Aset');
    $('.loadformModal').load(baseUrl + 'master/aset_kategori/edit/'+id);
});

