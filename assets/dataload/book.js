$(document).ready(function() {
   
    var newcs = $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "responsive":false,
        "order": [[1, 'desc']],
        "ajax": {
            "url": baseUrl+"book/jsonData/"+$('#example').attr('data-buku'),
            "type": "POST",
            "data":{bulan:$('#filterBulan').val(),tahun:$('#filterTahun').val()}
        },
        "aLengthMenu": [[5,10,25,50, 100],[5,10,25,50, 100]],
        "pageLength": 10,
        "language": { 
            "processing": '<div class="lds-hourglass"></div>'
        },
        "columns": [
            {"data": "tipe","render": function(data, type, row, meta) { 
                if(data == 'Pengeluaran'){
                    var html = '<label class="label label-danger">'+data+'</label>';
                }else if(data == 'Pemasukan'){
                    var html = '<label class="label label-success">'+data+'</label>';
                }else{
                    var html = '<label class="label label-primary">'+data+'</label>';
                }

                html += '<br><small class="text-muted"> Dicatat Oleh :<br> '+row['created_by_name']+'</small>';
                return html;
            }},
            {"data": "tanggal","render": function(data, type, row, meta) { 
                let resultData = '<h6 class="longDate hidden-xs">'+setTanggal(data)+'</h6>';
                resultData += '<h6 class="shortDate hidden-xl">'+setTanggal(data,'Medium')+'</h6>';
                return resultData;
            }},
            {"data": "nama_kategori"},
            {"data": "deskripsi","render": function(data, type, row, meta) { 
                var html = '<span class="kategori hidden-xs">'+data+'</span>';
                html += '<span class="longkategori longkategorifirst hidden-xl">'+row['nominal']+'</span>';
                if(row['tipe'] == 'Pengeluaran'){
                    html += '<label class="pull-right hidden-xl label label-danger">'+row['tipe']+'</label>';
                }else if(row['tipe'] == 'Pemasukan'){
                    html += '<label class="pull-right hidden-xl label label-success">'+row['tipe']+'</label>';
                }else{
                    html += '<label class="pull-right hidden-xl label label-primary">'+row['tipe']+'</label>';
                }
                html += '<br class="d-lg-none"><span class="longkategori hidden-xl">'+row['nama_kategori']+'</span><br class="d-lg-none">';
                html += '<small class="longkategori hidden-xl">'+data+'</small>';
                html += '<small class="pull-right hidden-xl">'+row['view']+'</small>';
                
                return html;
            }},
            {"data": "nominal_masuk"},
            {"data": "nominal_keluar"},
            {"data": "id","render": function(data) { return getSaldoAkhir(data);} },
            {"data": "view",
            "render": function(data, type, row, meta) { 
                let text = row['deskripsi'].toString();
                if(row['id_kategori'] == 1 || row['id_kategori'] == 2) return row['view_barang'];
                else if(text.search("Utang") >= 0 || text.search("Piutang") >= 0) return row['view_barang'];
                else return data;
            },"orderable":false
            },


            ],
        "createdRow": function(row, data, dataIndex) {
            // if (data.tipe == 'Transfer') {
            //     $(row).css('background', '#01a9ac6e');
            // }else if (data.tipe == 'Pengeluaran') {
            //     $(row).css('background', '#eb342242');
            // }else if (data.tipe == 'Pemasukan') {
            //     $(row).css('background', '#0ac28252');
            // }
        },

        'columnDefs': [
            { "className": "text-center min-mobile align-middle", "targets": [0] },
            { "className": "wh-50 text-center align-middle", "targets": [1] },
            { "className": "min-mobile text-center align-middle", "targets": [2] },
            { "className": "align-middle", "targets": [3] },
            { "className": "min-mobile text-center align-middle", "targets": [4,5,6,7] },
            { "orderable": false, "targets": [0,2,3,7] },
            { "searchable": false, "targets": [0] },
            { "className": "wh-30 text-center", "targets": [0] } 
        
           ]
    });

    $('#example_filter').after($('#custom_element'));
    $('#example_length select').addClass('selectsmall');



   


    $('.addPemasukan').click(function(){
         $('#titlemodal').removeClass('bg-danger bg-primary').addClass('bg-success').html('<i class="fa fa-sign-in"></i> Buat Pemasukan');
        $('.loadformModal').load(baseUrl+'book/add/1/'+$('#example').attr('data-buku'));
    })
    $('.addPengeluaran').click(function(){
        $('#titlemodal').removeClass('bg-success bg-primary').addClass('bg-danger').html('<i class="fa fa-sign-out"></i> Buat Pengeluaran');
        $('.loadformModal').load(baseUrl+'book/add/2/'+$('#example').attr('data-buku'));
    })

    $('.addTransfer').click(function(){
        $('#titlemodal').removeClass('bg-success bg-danger').addClass('bg-primary').html('<i class="fa fa-exchange"></i> Transfer');
        $('.loadformModal').load(baseUrl+'book/add/3/'+$('#example').attr('data-buku'));
    })

    $(document).on("click", ".editTransaksiBtn", function () {
        $('#default-Modal').modal('show');
        var tipe = $(this).attr('data-tipe');
        var idTrans = $(this).attr('data-trans');
        var bgcolor;
        var titleLabel;
        var iconLabel;

        if (tipe === 'Pemasukan') {
            bgcolor = 'bg-success';
            titleLabel = 'Edit Pemasukan';
            iconLabel = 'sign-in';
        } else if (tipe === 'Pengeluaran') {
            bgcolor = 'bg-danger';
            titleLabel = 'Edit Pengeluaran';
            iconLabel = 'sign-out';
        } else if (tipe === 'Transfer') {
            bgcolor = 'bg-primary';
        }

        $('#titlemodal')
        .removeClass('bg-success bg-primary bg-danger')
        .addClass(bgcolor)
        .html('<i class="fa fa-'+iconLabel+'"></i> Edit ' + tipe);

        $('.loadformModal').load(baseUrl + 'book/edit/'+tipe+'/'+idTrans);
    });

      $('[data-toggle="tooltip"]').tooltip();

   

    
} );

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

function renderExcel(){
    var BukuID = $('#example').attr('data-buku');
    location.href = baseUrl+'render/exportBukuKasExcel/'+BukuID+'/'+$('#filterBulan').val()+'/'+$('#filterTahun').val();

}

function renderPdf(){
    var BukuID = $('#example').attr('data-buku');
    var url = baseUrl + 'render/exportBukuKasPDF/' + BukuID+'/'+$('#filterBulan').val()+'/'+$('#filterTahun').val();;
    window.open(url, '_blank');

}





