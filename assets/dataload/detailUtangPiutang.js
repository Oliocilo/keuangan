$(document).ready(function() {
   
    var newcs = $('#example').DataTable({
        "responsive":false,
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "order": [[1, 'asc']],
        "ajax": {
            "url": baseUrl+"utangpiutang/jsonDataDetails/"+$('#example').attr('data-id')+"/"+$('#example').attr('data-tipe'),
            "type": "POST"
        },
        "aLengthMenu": [[5,10,25,50, 100],[5,10,25,50, 100]],
        "pageLength": 10,
        "language": { 
            "processing": '<div class="lds-hourglass"></div>'
        },
        "columns": [
            {"data": "tipe_saldo","render": function(data, type, row, meta) { 
                if(data == 'Bayar' || data == 'Piutang Awal' || (data == 'Tambah' && row.tipe == "Piutang")){
                    return '<label class="label label-success">'+data+'</label>';
                }else{
                    return '<label class="label label-danger">'+data+'</label>';
                }
            }},
            {"data": "tanggal_perbarui","render": function(data, type, row, meta) { 
                let resultData = '<h6 class="longDate hidden-xs mb-0">'+setTanggal(data)+'</h6>';
                resultData += '<h6 class="shortDate hidden-xl mb-0">'+setTanggal(data,'Medium')+'</h6>';
                return resultData;
            }},
            {"data": "nominal","render": function(data, type, row, meta) { 
                var html = '<span class="kategori hidden-xs">Rp. '+parseInt(data).toLocaleString("id-ID")+'</span>';
                html += '<span class="longkategori longkategorifirst hidden-xl">Rp. '+parseInt(data).toLocaleString("id-ID")+'</span>'; 
                if(row.tipe_saldo == 'Bayar' || row.tipe_saldo == 'Dibayar'){
                    html += '<label class="pull-right hidden-xl label label-success">'+row.tipe_saldo+'</label>';
                }else{
                    html += '<label class="pull-right hidden-xl label label-danger">'+row.tipe_saldo+'</label>';
                }
                html += '<br class="hidden-xl"><span class="longkategori hidden-xl">'+row.deskripsi+'</span><br class="hidden-xl">';
                html += '<small class="longkategori hidden-xl">Saldo Akhir: Rp. '+parseInt(row.saldo).toLocaleString("id-ID")+'</small>';
                html += '<small class="pull-right hidden-xl">'+row.view+'</small>';
                
                return html;
            }},
            {"data": "deskripsi"},
            {"data": "saldo","render": function(data, type, row, meta) { 
                return "Rp. "+parseInt(data).toLocaleString("id-ID");
            }},
            {"data": "view","render": function(data, type, row, meta) { 
                if(row.nominal == row.saldo && row.nominal != row.saldo_akhir && row.tanggal_awal == row.tanggal_perbarui) return "-";
                else return data;
            },"orderable":false},
        ],
        'columnDefs': [
            { "className": "text-center align-middle min-mobile", "targets": [0] },
            { "className": "wh-50 align-middle", "targets": [1] },
            { "className": "align-middle", "targets": [2] },
            { "className": "min-mobile align-middle", "targets": [3,4] },
            { "className": "min-mobile text-center align-middle", "targets": [5] },
            { "orderable": false, "targets": [0] },
            { "searchable": false, "targets": [0] },
        ]
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
  let jam = raw.getHours()+':'+raw.getMinutes();
  if(size == "Medium") return `${hari}\n${bulan}\n${tahun}`;
  else if(size == "Mini") return `${hari}/${raw.getMonth()}/${tahun}`;
  else return `${hari} ${bulan} ${tahun}, ${jam}`;
}

function addForm(id, type, jenis){
    $('#default-Modal').modal('show');
	let kt = (type == "Utang" && jenis == "Bayar") || (type == "Piutang" && jenis == "Tambah");
    let pesan = jenis == "Bayar" ? "Pembayaran " : "Penambahan ";
    if(kt) $('#titlemodal').removeClass('bg-danger').addClass('bg-success').html('<i class="fa fa-book"></i> '+pesan+type);
    else $('#titlemodal').removeClass('bg-success').addClass('bg-danger').html('<i class="fa fa-book"></i> '+pesan+type);
    $('.loadformModal').load(baseUrl+'utangpiutang/addDetail/'+id+'/'+type+'/'+jenis);
}

function editForm(type, id, id_tipe){
    $('#default-Modal').modal('show');
    let judul = type == "Piutang" ? "Ubah Penambahan Piutang" : "Ubah Pembayaran Utang";
    let judul2 = type == "Piutang" ? "Ubah Piutang Dibayar" : "Ubah Penambahan Utang";
    if(id_tipe == 2) $('#titlemodal').removeClass('bg-danger').addClass('bg-success').html('<i class="fa fa-book"></i> '+judul);
    else $('#titlemodal').removeClass('bg-success').addClass('bg-danger').html('<i class="fa fa-book"></i> '+judul2);
    $('.loadformModal').load(baseUrl+'utangpiutang/editDetail/'+id+'/'+type);
}

function renderExcel(){
    var UtangID = $('#example').attr('data-id');
    location.href = baseUrl+'render/exportDetailUtangPiutangExcel/'+UtangID;

}

function renderPdf(){
    var UtangID = $('#example').attr('data-id');
    var url = baseUrl + 'render/exportDetailUtangPiutangPDF/'+UtangID;
    window.open(url, '_blank');

}