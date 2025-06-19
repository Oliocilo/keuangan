  <div class="errorValidate" style="display:none"><ul></ul></div>
 <div class="j-wrapper j-wrapper-640">
     <form class="j-pro"  novalidate=""  id="formajax" action="<?= base_url('book/update') ?>" autocomplete="off">
        <div class="j-content">
            
            <div class="j-row">
                <div class="j-span7 j-unit">
                    <label class="j-label">Tanggal</label>
                    <div class="j-input">
                        <label class="j-icon-right" for="date_from">
                            <i class="fa fa-calendar"></i>
                        </label>
                        <input type="text" id="date_from" name="tanggal" readonly="" value="<?=date('Y-m-d',strtotime($dataEdit['tanggal']))?>">
                    </div>
                </div>
                <div class="j-span5 j-unit">
                    <label class="j-label">Jam</label>
                    <div class="j-input" >
                        <label class="j-icon-right" for="date_to">
                            <i class="fa fa-clock-o"></i>
                        </label>
                        <input type="text"  id="jam" name="jam" value="<?=date('H:i',strtotime($dataEdit['tanggal']))?>">
                    </div>
                </div>
            </div>
              <div class="j-unit">
                <label class="j-label">Dari</label>
                <label class="j-input j-select">
                    <select id="bukuFrom" name="buku_from" onchange="pilihBuku('Dari', this.value)">
                        <option value="" selected disabled>Pilih Buku Kas</option>
                        <?php foreach ($buku as $key => $bk) {?>
                            <option value="<?=$bk['id_buku']?>" <?= $bk['id_buku'] == $kodeTransfer[0] ? 'selected' : '' ?>><?=$bk['nama']?></option>
                        <?php } ?>
                    </select>
                    <i></i>
                </label>
            </div>
            <div class="j-unit">
                <label class="j-label">Ke</label>
                <label class="j-input j-select">
                    <select id="bukuTo" name="buku_to" onchange="pilihBuku('Ke', this.value)">
                        <option value="" selected disabled>Pilih Buku Kas</option>
                        <?php foreach ($buku as $key => $bk) {?>
                            <option value="<?=$bk['id_buku']?>" <?= $bk['id_buku'] == $kodeTransfer[1] ? 'selected' : '' ?>><?=$bk['nama']?></option>
                        <?php } ?>
                    </select>
                    <i></i>
                </label>
            </div>
          
            <div class="j-unit">

                <label class="j-label">Nominal</label>
                <div class="input">
                    <input type="text" name="nominal" class="currency" data-a-sign="Rp. " value="<?=$dataEdit['tipe'] == 'Pengeluaran' ? $dataEdit['nominal'] * -1 : $dataEdit['nominal'] ?>">
                </div>
            </div>
            <div class="j-divider j-gap-bottom-25"></div>
            <div class="j-unit">
                <label class="j-label">Keterangan/Referensi</label>
                <div class="j-input">
                    <textarea spellcheck="false" name="keterangan"><?=$dataEdit['deskripsi']?></textarea>
                </div>
            </div>
        </div>
        <div class="j-footer">
            <input type="hidden" name="idTrans" value="<?=$dataEdit['id']?>">
            <button type="submit" class="btn btn-primary waves-effect btnSubmit">Simpan</button>
            <button type="button" class="btn btn-default waves-effect m-r-5" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    function pilihBuku(asal, value){
        let idFirst = asal == "Dari" ? "#bukuTo" : "#bukuFrom";
        let idSecond = asal == "Dari" ? "#bukuFrom" : "#bukuTo";
        if($(idFirst).val() == null) $(`${idFirst} option[value="${value}"]`).hide();
        if($(idFirst).val() == $(idSecond).val()){
            $(idFirst).html(`
                    <option value="" selected disabled>Pilih Buku Kas</option>
                    <?php foreach ($buku as $key => $bk) {?>
                        <option value="<?=$bk['id_buku']?>"><?=$bk['nama']?></option>
                    <?php } ?>
            `);
            $(`${idFirst} option[value="${$(idSecond).val()}"]`).hide();
        }
    }
    $('#date_from').datepicker({
        dateFormat: "dd-mm-yy",
        prevText: '<i class="fa fa-caret-left"></i>',
        nextText: '<i class="fa fa-caret-right"></i>',
    });

     $('.currency').autoNumeric('init', {
        aPad: false, 
        mDec: 0, 
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