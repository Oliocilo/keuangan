 <div class="j-wrapper j-wrapper-640">
     <form class="j-pro"  novalidate="" id="formajax" action="<?= base_url('master/bukukas/update/'.$rtc['id_buku']) ?>" autocomplete="off">
        <div class="j-content">
            
            <div class="j-unit">

                <label class="j-label">Nama Buku Kas  <small class="text-danger">*</small></label>
                <div class="input">
                    <input type="text" name="nama" value="<?=$rtc['nama']?>">
                </div>
            </div>
            <div class="j-unit">

                <label class="j-label">Saldo Awal  <small class="text-danger">*</small></label>
                <div class="input">
                    <input type="text" name="saldo_awal" value="<?=$rtc['saldo_awal']?>" class="currency" data-a-sign="Rp. ">
                </div>
            </div>
            <div class="j-unit">
                <label class="j-label">Deskripsi</label>
                <div class="j-input">
                    <textarea spellcheck="false" name="deskripsi"><?=$rtc['deskripsi']?></textarea>
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
    $(document).ready(function() {
        $('.currency').autoNumeric('init', {
        aSep: '.', 
        aDec: ',',
        aForm: true,
        aPad: false,
        vMin: 0,
     });
    });
</script>