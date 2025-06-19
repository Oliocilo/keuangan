 <div class="j-wrapper j-wrapper-640">
     <form class="j-pro" novalidate="" id="formajax" action="<?= base_url('master/kategori/update/'.$rtc['id_kategori']) ?>" autocomplete="off">
        <div class="j-content">
            
            <div class="j-unit">
                <label class="j-label">Deskripsi Kategori  <small class="text-danger">*</small></label>
                <div class="input">
                    <input type="hidden" name="tipe" value="<?=$rtc['id_tipe_transaksi']?>">
                    <input type="text" name="nama" value="<?=$rtc['nama_kategori']?>">
                </div>
            </div>

        </div>
        <div class="j-footer">
            <button type="submit" class="btn btn-primary waves-effect btnSubmit">Simpan</button>
            <button type="button" class="btn btn-default waves-effect m-r-5" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>