$(document).ready(function() {
    var newcs = $('#exampleStok').DataTable({
        "responsive":false,
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "order": [[1, 'desc']],
        "ajax": {
            "url": baseUrl+"master/barang/jsonStokData/"+$('#id_barang').val()+'/'+$('#exampleStok').attr('data-tipe'),
            "type": "POST",
            "data":{bulan:$('#filterBulan').val(),tahun:$('#filterTahun').val()}
        },
        "aLengthMenu": [[5,10,25,50, 100],[5,10,25,50, 100]],
        "pageLength": 10,
        "language": { 
            "processing": '<div class="lds-hourglass"></div>'
        },
        "columns": [
            {"data": "no_invoice"},
            {"data": "tanggal_invoice"},
            {"data": "stok"},
            {"data": "harga","render": function(data, type, row, meta) { 
                return "Rp. "+parseInt(data).toLocaleString("id-ID");
            }},
            {"data": "harga_jual","render": function(data, type, row, meta) { 
                return "Rp. "+parseInt(data).toLocaleString("id-ID");
            }}, 
            {"data": "keterangan"},
            {"data": "created_by"}
        ],

        'columnDefs': [
            { "className": "wh-50 text-center", "targets": [1] },
            { "orderable": false, "targets": [0] },
            { "searchable": false, "targets": [0] },
        ]
    });



} );