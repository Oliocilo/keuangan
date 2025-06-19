$(document).on("click", ".btnSubmit", function () {
    var mydata = new FormData(document.getElementById('formajax'));
    $.ajax({
      type: "POST",
      url: $('#formajax').attr('action'),
      data: mydata,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend : function(){
        $(".errorValidate").hide();
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
                if($("#default-Modal").hasClass("show")) $("#default-Modal").modal("toggle");
                if($("#large-Modal").hasClass("show")) $("#large-Modal").modal("toggle");
                if($("#large-Modal90").hasClass("show")) $("#large-Modal90").modal("toggle");
            }

            if(str.reload == 1){
                setTimeout(function(){ 
                    location.reload();
                }, 2000);
            }
        }else{
            $(".errorValidate").hide().html(str.html).slideDown("fast");
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

$(document).on("click", ".btndelete", function (e) {
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

function deleteAlert(url){
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
        //div #formDelete harus ada di view
        $('#formFilter').remove();
        $('#formDelete').html(`<form id="formajax" action="`+url+`" class="d-none"><button class="btnSubmit d-none" id="btnClick" type="submit"></form>`);
        $('#btnClick').click();
      }
    })
}

function defaultAlert(url){
    Swal.fire({
      title: 'Apakah Kamu Yakin?',
      text: "Kas default akan berpengaruh ke saldo awal modal saham dan Laporan Laba/Rugi serta Neraca !",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yakin, jadikan default!'
    }).then((result) => {
      if (result.isConfirmed) {
        //div #formDelete harus ada di view
        $('#formDelete').html(`<form id="formajax" action="`+url+`" class="d-none"><button class="btnSubmit d-none" id="btnClick" type="submit"></form>`);
        $('#btnClick').click();
      }
    })
}

function gantiFilter(tipe, value = ""){
  let bulan = "";
  let tahun = "";
  if(tipe == "-" || tipe == "+"){
    bulan = $('#filterBulan')[0].selectedIndex;
    tahun = $('#filterTahun')[0].selectedIndex;
  }
  if(tipe == "-" && bulan >= 0 && tahun >= 0){
    bulan = bulan == 0 ? 12 : bulan;
    console.log(bulan);
    $('#filterBulan')[0].selectedIndex = bulan-1;
    $('#filterTahun')[0].selectedIndex = tahun-1;
  }else if(tipe == "+" && bulan < 12 && tahun < 6){
    console.log(tahun);
    bulan = bulan == 11 ? 0 : bulan + 1;
    $('#filterBulan')[0].selectedIndex = bulan;
    $('#filterTahun')[0].selectedIndex = tahun+1;
  }else if(tipe == "Bulan"){
    $('#filterBulan')[0].selectedIndex = value;
  }else if(tipe == "Tahun"){

    $('#filterTahun')[0].selectedIndex = value;
  }
  $('#btnFilter').trigger("click");
}

$('.tgl').datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: "dd-mm-yy",
    prevText: '<i class="fa fa-caret-left"></i>',
    nextText: '<i class="fa fa-caret-right"></i>',
});

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