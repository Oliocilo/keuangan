$(document).ready(function() {
    var newcs = $('#example').DataTable({
        "responsive":false,
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "order": [[1, 'desc']],
        "ajax": {
            "url": baseUrl+"penjualanbarang/jsonData/",
            "type": "POST",
            "data":{bulan:$('#filterBulan').val(),tahun:$('#filterTahun').val()}
        },
        "aLengthMenu": [[5,10,25,50, 100],[5,10,25,50, 100]],
        "pageLength": 10,
        "language": { 
            "processing": '<div class="lds-hourglass"></div>'
        },
        "columns": [
            {"data": "tanggal","render": function(data, type, row, meta) { 
                let resultData = '<h6 class="longDate hidden-xs">'+setTanggal(data)+'</h6>';
                resultData += '<h6 class="shortDate hidden-xl">'+setTanggal(data,'Medium')+'</h6>';
                return resultData;
            }},
            {"data": "no_penjualan"},
            {"data": "jumlah_barang"},
            {"data": "jumlah_item"},
            {"data": "total_harga_beli","render": function(data, type, row, meta) { 
                return "Rp. "+parseInt(data).toLocaleString("id-ID");
            }},
            {"data": "total_harga_jual","render": function(data, type, row, meta) { 
                return "Rp. "+parseInt(data).toLocaleString("id-ID");
            }},
            {"data": "view","orderable":false},
        ],

        'columnDefs': [
            { "className": "text-center", "targets": [1] },
            { "className": "text-center", "targets": [2,6] },
            { "className": "text-center", "targets": [0,3,4,5] },
            { "orderable": false, "targets": [0] },
            { "searchable": false, "targets": [0] },
        ]
    });

    $(document).on("click", ".detail", function () {
    var id = $(this).attr('data-id');
    
    $('#large-Modal90').modal({backdrop: 'static', keyboard: false});
    $('#titlemodal90-lg').removeClass('bg-danger').addClass('bg-success').html('<i class="fa fa-book"></i> Detail Penjualan Barang');
    $('.loadformModal90-lg').load(baseUrl+'penjualanbarang/detail/'+id);
    });
} );

$('#example_filter').after($('#custom_element'));
$('#example_length select').addClass('selectsmall');

function setTanggal(tanggal, size = 'Big'){
  let day = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
  let month = ["Jan","Feb","Maret","April","Mei","Juni","Juli","Agust","Sept","Okt","Nov","Des"];
    //   let month = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
  let raw = new Date(tanggal);
  let tahun = raw.getFullYear();
  let bulan = month[raw.getMonth()];
  let hari = raw.getDate();
  let menit = raw.getMinutes()<10 ? "0"+raw.getMinutes() : raw.getMinutes();
  let jam = (raw.getHours()<10 ? "0"+raw.getHours() : raw.getHours()) +':'+ menit;
  if(size == "Medium") return `${hari}\n${bulan}\n${tahun}`;
  else if(size == "Mini") return `${hari}/${raw.getMonth()}/${tahun}`;
  else return `${hari} ${bulan} ${tahun}, ${jam}`;
}

function addForm(){
    $('#large-Modal90').modal({backdrop: 'static', keyboard: false});
    $('#titlemodal90-lg').removeClass('bg-danger').addClass('bg-success').html('<i class="fa fa-book"></i> Tambah Penjualan Barang');
    $('.loadformModal90-lg').load(baseUrl+'barang/jual/add/');
}

function addBarang(){
     $('#default-Modal').modal('show');
    $('#titlemodal').removeClass('bg-danger').addClass('bg-success text-white').html('<i class="fa fa-plus"></i> Tambah Barang');
    $('.loadformModal').load(baseUrl+'barang/jual/add_barang');
}

function editForm(id){
    $('#default-Modal').modal('show');
    $('#titlemodal').removeClass('bg-danger').addClass('bg-success').html('<i class="fa fa-book"></i> Ubah Data Barang');
    $('.loadformModal').load(baseUrl+'master/barang/edit/'+id);
}

function stokForm(id){
    $('#large-Modal').modal('show');
    $('#titlemodal-lg').removeClass('bg-danger').addClass('bg-success').html('<i class="fa fa-book"></i> Pembaruan Stok');
    $('.loadformModal-lg').load(baseUrl+'master/barang/stok/'+id);
}

function renderExcel(){
    var BukuID = $('#example').attr('data-buku');
    location.href = baseUrl+'render/exportBukuKasExcel/'+BukuID;

}

function renderPdf(){
    var BukuID = $('#example').attr('data-buku');
    var url = baseUrl + 'render/exportBukuKasPDF/' + BukuID;
    window.open(url, '_blank');

}

$(document).on('show.bs.modal', '#default-Modal', function() {
  const zIndex = 999900 + 10 * $('.modal:visible').length;
  $(this).css('z-index', zIndex);
  setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack'));
});

$(document).on('hide.bs.modal', '#default-Modal', function () {
     setTimeout(() => $('.modal-backdrop').css('z-index', ''));

});


