<div class="errorValidate" style="display:none"><ul></ul></div>
<div class="j-wrapper j-wrapper-640">
    <form class="j-pro" novalidate="" action="<?= base_url('master/aset_kategori/update/') ?>" id="formajax" autocomplete="off">
        <div class="j-content">

             <div class="j-unit">
                <label class="j-label">Kode Kategori  <small class="text-danger">*</small></label>
                <div class="input">
                    <input type="text" name="kode" value="<?=$rtc['kode_kategori']?>">
                </div>
            </div>
            
            <div class="j-unit">
                <label class="j-label">Nama Kategori  <small class="text-danger">*</small></label>
                <div class="input">
                    <input type="hidden" name="id" value="<?=$rtc['id']?>">
                    <input type="text" name="nama" value="<?=$rtc['nama_kategori']?>">
                </div>
            </div>

        </div>
        <div class="j-footer">
            <button type="submit" class="btn btn-secondary waves-effect btnSubmit">Simpan</button>
            <button type="button" class="btn btn-default waves-effect m-r-5" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>