$(document).ready(function() {
   
    var newcs = $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "order": [[0, 'asc']],
        "ajax": {
            "url": baseUrl+"master/kategori/jsonData/1",
            "type": "POST"
        },
        "aLengthMenu": [[5,10,25,50, 100],[5,10,25,50, 100]],
        "pageLength": 10,
        "language": { 
            "processing": '<div class="lds-hourglass"></div>'
        },
        "columns": [
            {"data": "nama_kategori"},
            {"data": "view",
            "render": function(data, type, row, meta) { 
                if(row['id_user'] == 0) return '-';
                else return data;
            },"orderable":false
            },


            ],

        'columnDefs': [
           { "className": "text-center", "targets": [0] },
           { "orderable": false, "targets": [0] },
           { "searchable": false, "targets": [0] },
           ]
    });

    var newcs2 = $('#examples').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "order": [[0, 'asc']],
        "ajax": {
            "url": baseUrl+"master/kategori/jsonData/2",
            "type": "POST"
        },
        "aLengthMenu": [[5,10,25,50, 100],[5,10,25,50, 100]],
        "pageLength": 10,
        "language": { 
            "processing": '<div class="lds-hourglass"></div>'
        },
        "columns": [
            {"data": "nama_kategori"},
            {"data": "view",
            "render": function(data, type, row, meta) { 
                if(row['id_user'] == 0) return '-';
                else return data;
            },"orderable":false
            },


            ],

        'columnDefs': [
           { "className": "text-center", "targets": [0] },
           { "orderable": false, "targets": [0] },
           { "searchable": false, "targets": [0] },
           ]
    });
    
} );

function addForm(type){
    if(type == 1) $('#titlemodal').removeClass('bg-danger').addClass('bg-success').html('<i class="fa fa-book"></i> Buat Kategori Pemasukan');
    else $('#titlemodal').removeClass('bg-success').addClass('bg-danger').html('<i class="fa fa-book"></i> Buat Kategori Pengeluaran');
    $('.loadformModal').load(baseUrl+'master/kategori/add/'+type);
}

function editForm(type, id){
    if(type == 1) $('#titlemodal').removeClass('bg-danger').addClass('bg-success').html('<i class="fa fa-book"></i> Ubah Kategori Pemasukan');
    else $('#titlemodal').removeClass('bg-success').addClass('bg-danger').html('<i class="fa fa-book"></i> Ubah Kategori Pengeluaran');
    $('.loadformModal').load(baseUrl+'master/kategori/edit/'+id);
}