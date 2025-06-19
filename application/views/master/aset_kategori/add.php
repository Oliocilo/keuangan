<div class="errorValidate" style="display:none"><ul></ul></div>
<div class="j-wrapper j-wrapper-640">
    <form class="j-pro" novalidate="" action="<?= base_url('master/aset_kategori/store/') ?>" id="formajax" autocomplete="off">
        <div class="j-content">
             <div class="j-unit">
                <label class="j-label">Kode Kategori  <small class="text-danger">*</small></label>
                <div class="input">
                    <input type="text" name="kode">
                </div>
            </div>
            <div class="j-unit">
                <label class="j-label">Nama Kategori  <small class="text-danger">*</small></label>
                <div class="input">
                    <input type="text" name="nama">
                </div>
            </div>

        </div>
        <div class="j-footer">
            <button type="submit" class="btn btn-success waves-effect btnSubmit">Simpan</button>
            <button type="button" class="btn btn-default waves-effect m-r-5" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>