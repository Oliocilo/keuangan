$(document).ready(function() {
    $('.hitung').on('keyup', function() {
      resetInputAtribut();
      hitungAtribut();
   })

   $('#checkedResidu').on('change', function() {
      if(this.checked) {
         $('#nilaiResidu').autoNumeric('set',$('#nilaiResiduSistem').val()).attr('readonly');
      }else{
          $('#nilaiResidu').removeAttr('readonly').autoNumeric('set',0);
      }
   });

   $('#metode').on('change', function() {
      if($(this).val() == 'saldo_menurun') {
          $('.garisLurusDiv').hide();
          $('#nilaiResidu').autoNumeric('set',0);
      }else{

          $('.garisLurusDiv').show();


      }
   });

   $('#kategori').on('change', function() {
      $.ajax({
       type: "GET",
       url: baseUrl+"aset/buatkode/"+this.value,
       cache: false,
       success: function(data){
          $("#kode_aset").val(data);
       }
    });
   });

   $('.currency').autoNumeric('init', {
      aPad: false, 
      mDec: 0, 
      aSep: '.', 
      aDec: ',',
      aForm: true,
      vMin: 0,
    });

    $('.cHargaBeli').autoNumeric('init', {
        aPad: false, 
        mDec: 0, 
        aSep: '.', 
        aDec: ',',
        aForm: true,
        aPad: false,
        vMin: 0,
    });


} );

$('#date_from').datepicker({
  dateFormat: "mm/dd/yy",
  prevText: '<i class="fa fa-caret-left"></i>',
  nextText: '<i class="fa fa-caret-right"></i>',
});

$('.numericInput').on('input', function() {
   var inputValue = $(this).val();
   var numericValue = inputValue.replace(/[^0-9-]/g, '');
   $(this).val(numericValue);
});

function hitungAtribut() {
   var hargaBeliText = $('#hargaBeli').val();
   var hargaBeli = parseFloat(hargaBeliText.replace(/[^0-9.]/g, ""));
   var tarifPenyusutanPersen = parseFloat($('#tarifPenyusutan').val());
   var masaManfaat = parseFloat($('#masaManfaat').val());
   var jumlahQty = parseInt($('#jumlahQty').val());


   var tarifPenyusutan = tarifPenyusutanPersen / 100;
   var nilaiJumlah = hargaBeli * jumlahQty;
   var nilaiResidu = hargaBeli * Math.pow(1 - tarifPenyusutan, masaManfaat);
   var nilaiResiduTotal = nilaiResidu;
   if (!isNaN(nilaiResiduTotal)) {
      $('#nilaiResiduSistem').val(nilaiResiduTotal);
      if ($('#checkedResidu').is(':checked')) {
      $('#nilaiResidu').autoNumeric('set',nilaiResiduTotal);
      }
   }
   if (!isNaN(nilaiJumlah)) {
      $('#nilaiJumlah').autoNumeric('set',nilaiJumlah);
   }
}

function resetInputAtribut() {
   $('#nilaiResidu').val('');
   $('#nilaiJumlah').val('');
}
