 <div class="errorValidate" style="display:none"><ul></ul></div>
 <div class="j-wrapper j-wrapper-640">
     <form class="j-pro"  novalidate=""  id="formajax" action="<?= base_url('book/store/') ?>" autocomplete="off">
        <input type="hidden" name="tipe" value="<?=$type?>">
        <div class="j-content">
            
            <div class="j-row">
                <div class="j-span7 j-unit">
                    <label class="j-label">Tanggal</label>
                    <div class="j-input">
                        <label class="j-icon-right" for="date_from">
                            <i class="fa fa-calendar"></i>
                        </label>
                        <input type="text" id="date_from" name="tanggal" readonly="">
                    </div>
                </div>
                <div class="j-span5 j-unit">
                    <label class="j-label">Jam</label>
                    <div class="j-input" >
                        <label class="j-icon-right" for="date_to">
                            <i class="fa fa-clock-o"></i>
                        </label>
                        <input type="text"  id="jam" name="jam" >
                    </div>
                </div>
            </div>
            <div class="j-unit">
                <label class="j-label">Dari</label>
                <label class="j-input j-select">
                    <select id="bukuFrom" name="buku_from" onchange="pilihBuku('Dari', this.value)">
                        <option value="" selected disabled>Pilih Buku Kas</option>
                        <?php foreach ($buku as $key => $bk) {?>
                            <option value="<?=$bk['id_buku']?>" <?= $bk['id_buku'] == $id_buku ? 'selected' : '' ?>><?=$bk['nama']?></option>
                        <?php } ?>
                    </select>
                    <i></i>
                </label>
            </div>
            <div class="j-unit">
                <label class="j-label">Ke</label>
                <label class="j-input j-select">
                    <select id="bukuTo" name="buku_to" onchange="pilihBuku('Ke', this.value)">
                        <option value="" selected disabled>Pilih Buku Kas</option>
                        <?php foreach ($buku as $key => $bk) {?>
                            <option value="<?=$bk['id_buku']?>"><?=$bk['nama']?></option>
                        <?php } ?>
                    </select>
                    <i></i>
                </label>
            </div>
            <div class="j-unit">

                <label class="j-label">Nominal</label>
                <div class="input">
                    <input type="text" name="nominal" class="currency" data-a-sign="Rp. ">
                </div>
            </div>
            <div class="j-divider j-gap-bottom-25"></div>
            <div class="j-unit">
                <label class="j-label">Keterangan/Referensi</label>
                <div class="j-input">
                    <textarea spellcheck="false" name="keterangan"></textarea>
                </div>
            </div>
        </div>
        <div class="j-footer">
            <button type="submit" class="btn btn-primary waves-effect btnSubmit">Simpan</button>
            <button type="button" class="btn btn-default waves-effect m-r-5" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    function pilihBuku(asal, value){
        let idFirst = asal == "Dari" ? "#bukuTo" : "#bukuFrom";
        let idSecond = asal == "Dari" ? "#bukuFrom" : "#bukuTo";
        if($(idFirst).val() == null) $(`${idFirst} option[value="${value}"]`).hide();
        if($(idFirst).val() == $(idSecond).val()){
            $(idFirst).html(`
                    <option value="" selected disabled>Pilih Buku Kas</option>
                    <?php foreach ($buku as $key => $bk) {?>
                        <option value="<?=$bk['id_buku']?>"><?=$bk['nama']?></option>
                    <?php } ?>
            `);
            $(`${idFirst} option[value="${$(idSecond).val()}"]`).hide();
        }
    }
    $('#date_from').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "mm/dd/yy",
        prevText: '<i class="fa fa-caret-left"></i>',
        nextText: '<i class="fa fa-caret-right"></i>',
    });

     $('.currency').autoNumeric('init', {
        aSep: '.', 
        aDec: ',',
        aForm: true,
        aPad: false,
        vMin: 0,
     });

     $('#jam').datetimepicker({
            // Formats
            // follow MomentJS docs: https://momentjs.com/docs/#/displaying/format/
            format: 'HH:mm',
            
            // Your Icons
            // as Bootstrap 4 is not using Glyphicons anymore
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-check',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
        });


     $("#formAddTransaksi").submit(function(){
      var mydata = new FormData(this);
      var form = $(this);
      $.ajax({
        type: "POST",
        url: baseUrl+"book/store",
        data: mydata,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend : function(){

        $(".errorValidate").hide();
          $(".btnsubmit").addClass("disabled").html("<i class='fa fa-spinner fa-spin'></i>  Send...");
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
          console.log(str)
          if (str.status == 'sukses'){
           Swal.fire(
                'Success!',
                str.text,
                str.status
            )
            $("#default-Modal").modal("toggle");
            newcs.ajax.reload(null, false);
            $(".btnsubmit").removeClass("disabled").html("Simpan");
        }else{

            $(".errorValidate").hide().html(str.html).slideDown("fast");
            $(".btnsubmit").removeClass("disabled").html("Simpan");
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
</script>