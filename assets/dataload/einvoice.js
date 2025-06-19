$(document).ready(function() {

    let item = 1;
    $('#addItem').click(function(){
     item ++;
     var myvar = '<tr>'+
     '<td style="width:40px">'+
     '<input type="text" class="form-control inputCenter numberID bgabu req" id="id_'+item+'" name="id[]">'+
     '</td>'+
     '<td>'+
     '<textarea class="form-control bgabu req" id="desc_'+item+'" name="desc[]"></textarea>'+
     ''+
     '</td>'+
     '<td>'+
     '<input type="text" class="form-control inputCenter ganti bgabu" id="qty_'+item+'" name="qty[]" value="1"></td>'+
     '<td>'+
     '<input type="text" class="form-control text-right currency ganti bgabu" name="harga[]" id="harga_'+item+'"></td>'+
     '<td>'+
     '<input type="text" class="form-control text-right currency noaction bgabu" readonly name="total[]" id="total_'+item+'"></td>'+
     '<td class="text-center">'+
     '<button class="btn btn-sm btn-danger delItem"><i class="fa fa-times"></i></button>'+
     '</td>'+
     '</tr>';

     $('#tblinv').find('tbody').append(myvar);
     urutan()
     $('.currency').autoNumeric('init', {
      aPad: false, 
      mDec: 0, 
      aSep: '.', 
      aDec: ',',
      aForm: true,
      aPad: false,
      vMin: 0,
  });

 })


    $(document).on("click", ".delItem", function () {
    	$(this).closest('tr').remove();
    });

    $('.currency').autoNumeric('init', {
      aPad: false, 
      mDec: 0, 
      aSep: '.', 
      aDec: ',',
      aForm: true,
      aPad: false,
      vMin: 0,
  });

    $(document).on("keyup", ".ganti", function () {
        hitungan()
    })

    $(document).on("focus", ".bgabu", function () {
        $(this).css('background','white');
    })
    $(document).on("blur", ".bgabu", function () {
        $(this).css('background','#efefef');
    })



    $('#iskirim').change(function () {
        if ($(this).is(':checked')) {
            $('.kirimInp').prop('readonly', false).removeClass('noaction');
        } else {
            $('.kirimInp').prop('readonly', true).addClass('noaction');
        }
    });


    $('.enableInputCheckbox').change(function () {
        var attrname = $(this).attr('name');
        if ($(this).is(':checked')) {
            $('#'+attrname).prop('readonly', false).removeClass('noaction').autoNumeric('set',0);;
        } else {
            $('#'+attrname).prop('readonly', true).addClass('noaction').autoNumeric('set',0);
        }
        hitungan()
    });

    $('.inputStempel').change(function () {
        var attrname = $(this).attr('name');
        if ($(this).is(':checked')) {
            $('.'+attrname).removeClass('hidden');
        } else {
            $('.'+attrname).addClass('hidden');
        }
        hitungan()
    });

    $("#autocomplete-input").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: baseUrl+'alat/einvoice/getPelanggan',
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function(data) {
                    response($.map(data, function (el) {
                       return {
                        label: el.nama,
                        text: el.nama,
                        value: el.id,
                        alamat_1: el.alamat_1,
                        alamat_2: el.alamat_2,
                        alamat_3: el.alamat_3
                    };
                }));
                }
            });
        },
        select: function (event, ui) {
        // Prevent value from being put in the input:
            this.value = ui.item.text;
            $('#addtgh1').val(ui.item.alamat_1);
            $('#addtgh2').val(ui.item.alamat_2);
            $('#addtgh3').val(ui.item.alamat_3);
            event.preventDefault();
        },
        minLength: 2
    }).autocomplete("instance")._renderItem = function(ul, item) {
        return $("<li class='each'>")
        .append("<div class='acItem'><span class='name'>" +
            item.label + "</span><br><span class='desc'>" +
            item.alamat_1 + "</span><br><span class='desc'>" +
            item.alamat_2 + "</span><br><span class='desc'>" +
            item.alamat_3 + "</span></div>")
        .appendTo(ul);
    };;


} );

function urutan() {
    var no =0;
    $('.numberID').each(function(){
        no++;
        $(this).val(no);
    });
}

function hitungan() {
   var no =0;
   var totalAll = 0;
   $('.numberID').each(function(){
    no++;
    var hargaText  = $('#harga_'+no).val();
    var qty = $('#qty_'+no).val();
    var harga = parseFloat(hargaText.replace(/[^0-9.]/g, ""));
    var total = harga * qty;
    totalAll += total;
    $('#total_'+no).autoNumeric('set',total);
});
   $('#subtotal').autoNumeric('set',totalAll);

   $('.tambah').each(function(){
       var tambahan = $(this).val();
       totalAll += parseFloat(tambahan.replace(/[^0-9.]/g, ""));
   });

   $('.kurang').each(function(){
       var kurangan = $(this).val();
       totalAll += parseFloat(kurangan.replace(/[^0-9.]/g, ""));
   });

   $('#totalfinal').autoNumeric('set',totalAll);

}



$(document).ready(function () {
    $('#file-input').on('change', function () {

        $('#progress-bar').css('background-color','#4CAF50');
        var fileInput = $('#file-input')[0].files[0];
        var formData = new FormData();

        formData.append('file', fileInput);
        $.ajax({
            url: baseUrl+'alat/einvoice/uploadLogo',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function () {
                var xhr = new XMLHttpRequest();
                xhr.upload.addEventListener('progress', function (e) {
                    if (e.lengthComputable) {
                        var percentComplete = (e.loaded / e.total) * 100;
                        $('#progress-bar').css('width', percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            success: function (response) {
                var data = JSON.parse(response);
                if(data.response === true){
                    $('#progress-bar').css('background-color','transparent');
                    $('.logoinvoice').attr('src',baseUrl+data.message.dir);
                }else{
                    $('#progress-bar').css('background-color','transparent');
                    Swal.fire({
                        title: 'Oops...',
                        icon: 'error',
                        html: data.message,
                    })
                }
                $('#file-input').val('');

            },
            error: function () {
                // Handle the error
                console.log('Upload failed');
            }
        });
    });

    $(document).on("click", ".btnSubmitINV", function () {
        var err = 0;
        $('.req').each(function(){
            var isian = $(this).val();
            if(isian == ''){
                err +=1;
            }
        });

        if(err > 0){
            Swal.fire({
                title: 'Oops...',
                icon: 'error',
                html: 'Semua kolom yang bertanda * harus diisi',
            })
        }else{
            $('#formInv').submit();
        }
    });
});






