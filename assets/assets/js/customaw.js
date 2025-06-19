 $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
    return {
      "iStart": oSettings._iDisplayStart,
      "iEnd": oSettings.fnDisplayEnd(),
      "iLength": oSettings._iDisplayLength,
      "iTotal": oSettings.fnRecordsTotal(),
      "iFilteredTotal": oSettings.fnRecordsDisplay(),
      "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
      "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
    };
  };
$(document).ready(function() {
   $(document).on("click", ".btnSubmitaw", function () {
    var mydata = new FormData(document.getElementById('formajaxaw'));
    $.ajax({
      type: "POST",
      url: $('#formajaxaw').attr('action'),
      data: mydata,
      cache: false,
      contentType: false,
      processData: false,
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
        var str = JSON.parse(response);
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
            }
            
        }else{
            Swal.close();
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
    return false;
  });

    $(document).on("click", ".btndeleteaw", function (e) {
    Swal.fire({
      title: 'Apakah Kamu Yakin?',
      text: "Data ini akan dihapus selamanya!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yakin, Hapus!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: $(this).attr("data-url"),
          data: {id:$(this).attr("data-id")},
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

$('.addBtn').click(function(){
   $('#default-modal-title').html('<i class="fa fa-plus"></i> Tambah '+$(this).attr('data-name'));
   $('#default-modal').modal('show');
   $('#default-modal-body').html('<div class="preloader-backdrop"><div class="page-preloader">Loading</div></div>');
   $('#default-modal-body').load(baseUrl+'conf/'+$(this).attr('data-route')+'/add');
 })

$(document).on("click", ".editBtnaw", function (e) {
     $('#default-modal-title').html('<i class="fa fa-edit"></i> Edit '+$(this).attr('data-name'));
     $('#default-modal').modal('show');
     $('#default-modal-body').html('<div class="preloader-backdrop"><div class="page-preloader">Loading</div></div>');
     $('#default-modal-body').load(baseUrl+'conf/'+$(this).attr('data-route')+'/edit/'+$(this).attr('data-id'));
  });

});