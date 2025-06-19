<div class="errorValidate" style="display:none"><ul></ul></div>
<div class="j-wrapper">
     <form class="j-pro" novalidate="" id="formajaxCustom" action="<?= base_url('penjualanbarang/storeBarang') ?>" autocomplete="off">
        <div class="j-content">
            <div class="j-row">
                <div class="j-unit">
                    <label class="j-label">Nama Barang <small class="text-danger">*</small></label>
                    <div class="input">
                       <select class="select2" name="nama_barang">
                           <option value=""></option>
                       </select>
                    </div>
                </div>
                <div class="j-unit">
                    <label class="j-label">Jumlah  <small class="text-danger">*</small></label>
                    <div class="input">
                        <input type="text" name="jumlah">
                    </div>
                </div>
                <div class="j-unit">
                    <label class="j-label">Harga Pembelian <small class="text-danger">*</small></label>
                    <div class="input">
                        <input type="text" id="harga_beli" readonly name="harga_beli" class="currency" data-a-sign="Rp. ">
                    </div>
                </div>
                <div class="j-unit">
                    <label class="j-label">Harga Penjualan <small class="text-danger">*</small></label>
                    <div class="input">
                        <input type="text" id="harga_jual" readonly name="harga_jual" class="currency" data-a-sign="Rp. ">
                    </div>
                </div>
            </div>
         
        </div>
        <div class="j-footer">
            <button type="submit" class="btn btn-primary waves-effect btnSubmitCustom">Simpan</button>
            <button type="button" class="btn btn-default waves-effect m-r-5" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>



    <script type="text/javascript" src="<?= base_url('assets') ?>/bower_components/select2/js/select2.full.min.js"></script>
     <?php if($dataloadmodal){ ?>
        <script src="<?=base_url('assets')?>/formjs/<?=$dataloadmodal?>"></script>
    <?php } ?>
    <script type="text/javascript">
        
     $('.currency').autoNumeric('init', {
        aSep: '.', 
        aDec: ',',
        aForm: true,
        aPad: false,
        vMin: 0,
     });
    </script>