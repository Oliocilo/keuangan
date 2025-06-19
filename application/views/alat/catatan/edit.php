 <div class="j-wrapper j-wrapper-640">
     <form class="j-pro" novalidate="" id="formajax" action="<?= base_url('alat/catatan/update/'.$rtc['id']) ?>" autocomplete="off">
        <div class="j-content p-0" id="parentCatatan" style="background-color: <?=$rtc['warna_latar']?>">
            <textarea name="deskripsi" class="inputCatatan" style="color: <?=$rtc['warna_teks']?>;"><?=$rtc['catatan']?></textarea>
        </div>
        <div class="j-footer" style="background-color: <?=$rtc['warna_latar']?>">
            <div class="row">
                <div class="col-6 p-0">
                    <div class="form-group">
                        <div class="input-group date" id="datetimepicker1">
                            <span class="input-group-addon ">Latar</span>
                            <input name="warna_latar" type="color" value="<?=$rtc['warna_latar']?>" class="form-control" onchange="gantiWarna('Latar', this.value)">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group date" id="datetimepicker1">
                            <span class="input-group-addon ">Teks</span>
                            <input name="warna_teks" type="color" value="<?=$rtc['warna_teks']?>" class="form-control" onchange="gantiWarna('Teks', this.value)">
                        </div>
                    </div>
                </div>
                <div class="col-6 p-0 d-flex align-items-center justify-content-center">
                    <div>
                        <button type="submit" class="btn btn-primary waves-effect btnSubmit">Simpan</button>
                        <button type="button" class="btn btn-danger waves-effect m-r-5" onclick="deleteAlert('<?=base_url('catatan/delete/'.$rtc['id'])?>')" data-toggle="tooltip" data-placement="top" title="Hapus Catatan">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>