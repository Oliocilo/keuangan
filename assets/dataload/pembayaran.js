$(document).on("click", ".bntBatal", function (e) {
    Swal.fire({
      title: 'Apakah Kamu Yakin?',
      text: "Pembelian Ini akan dibatalkan!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yakin, Batalkan!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: baseUrl+'pengaturan/premium/batal',
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
                    $("#default-Modal").modal("toggle");
                }

                if(str.reload == 1){
                    setTimeout(function(){ 
                        location.reload();
                    }, 2000);
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