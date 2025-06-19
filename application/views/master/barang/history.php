 
   
                    <input type="hidden" name="id_barang" id="id_barang" value="<?=$rtc['id_barang']?>">
        <div class="p-10">
                <table id="exampleStok" class="table custom-table table-hover table-bordered thead-center dataTable table-condensed" width="100%" data-tipe="OUT">
                    <thead>
                        <tr>
                            <th class="min-mobile">No. Invoice</th>
                            <th>Tanggal Invoice</th>
                            <th>Stok Keluar</th>
                            <th>Harga Pembelian</th>
                            <th>Harga Penjualan</th>
                            <th>Keterangan</th>
                            <th class="min-mobile">Pembaru</th>
                        </tr>
                    </thead>
                </table>
            </div>

        <div class="j-pro">
        <div class="j-footer">
            <button type="button" class="btn btn-default waves-effect m-r-5" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    
</div>

   
  <?php if($dataloadmodal){ ?>
        <script src="<?=base_url('assets')?>/formjs/<?=$dataloadmodal?>"></script>
    <?php } ?>
