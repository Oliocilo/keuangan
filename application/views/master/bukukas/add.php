 <div class="errorValidate" style="display:none"><ul></ul></div>
 <div class="j-wrapper j-wrapper-640">
     <form class="j-pro"  novalidate=""  id="formajax" action="<?= base_url('master/bukukas/store') ?>" autocomplete="off">
        <input type="hidden" name="tipe" value="<?=$type?>">
        <div class="j-content">
            
            <div class="j-unit">

                <label class="j-label">Nama Buku Kas  <small class="text-danger">*</small></label>
                <div class="input">
                    <input type="text" name="nama">
                </div>
            </div>
            <div class="j-unit">

                <label class="j-label">Saldo Awal  <small class="text-danger">*</small></label>
                <div class="input">
                    <input type="text" name="saldo_awal" class="currency" data-a-sign="Rp. ">
                </div>
            </div>
            <div class="j-unit">
                <label class="j-label">Deskripsi</label>
                <div class="j-input">
                    <textarea spellcheck="false" name="deskripsi"></textarea>
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
    $('.currency').autoNumeric('init', {
        aSep: '.', 
        aDec: ',',
        aForm: true,
        aPad: false,
        vMin: 0,
     });
</script>