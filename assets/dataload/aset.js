$(document).ready(function() {

     var newcs = $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive":false,
        "ordering": true,
        "order": [[0, 'desc']],
        "ajax": {
            "url": baseUrl+"aset/jsonData",
            "type": "POST"
        },
        "aLengthMenu": [[5,10,25,50, 100],[5,10,25,50, 100]],
        "pageLength": 10,
        "language": { 
            "processing": '<div class="lds-hourglass"></div>'
        },
        "columns": [
            {"data": "id_aset"},
            {"data": "kode_aset"},
            {"data": "nama_aset"},
            {"data": "tanggal_pembelian"},
            {"data": "metode_penyusutan",
            "render": function(data, type, row, meta) { 
                return data.replace("_", " "); 
            }},
            {"data": "tarif_penyusutan",
            "render": function(data, type, row, meta) { 
                return "Rp. "+parseInt(row['nilai_perolehan']).toLocaleString("id-ID"); 
            }},
            {"data": "view","orderable":false},


            ],

        'columnDefs': [
           { "className": "text-center", "targets": [0,1,2,3,5,6] },
           { "className": "text-center txtCapital", "targets": [4] },
           { "orderable": false, "targets": [0] },
           { "searchable": false, "targets": [0] },
           ],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        },
         drawCallback: function(settings) {
            var allDataIsF = newcs.column(6).data().toArray().every(function(value) {
                return value === 'F';
            });

            // Hide the entire "view" column if all data is 'F'
            newcs.column(6).visible(!allDataIsF);
        }
    });

    $('#addAset').click(function(){
       $('#titlemodal-lg').addClass('bg-success').html('<i class="fa fa-plus"></i> Form Tambah Aset');
       $('.loadformModal-lg').load(baseUrl+'aset/add');
   })

    $(document).on("click", ".edit", function () {
    $('#large-Modal').modal('show');
    var id = $(this).attr('data-id');
    $('#titlemodal-lg').addClass('bg-secondary text-white').html('<i class="fa fa-edit"></i> Form Edit Aset');
    $('.loadformModal-lg').load(baseUrl +'aset/edit/'+id);
    newcs.ajax.reload();
});

    
    
    
    
} );

$(document).on("click", "#detailAset", function (e) {
   var id = $(this).attr('data-id');
    $('#large-Modal').modal('show');
    $('#titlemodal-lg').addClass('bg-secondary text-white').html('<i class="fa fa-info"></i> Detail Aset');
   $('.loadformModal-lg').load(baseUrl +'aset/detailModal/'+id);
});

function renderExcel(){
    location.href = baseUrl+'render/exportAsetExcel/';

}

function renderPdf(){
    var url = baseUrl +'render/exportAsetPDF/';
    window.open(url, '_blank');

}







