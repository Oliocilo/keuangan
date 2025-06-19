<div class="errorValidate" style="display:none"><ul></ul></div>
<div class="j-wrapper j-wrapper-640">
    <form class="j-pro" novalidate="" id="formajax" action="<?= base_url('utangpiutang/updateDetail/'.$dataEdit['id']) ?>" autocomplete="off">
        <div class="j-content">
            
            <div class="j-row">
                <div class="j-span7 j-unit">
                    <label class="j-label">Tanggal  <small class="text-danger">*</small></label>
                    <div class="j-input">
                        <label class="j-icon-right" for="date_from">
                            <i class="fa fa-calendar"></i>
                        </label>
                        <input type="text" class="date_from" name="tanggal" readonly="" value="<?=date('Y-m-d',strtotime($dataEdit['tanggal_perbarui']))?>">
                    </div>
                </div>
                <div class="j-span5 j-unit">
                    <label class="j-label">Jam  <small class="text-danger">*</small></label>
                    <div class="j-input" >
                        <label class="j-icon-right" for="date_to">
                            <i class="fa fa-clock-o"></i>
                        </label>
                        <input type="text" class="jam" name="jam" value="<?=date('H:i',strtotime($dataEdit['tanggal_perbarui']))?>">
                    </div>
                </div>
            </div>
            <div class="j-unit">
                <label class="j-label">Nominal  <small class="text-danger">*</small></label>
                <div class="input">
                    <input type="text" name="nominal" class="currency" data-a-sign="Rp. " value="<?= $dataEdit['nominal'] ?>">
                </div>
            </div>
            <div class="j-divider j-gap-bottom-25"></div>
            <div class="j-unit">
                <label class="j-label">Keterangan/Referensi</label>
                <div class="input">
                    <input type="hidden" name="klien" value="<?=$dataEdit['klien']?>">
                    <input type="hidden" name="tipe" value="<?=$dataEdit['id_tipe_transaksi'] ?>">
                    <input type="hidden" name="tipenya" value="<?=$dataEdit['tipe']?>">
                    <input type="hidden" name="id_transaksi" value="<?=$dataEdit['id']?>">
                    <input type="hidden" name="id_buku_transaksi" value="<?=$dataEdit['id_buku_transaksi']?>">
                    <textarea spellcheck="false" name="keterangan"><?=$dataEdit['deskripsi']?></textarea>
                </div>
            </div>
            <div class="j-unit">
                <div class="checkbox-fade fade-in-primary mt-0">
                    <label>
                        <?php 
                            $catatCheck = ''; $catatAria = 'true'; $catatClass = 'class="collapsed"'; $catatCollapse = '';
                            if($id_buku != '') { $catatCheck = 'checked'; $catatAria = 'false'; $catatClass = ''; $catatCollapse = 'show';}
                        ?>
                        <input <?= $catatCheck.$catatClass ?> type="checkbox" value="true" name="catat" data-toggle="collapse" href="#collapseCatat" aria-expanded="<?= $catatAria ?>" aria-controls="collapseCatat">
                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                        <span class="text-inverse">Catat Sebagai <?=$jenis?> di Buku Kas</span>
                    </label>
                </div>
            </div>
            <div class="panel-collapse collapse in <?= $catatCollapse ?>" id="collapseCatat" role="tabpanel" aria-labelledby="headingCatat">
                <div class="j-unit">
                    <label class="j-label">Buku Kas</label>
                    <label class="j-input j-select">
                        <select name="id_buku">
                            <option value="" selected disabled>Pilih Buku</option>
                            <?php foreach ($buku as $key => $bk) {
                                $text = $bk['id_buku'] == $id_buku ? 'selected' : '';
                                ?>
                                <option value="<?=$this->template->matEnc($bk['id_buku'])?>" <?=$text?>><?=$bk['nama']?></option>
                            <?php } ?>
                        </select>
                        <i></i>
                    </label>
                </div>
                <div class="j-unit">
                    <label class="j-label">Kategori</label>
                    <label class="j-input j-select">
                        <select name="kategori">
                            <option value="" selected disabled>Pilih Kategori</option>
                            <?php foreach ($kategori as $key => $kat) {
                                $text = $kat['id_kategori'] == $id_kategori ? 'selected' : '';
                                ?>
                                <option value="<?=$kat['id_kategori']?>" <?=$text?>><?=$kat['nama_kategori']?></option>
                            <?php } ?>
                        </select>
                        <i></i>
                    </label>
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
    $('.date_from').datepicker({
        minDate: new Date("<?=$dataEdit['tanggal_awal']?>"),
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
        vMax: <?=$dataEdit['nominal']?>
     });

     $('.jam').datetimepicker({
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
</script>