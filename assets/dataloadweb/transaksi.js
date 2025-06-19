$(document).ready(function() {
   
    var newcs = $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "order": [[0, 'asc']],
        "ajax": {
            "url": baseUrl+"conf/transaksi/json",
            "type": "POST",
            "data" : {status:$('#statusFilter').val(),pembayaran:$('#pembayaranFilter').val()}
        },
        "aLengthMenu": [[5,10,25,50, 100],[5,10,25,50, 100]],
        "pageLength": 10,
        "language": { 
            "processing": 'Loading...'
        },
        "columns": [
            {"data": "id"},
            {"data": "tipe","render": function(data, type, row, meta) { 
                if(data == 'Upgrade'){
                    var html = '<label class="label label-success">'+data+'</label>';
                }else{
                    var html = '<label class="label label-info">'+data+'</label>';
                }
                return html;
            }},
            {"data": "nama","render": function(data, type, row, meta) { 
                var html = data+'<br><small>'+row['username']+'</small>';
                return html;
            }},
            

            {"data": "tanggal_daftar"},
            {"data": "harga"},
            {"data": "kode_unik"},
            {"data": "status","render": function(data, type, row, meta) { 
                if(data == 'Pending'){
                    var html = '<label class="label label-warning" style="width:80%">'+data+'</label>';
                }else if(data == 'Batal'){
                    var html = '<label class="label label-danger" style="width:80%">'+data+'</label>';
                }else{
                    var html = '<label class="label label-success" style="width:80%">'+data+'</label>';
                }
                return html;
            }},
            {"data": "konfirmasi_pembayaran","render": function(data, type, row, meta) { 
                if(data == 'SUDAH'){
                    var html = '<label class="bg-success text-center" data-id="'+row['id']+'" style="border-radius:10px;width:50%;"><i class="fa fa-check"></i></label>';
                }else{
                    var html = '<i class="fa fa-times"></i> BELUM';
                }
                return html;
            }},
            {"data": "view","orderable":false},
            ],

        'columnDefs': [
             { "className": "text-center vCenter", "targets": [0,1,6,7,8] },
             { "className": "vCenter", "targets": [0,1,2,3,4,5,6,7,8] },
           ],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        },
    });

    $('.filterBtn').click(function(){
        alert(json);
       newcs.ajax.reload(function(json) {
        json.data.status = $('#statusFilter').val();
        json.data.pembayaran = $('#pembayaranFilter').val();
        }, false); 

    });

   

    
} );
$(document).on("click", ".konfPemBtn", function (e) {
    $('#titlemodal-lg').html('<i class="fa fa-check"></i> Konfirmasi');
    $('#large-Modal').modal('show');
    $('.loadformModal-lg').load(baseUrl+'conf/transaksi/konfirmasi_pembayaran/'+$(this).attr('data-id')); 

});

$(document).on("click", ".btnConfirm", function (e) {
    Swal.fire({
      title: 'Apakah Kamu Yakin?',
      text: "Pengguna ini akan di upgrade ke Premium!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yakin'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: $(this).attr("data-url"),
          data: {id:$(this).attr("data-id"),tgl_exp:$('#tanggal_exp').val()},
          dataType: 'Json',
          beforeSend : function(){
            Swal.fire({
              title: 'Processing...',
              html: 'Please wait...',
              allowEscapeKey: false,
              allowOutsideClick: false,
              showConfirmButton: false,
              didOpen: () => {
                Swal.showLoading()
              }
            });
          },
          success: function(response, textStatus, xhr) {
            var str = response;
            if (str.status == 'success'){
                Swal.fire(
                    'Success!',
                    str.text,
                    str.status
                    )

                if(str.modalclose != 0){
                  $("#default-modal").modal("toggle");
                }

                if(str.reloadTable == 1){
                  $('#example').DataTable().ajax.reload();
                }else if(str.reloadTable == 2){
                  $('#example').DataTable().ajax.reload();
                  $('#example2').DataTable().ajax.reload();
                }

            }else{
                Swal.fire({
                    title: 'Oops...',
                    icon: str.status,
                    html: str.text,
                })
            }
        },
          error: function(xhr, textStatus, errorThrown) {
          }
        });
      }
    })
  });
