$(document).ready(function() {
    var newcs = $('#example').DataTable({
        "responsive":false,
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "order": [[1, 'desc']],
        "ajax": {
            "url": baseUrl+"utangpiutang/jsonData/"+$('#example').attr('data-tipe'),
            "type": "POST",
            "data":{bulan:$('#filterBulan').val(),tahun:$('#filterTahun').val()}
        },
        "aLengthMenu": [[5,10,25,50, 100],[5,10,25,50, 100]],
        "pageLength": 10,
        "language": { 
            "processing": '<div class="lds-hourglass"></div>'
        },
        "columns": [
            {"data": "status","render": function(data, type, row, meta) { 
                if(data == 'Lunas'){
                    return '<label class="label label-success">'+data+'</label>';
                }else{
                    return '<label class="label label-danger">'+data+'</label>';
                }
            }},
            {"data": "tanggal_awal","render": function(data, type, row, meta) { 
                let mbTanggal = row.tanggal_awal != row.tanggal_akhir || row.tanggal_tempo != null ? '' : 'mb-lg-0';
                let resultData = '<h6 class="longDate hidden-xs '+mbTanggal+'">'+setTanggal(row.tanggal_awal)+'</h6>';
                resultData += '<h6 class="shortDate hidden-xl">'+setTanggal(row.tanggal_awal,'Medium')+'</h6>';
                if(row.tanggal_awal != row.tanggal_akhir){
                    resultData += '<p style="font-size: 9px;" class="m-0 text-secondary hidden-xs">Diperbarui: '+setTanggal(row.tanggal_akhir)+'</p>';
                    resultData += '<p style="font-size: 9px;" class="mb-1 text-light hidden-xl">Diperbarui '+setTanggal(row.tanggal_akhir,'Mini')+'</p>';
                }
                if(row.tanggal_tempo != null){
                    resultData += '<p style="font-size: 9px;" class="m-0 text-secondary hidden-xs">Jatuh Tempo: '+setTanggal(row.tanggal_tempo)+'</p>';
                    resultData += '<p style="font-size: 9px;" class="mb-1 text-light hidden-xl">Jatuh Tempo '+setTanggal(row.tanggal_tempo,'Mini')+'</p>';
                }
                return resultData;
            }},
            {"data": "klien","render": function(data, type, row, meta) { 
                var html = '<span class="kategori hidden-xs">'+data+'</span>';
                html += '<span class="longkategori longkategorifirst hidden-xl">Rp. '+parseInt(row.saldo_akhir).toLocaleString("id-ID")+'</span>'; 
                if(row.status == 'Lunas'){
                    html += '<label class="pull-right hidden-xl label label-success">'+row.status+'</label>';
                }else{
                    html += '<label class="pull-right hidden-xl label label-danger">'+row.status+'</label>';
                }
                html += '<br><span class="longkategori hidden-xl">'+data+'</span><br class="hidden-xl">';
                html += '<small class="longkategori hidden-xl">'+row.deskripsi+'</small>';
                html += '<small class="pull-right hidden-xl">'+row.view+'</small>';
                
                return html;
            }},
            {"data": "deskripsi"},
            {"data": "saldo_awal","render": function(data, type, row, meta) { 
                let mbSaldo = row.saldo_awal != row.saldo_akhir ? '' : 'class="mb-lg-0"';  
                let resultData = '<h6 '+mbSaldo+'>Rp. '+parseInt(row.saldo_akhir).toLocaleString("id-ID")+'</h6>';
                if(row.saldo_awal != row.saldo_akhir){
                    resultData += '<p style="font-size: 9px;" class="m-0 text-secondary">Saldo Awal: Rp. '+parseInt(row.saldo_awal).toLocaleString("id-ID")+'</p>';
                }
                return resultData;
            }},
            {"data": "view","render": function(data, type, row, meta) { 
                if(row.tanggal_awal != row.tanggal_akhir) return row['view_berisi'];
                else return data;
            },"orderable":false},
        ],

        'columnDefs': [
            { "className": "min-mobile text-center align-middle", "targets": [0] },
            { "className": "wh-50 text-center align-middle", "targets": [1] },
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
  let menit = raw.getMinutes()<10 ? "0"+raw.getMinutes() : raw.getMinutes();
  let jam = (raw.getHours()<10 ? "0"+raw.getHours() : raw.getHours()) +':'+ menit;
  if(size == "Medium") return `${hari}\n${bulan}\n${tahun}`;
  else if(size == "Mini") return `${hari}/${raw.getMonth()}/${tahun}`;
  else return `${hari} ${bulan} ${tahun}, ${jam}`;
}

function addForm(type){
    $('#default-Modal').modal('show');
    if(type == "Piutang") $('#titlemodal').removeClass('bg-danger').addClass('bg-success').html('<i class="fa fa-book"></i> Tambah Piutang');
    else $('#titlemodal').removeClass('bg-success').addClass('bg-danger').html('<i class="fa fa-book"></i> Tambah Utang');
    $('.loadformModal').load(baseUrl+'utangpiutang/add/'+type);
}

function editForm(type, id){
    $('#default-Modal').modal('show');
    if(type == "Piutang") $('#titlemodal').removeClass('bg-danger').addClass('bg-success').html('<i class="fa fa-book"></i> Ubah Piutang');
    else $('#titlemodal').removeClass('bg-success').addClass('bg-danger').html('<i class="fa fa-book"></i> Ubah Utang');
    $('.loadformModal').load(baseUrl+'utangpiutang/edit/'+id+'/'+type);
}

function renderExcel(){
    location.href = baseUrl+'render/exportUtangPiutangExcel/'+$('#example').attr('data-tipe')+'/'+$('#filterBulan').val()+'/'+$('#filterTahun').val();

}

function renderPdf(){
    var url = baseUrl + 'render/exportUtangPiutangPDF/'+$('#example').attr('data-tipe')+'/'+$('#filterBulan').val()+'/'+$('#filterTahun').val();
    window.open(url, '_blank');

}