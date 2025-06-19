  <div class="errorValidate" style="display:none"><ul></ul></div>
 <div class="j-wrapper j-wrapper-640">
     <form class="j-pro" novalidate="" action="<?= base_url('alat/einvoice/updatePelanggan/') ?>" id="formajax" autocomplete="off">

                    <input type="hidden" name="id" value="<?=$rtc['id']?>">
        <div class="j-content">
             <div class="j-unit">
                <label class="j-label">Nama <small class="text-danger">*</small></label>
                <div class="input">
                    <input type="text" name="nama" value="<?=$rtc['nama']?>">
                </div>
            </div>
            <div class="j-unit">
                <label class="j-label">Alamat Baris 1 <small class="text-danger">*</small></label>
                <div class="input">
                    <input type="text" name="alamat_1" value="<?=$rtc['alamat_1']?>">
                </div>
            </div>
            <div class="j-unit">
                <label class="j-label">Alamat Baris 2</label>
                <div class="input">
                    <input type="text" name="alamat_2" value="<?=$rtc['alamat_2']?>">
                </div>
            </div>
            <div class="j-unit">
                <label class="j-label">Alamat Baris 3</label>
                <div class="input">
                    <input type="text" name="alamat_3" value="<?=$rtc['alamat_3']?>">
                </div>
            </div>

        </div>
        <div class="j-footer">
            <button type="submit" class="btn btn-success waves-effect btnSubmit">Simpan</button>
            <button type="button" class="btn btn-default waves-effect m-r-5" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>