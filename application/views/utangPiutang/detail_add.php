 
<div class="errorValidate" style="display:none"><ul></ul></div>
<div class="j-wrapper j-wrapper-640">
    <form class="j-pro" novalidate="" id="formajax" action="<?= base_url('utangpiutang/storeDetail/'.$idnya) ?>" autocomplete="off">
        <div class="j-content"> 
            <div class="j-row">
                <div class="j-span7 j-unit">
                    <label class="j-label">Tanggal  <small class="text-danger">*</small></label>
                    <div class="j-input">
                        <label class="j-icon-right" for="date_from">
                            <i class="fa fa-calendar"></i>
                        </label>
                        <input type="text" class="date_from" name="tanggal" min="<?=date('Y/m/d',strtotime($tanggal_awal))?>" readonly="">
                    </div>
                </div>
                <div class="j-span5 j-unit">
                    <label class="j-label">Jam  <small class="text-danger">*</small></label>
                    <div class="j-input" >
                        <label class="j-icon-right" for="date_to">
                            <i class="fa fa-clock-o"></i>
                        </label>
                        <input type="text" class="jam" name="jam" >
                    </div>
                </div>
            </div>
            <div class="j-unit">
                <label class="j-label">Nominal  <small class="text-danger">*</small></label>
                <div class="input">
                    <input type="text" name="nominal" class="currency" data-a-sign="Rp. ">
                </div>
            </div>
            <div class="j-divider j-gap-bottom-25"></div>
            <div class="j-unit">
                <label class="j-label">Keterangan/Referensi</label>
                <div class="input">
                    <input type="hidden" name="klien" value="<?=$klien?>">
                    <input type="hidden" name="jenis" value="<?=$jenis_tambah?>">
                    <input type="hidden" name="tipe" value="<?=$jenis == 'Pemasukan' ? 1 : 2?>">
                    <input type="hidden" name="tipenya" value="<?=$type?>">
                    <textarea spellcheck="false" name="keterangan"></textarea>
                </div>
            </div>
            <div class="j-unit">
                <div class="checkbox-fade fade-in-primary mt-0">
                    <label>
                        <input type="checkbox" value="true" name="catat" data-toggle="collapse" href="#collapseCatat" aria-expanded="true" aria-controls="collapseCatat">
                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                        <span class="text-inverse">Catat Sebagai <?=$jenis?> di Buku Kas</span>
                    </label>
                </div>
            </div>
            <div class="panel-collapse collapse in" id="collapseCatat" role="tabpanel" aria-labelledby="headingCatat">
                <div class="j-unit">
                    <label class="j-label">Buku Kas</label>
                    <label class="j-input j-select">
                        <select name="id_buku">
                            <option value="" selected disabled>Pilih Buku</option>
                            <?php foreach ($buku as $key => $bk) {?>
                                <option value="<?=$this->template->matEnc($bk['id_buku'])?>"><?=$bk['nama']?></option>
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
                            <?php foreach ($kategori as $key => $kat) {?>
                                <option value="<?=$kat['id_kategori']?>"><?=$kat['nama_kategori']?></option>
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
        minDate: new Date("<?=$tanggal_awal?>"),
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
        vMax: <?=$saldo_akhir?>
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