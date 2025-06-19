<div class="j-wrapper">
     <form class="j-pro" novalidate="" method="POST" id="formajax" action="<?= base_url('penjualanbarang/store') ?>" autocomplete="off">
        <div class="j-content">
            <div class="j-row">
                <div class="j-span4">
                    <div class="errorValidate" style="display:none"><ul></ul></div>
                    <div class="j-unit mt-3">
                        <label class="j-label">No. Penjualan <small class="text-danger">*</small></label>
                        <div class="input">
                            <input type="text" name="nomor_penjualan">
                        </div>
                    </div>
                    <div class="j-row">
                        <div class="j-span8">
                            <div class="j-unit">
                                <label class="j-label">Tanggal Penjualan <small class="text-danger">*</small></label>
                                <div class="j-input">
                                    <label class="j-icon-right" for="date_from">
                                        <i class="fa fa-calendar"></i>
                                    </label>
                                    <input type="text" class="date_from" name="tanggal">
                                </div>
                            </div>
                        </div>
                        <div class="j-span4">
                            <div class="j-unit">
                                <label class="j-label">Jam Penjualan <small class="text-danger">*</small></label>
                                <div class="j-input" >
                                    <label class="j-icon-right" for="date_to">
                                        <i class="fa fa-clock-o"></i>
                                    </label>
                                    <input type="text" class="jam" name="jam">
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="j-unit">
                        <label class="j-label">Buku Kas</label>
                        <label class="j-input j-select">
                            <select name="id_buku">
                                <option value="" selected disabled>Pilih Buku</option>
                                <?php foreach ($buku as $key => $bk) {?>
                                    <option value="<?=$this->template->matEnc($bk['id_buku'])?>"><?=$bk['nama']?></option>
                                <?php } ?>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="j-span8">
                    <div class="j-span12 j-unit d-flex justify-content-end align-items-center">
                        <button type="button" onclick="addBarang()" class="btn btn-success waves-effect">Tambah Barang</button>
                    </div>
                    <table id="tblbarangcart" class="table custom-table table-hover table-bordered thead-center dataTable" width="100%">
                        <thead>
                            <tr>
                                <th class="min-mobile">Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga Beli</th>
                                <th>Total Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Total Harga Jual</th>
                                <th style="width:50px">Aksi</th>
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
            <button type="submit" class="btn btn-primary waves-effect btnSubmit">Simpan</button>
            <button type="button" class="btn btn-default waves-effect m-r-5" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>




<script type="text/javascript">
    $('.date_from').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "mm/dd/yy",
        prevText: '<i class="fa fa-caret-left"></i>',
        nextText: '<i class="fa fa-caret-right"></i>',
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

     $(document).ready(function() {
        $(document).on("click", ".btnremoveitem", function () {
            var row = $(this).closest('tr');
            row.remove();
        });
    });
</script>