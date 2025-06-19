 <div class="j-wrapper j-wrapper-640">
     <form class="j-pro" novalidate="" id="formajax" action="<?= base_url('alat/catatan/store/') ?>" autocomplete="off">
        <div class="j-content p-0" id="parentCatatan">
            <textarea name="deskripsi" class="inputCatatan"></textarea>
        </div>
        <div class="j-footer">
            <div class="row">
                <div class="col-6 p-0">
                    <div class="form-group">
                        <div class="input-group date" id="datetimepicker1">
                            <span class="input-group-addon ">Latar</span>
                            <input name="warna_latar" type="color" value="#ffffff" class="form-control" onchange="gantiWarna('Latar', this.value)">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group date" id="datetimepicker1">
                            <span class="input-group-addon ">Teks</span>
                            <input name="warna_teks" type="color" value="#000000" class="form-control" onchange="gantiWarna('Teks', this.value)">
                        </div>
                    </div>
                </div>
                <div class="col-6 p-0 d-flex align-items-center justify-content-center">
                    <div>
                        <button type="submit" class="btn btn-primary waves-effect btnSubmit">Simpan</button>
                        <button type="button" class="btn btn-default waves-effect m-r-5" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php if($dataloadmodal){ ?>
    <script src="<?=base_url('assets')?>/formjs/<?=$dataloadmodal?>"></script>
<?php } ?>