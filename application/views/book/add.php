 <div class="errorValidate" style="display:none"><ul></ul></div>
 <div class="j-wrapper j-wrapper-640">
     <form class="j-pro"  novalidate=""  id="formajax" action="<?= base_url('book/store/') ?>" autocomplete="off">
        <div class="j-content">
            
            <div class="j-row">
                <div class="j-span7 j-unit">
                    <label class="j-label">Tanggal</label>
                    <div class="j-input">
                        <label class="j-icon-right" for="date_from">
                            <i class="fa fa-calendar"></i>
                        </label>
                        <input type="text" id="date_from" name="tanggal" readonly="">
                    </div>
                </div>
                <div class="j-span5 j-unit">
                    <label class="j-label">Jam</label>
                    <div class="j-input" >
                        <label class="j-icon-right" for="date_to">
                            <i class="fa fa-clock-o"></i>
                        </label>
                        <input type="text"  id="jam" name="jam" >
                    </div>
                </div>
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
            <div class="j-unit">

                <label class="j-label">Nominal</label>
                <div class="input">
                    <input type="text" name="nominal" class="currency" data-a-sign="Rp. ">
                </div>
            </div>
            <div class="j-divider j-gap-bottom-25"></div>
            <div class="j-unit">
                <label class="j-label">Keterangan/Referensi</label>
                <div class="j-input">
                    <textarea spellcheck="false" name="keterangan"></textarea>
                </div>
            </div>
        </div>
        <div class="j-footer">
            <input type="hidden" name="tipe" value="<?=$type?>">
            <input type="hidden" name="id_buku" value="<?=$id_buku?>">
            <button type="submit" class="btn btn-primary waves-effect btnSubmit">Simpan</button>
            <button type="button" class="btn btn-default waves-effect m-r-5" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $('#date_from').datepicker({
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
     });

     $('#jam').datetimepicker({
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