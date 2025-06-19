$(document).ready(function() {
    var newcs = $('#tblbarangdetail').DataTable({
        "responsive":false,
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "order": [[1, 'desc']],
        "ajax": {
            "url": baseUrl+"penjualanbarang/jsonItem/"+$('#tblbarangdetail').attr('data-penjualan'),
            "type": "POST",
            "data":{bulan:$('#filterBulan').val(),tahun:$('#filterTahun').val()}
        },
        "aLengthMenu": [[5,10,25,50, 100],[5,10,25,50, 100]],
        "pageLength": 10,
        "language": { 
            "processing": '<div class="lds-hourglass"></div>'
        },
        "columns": [
            {"data": "nama_barang"},
            {"data": "jumlah"},
            {"data": "harga_beli","render": function(data, type, row, meta) { 
                return "Rp. "+parseInt(data).toLocaleString("id-ID");
            }},
            {"data": "total_harga_beli","render": function(data, type, row, meta) { 
                return "Rp. "+parseInt(data).toLocaleString("id-ID");
            }},
            {"data": "harga_jual","render": function(data, type, row, meta) { 
                return "Rp. "+parseInt(data).toLocaleString("id-ID");
            }},
            {"data": "total_harga_jual","render": function(data, type, row, meta) { 
                return "Rp. "+parseInt(data).toLocaleString("id-ID");
            }},
        ],

        'columnDefs': [
            { "className": "wh-50 text-center", "targets": [1] },
            { "orderable": false, "targets": [0] },
            { "searchable": false, "targets": [0] },
        ]
    });



} );