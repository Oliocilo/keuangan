<div class="errorValidate" style="display:none"><ul></ul></div>
<div class="j-wrapper">
     <form class="j-pro"  method="POST" action="<?= base_url('aset/store/') ?>" autocomplete="off" id="formajax">
        <div class="j-content">
            <div class="j-row">

                 <div class="j-span4 j-unit">
                    <label class="j-label">Metode Penyusutan</label>
                    <label class="j-input j-select">
                        <select name="metode" id="metode">
                            <option value="" selected disabled>Pilih Metode</option>
                            <?php foreach ($metode as $key => $med) {?>
                                <option value="<?=$med['slug']?>"><?=$med['nama_metode']?></option>
                            <?php } ?>
                        </select>
                        <i></i>
                    </label>
                </div>

                <div class="j-span4 j-unit">
                    <label class="j-label">Kategori Aset</label>
                    <label class="j-input j-select">
                        <select name="kategori" id="kategori">
                            <option value="" selected disabled>Pilih Kategori</option>
                            <?php foreach ($kategori as $key => $kat) {?>
                                <option value="<?=$kat['id']?>"><?=$kat['nama_kategori']?></option>
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
                        <input type="text" id="date_from" name="tanggal" readonly="">
                    </div>
                </div>

                <div class="j-span6 j-unit">
                    <label class="j-label">Kode Aset</label>
                    <div class="j-input">
                        <input type="text" name="kode_aset" id="kode_aset" readonly>
                    </div>
                </div>
                <div class="j-span6 j-unit">
                    <label class="j-label">Nama Aset</label>
                    <div class="j-input">
                        <input type="text" name="nama_aset">
                    </div>
                </div>

                <div class="j-span4 j-unit">
                    <label class="j-label">Harga Beli</label>
                    <div class="input">
                        <input type="text" id="hargaBeli" name="harga_beli" class="currency hitung" data-a-sign="Rp. ">
                    </div>
                </div>

                <div class="j-span4 j-unit">
                    <label class="j-label">Masa Manfaat (Tahun)</label>
                    <div class="j-input">
                        <input type="text" id="masaManfaat" class="numericInput hitung" name="masa_manfaat">
                    </div>
                </div>

                <div class="j-span4 j-unit garisLurusDiv">
                    <label class="j-label">Tarif Penyusutan (%)</label>
                    <div class="j-input">
                        <input type="text" id="tarifPenyusutan" class="numericInput hitung" name="tarif_penyusutan">
                    </div>
                </div>

               

                
           
               

                <div class="j-span4 j-unit garisLurusDiv">
                    <label class="j-label">Nilai Residu</label>
                    <div class="input">
                        <input type="hidden" id="nilaiResiduSistem" value="0">
                        <input type="text" id="nilaiResidu" name="nilai_residu" class="currency" readonly data-a-sign="Rp. ">
                    </div>
                    <label class="m-t-5">
                        <input type="checkbox" id="checkedResidu" name="check_nilai_residu" checked> Kalkulasi by sistem
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


    <?php if($dataloadmodal){ ?>
        <script src="<?=base_url('assets')?>/formjs/<?=$dataloadmodal?>"></script>
    <?php } ?>