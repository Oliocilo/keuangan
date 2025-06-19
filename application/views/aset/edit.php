<div class="errorValidate" style="display:none"><ul></ul></div>
<div class="j-wrapper">
    <form class="j-pro"  novalidate=""  method="POST" action="<?= base_url('aset/update/'.$aset['id_aset']) ?>" autocomplete="off" id="formajax">
        <div class="j-content">
            
            <div class="j-row">

                 <div class="j-span4 j-unit">
                    <label class="j-label">Metode Penyusutan</label>
                    <label class="j-input j-select">
                        <select name="metode" id="metode" readonly>
                            <option value="" selected disabled>Pilih Metode</option>
                            <?php foreach ($metode as $key => $med) { 
                                $text = '';
                                if($med['slug'] == $aset['metode_penyusutan']){
                                    $text = 'selected';
                                }
                                ?>
                                <option value="<?=$med['slug']?>" <?=$text?>><?=$med['nama_metode']?></option>
                            <?php } ?>
                        </select>
                        <i></i>
                    </label>
                </div>

                <div class="j-span4 j-unit">
                    <label class="j-label">Kategori Aset</label>
                    <label class="j-input j-select">
                        <select name="kategori" id="kategori" readonly>
                            <option value="" selected disabled>Pilih Kategori</option>
                            <?php foreach ($kategori as $key => $kat) {
                                $text = '';
                                if($kat['id'] == $aset['kategori']){
                                    $text = 'selected';
                                }
                                ?>
                                <option value="<?=$kat['id']?>" <?=$text?>><?=$kat['nama_kategori']?></option>
                            <?php } ?>
                        </select>
                        <i></i>
                    </label>
                </div>
                 <div class="j-span4 j-unit">
                    <label class="j-label">Tanggal Perolehan</label>
                    <div class="j-input">
                        <label class="j-icon-right" for="date_from">
                            <i class="fa fa-calendar"></i>
                        </label>
                        <input type="text" id="date_from" value="<?=$aset['tanggal_pembelian']?>" name="tanggal" readonly="">
                    </div>
                </div>

                <div class="j-span6 j-unit">
                    <label class="j-label">Kode Aset</label>
                    <div class="j-input">
                        <input type="text" name="kode_aset" value="<?=$aset['kode_aset']?>" id="kode_aset" readonly>
                    </div>
                </div>
                <div class="j-span6 j-unit">
                    <label class="j-label">Nama Aset</label>
                    <div class="j-input">
                        <input type="text" name="nama_aset" value="<?=$aset['nama_aset']?>">
                    </div>
                </div>

                <div class="j-span4 j-unit">
                    <label class="j-label">Harga Beli</label>
                    <div class="input">
                        <input type="text" id="hargaBeli" name="harga_beli" class="currency hitung" data-a-sign="Rp. " value="<?=$aset['nilai_satuan']?>">
                    </div>
                </div>

                <div class="j-span4 j-unit">
                    <label class="j-label">Masa Manfaat (Tahun)</label>
                    <div class="j-input">
                        <input type="text" id="masaManfaat" class="numericInput hitung" name="masa_manfaat" value="<?=$aset['masa_manfaat']?>">
                    </div>
                </div>

                <div class="j-span4 j-unit garisLurusDiv">
                    <label class="j-label">Tarif Penyusutan (%)</label>
                    <div class="j-input">
                        <input type="text" id="tarifPenyusutan" class="numericInput hitung" name="tarif_penyusutan" value="<?=$aset['tarif_penyusutan']?>">
                    </div>
                </div>

                <div class="j-span4 j-unit garisLurusDiv">
                    <label class="j-label">Nilai Residu</label>
                    <div class="input">
                        <input type="hidden" id="nilaiResiduSistem" value="<?=$aset['nilai_residu']?>">
                        <input type="text" id="nilaiResidu" name="nilai_residu" class="currency" readonly data-a-sign="Rp. "value="<?=$aset['nilai_residu']?>">
                    </div>
                    <label class="m-t-5">
                        <input type="checkbox" id="checkedResidu" name="" checked> Kalkulasi by sistem
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
<?php 
if($aset['metode_penyusutan'] == 'saldo_menurun'){
?>
    <script>
        $('.garisLurusDiv').hide();
        $('#nilaiResidu').autoNumeric('init');
        $('#nilaiResidu').autoNumeric('set',0);
    </script>
<?php 
}
?>


<?php if($dataloadmodal){ ?>
    <script src="<?=base_url('assets')?>/formjs/<?=$dataloadmodal?>"></script>
<?php } ?>