$(document).ready(function() {
  $('.select2').select2({
           minimumInputLength: 3,
           language: {
            inputTooShort: function() {
              return 'Silahkan Masukan 3 Karakter atau Lebih';
            }
            },
           allowClear: true,
           placeholder: 'Masukkan Nama Barang',
           ajax: {
              dataType: 'json',
              url: baseUrl+'master/barang/getBarang',
              delay: 800,
              data: function(params) {
                return {
                  search: params.term
                }
              },
              processResults: function (data, page) {
                data = data.map(function (item) {
                // Add a disabled property to the item based on its value
                item.disabled = (item.stok < 1);
                if (item.disabled) {
                    item.text = item.text +' (Stok Habis)';
                }
                return item;
            });
              return {
                results: data
              };
            },
          }
      }).on('select2:select', function (e) {

          $('#harga_beli').autoNumeric('set','');
          $('#harga_jual').autoNumeric('set','');
        var selectedData = e.params.data;
          $('#harga_beli').autoNumeric('set',selectedData.harga_beli);
          $('#harga_jual').autoNumeric('set',selectedData.harga_jual);
    });
     

} );

$(document).on("click", ".btnSubmitCustom", function () {
    var mydata = new FormData(document.getElementById('formajaxCustom'));
    $.ajax({
      type: "POST",
      url: $('#formajaxCustom').attr('action'),
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
            
        var myvar = '<tr id="'+str.id_barang+'">'+
                    '<td>'+str.nama_barang+
                    '<input type="hidden" value="'+str.id_barang+'" name="namabarangkey[]">'+
                    '<input type="hidden" value="'+str.jumlah+'" name="jumlahkey[]">'+
                    '<input type="hidden" value="'+str.harga_beli_int+'" name="hargabelikey[]">'+
                    '<input type="hidden" value="'+str.harga_jual_int+'" name="hargajualkey[]">'+
                    '</td>'+
                    '<td>'+str.jumlah+'</td>'+
                    '<td>'+str.harga_beli_text+'</td>'+
                    '<td>'+str.total_harga_beli+'</td>'+
                    '<td>'+str.harga_jual_text+'</td>'+
                    '<td>'+str.total_harga_jual+'</td>'+
                    '<td><button type="button" class="btn btn-xs btn-danger btnremoveitem"><i class="fa fa-times"></i></button></td>'+
                    '</tr>';
          $('#tblbarangcart').find('tbody').find('#'+str.id_barang).remove();
          $('#tblbarangcart').find('tbody').append(myvar);
            Swal.fire(
                'Success!',
                'Barang Berhasil Ditambahkan',
                str.status
            )
            $('#default-Modal').modal('hide');
    

           
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