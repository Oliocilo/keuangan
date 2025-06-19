<div class="j-wrapper">
     <div class="j-pro" >
        <div class="j-content">
            <div class="j-row">
                <div class="j-span4">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nomor Penjualan</th>
                            <th style="width:1px">:</th>
                            <td><?=$rtc['no_penjualan']?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Penjualan</th>
                            <th style="width:1px">:</th>
                            <td><?=$rtc['tanggal']?></td>
                        </tr>
                        <tr>
                            <th>Jumlah Barang</th>
                            <th style="width:1px">:</th>
                            <td><?=$rtc['jumlah_barang']?></td>
                        </tr>
                        <tr>
                            <th>Jumlah Item</th>
                            <th style="width:1px">:</th>
                            <td><?=$rtc['jumlah_item']?></td>
                        </tr>
                    </table>
               
            </div>
            <div class="j-span8">
                <table id="tblbarangdetail" data-penjualan="<?=$rtc['id']?>" class="table custom-table table-hover table-bordered thead-center dataTable table-responsive d-lg-table" width="100%">
                    <thead style="display: table-header-group;">
                        <tr>
                            <th class="min-mobile">Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga Beli</th>
                            <th>Total Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Total Harga Jual</th>
                        </tr>
                    </thead>
                <tbody>
                    
                </tbody>
                </table>
            </div>
        </div>
            <div class="j-divider j-gap-bottom-25"></div>
           
        </div>
        <div class="j-footer">
            <button type="button" class="btn btn-default waves-effect m-r-5" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>


 <?php if($dataloadmodal){ ?>
        <script src="<?=base_url('assets')?>/formjs/<?=$dataloadmodal?>"></script>
    <?php } ?>

