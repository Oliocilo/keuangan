<div id="accordion" role="tablist" aria-multiselectable="true">
    <div class="accordion-panel">
        <div class="accordion-heading" role="tab" id="headingOne">
            <h3 class="card-title accordion-title">
                <a class="accordion-msg scale_active collapsed text-right" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <button type="button" class="btn btn-sm btn-success"> Tambah Stok </button>
                </a>
            </h3>
        </div>
        <div id="collapseOne" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="headingOne" style="">
            <div class="errorValidate" style="display:none"><ul></ul></div>
            <form class="j-pro" novalidate="" id="formajax" action="<?= base_url('master/barang/updateStok') ?>" autocomplete="off">
                <input type="hidden" name="id_barang" id="id_barang" value="<?=$rtc['id_barang']?>">
                <div class="j-content m-b-10">
                    <div class="j-row">
                        <div class="j-span7 j-unit">
                            <label class="j-label">Tanggal Update <small class="text-danger">*</small></label>
                            <div class="j-input">
                                <label class="j-icon-right" for="date_from">
                                    <i class="fa fa-calendar"></i>
                                </label>
                                <input type="text" class="date_from" name="tanggal" readonly>
                            </div>
                        </div>
                        <div class="j-span5 j-unit">
                            <label class="j-label">Jam Update <small class="text-danger">*</small></label>
                            <div class="j-input" >
                                <label class="j-icon-right" for="date_to">
                                    <i class="fa fa-clock-o"></i>
                                </label>
                                <input type="text" class="jam" name="jam" >
                            </div>
                        </div>
                    </div>
                    <div class="j-row">
                        <div class="j-span7 j-unit">
                            <label class="j-label">Tanggal Invoice <small class="text-danger">*</small></label>
                            <div class="j-input">
                                <label class="j-icon-right" for="date_from">
                                    <i class="fa fa-calendar"></i>
                                </label>
                                <input type="text" class="date_from" name="tanggal_inv" readonly="">
                            </div>
                        </div>
                        <div class="j-span5 j-unit">
                            <label class="j-label">Jam Invoice <small class="text-danger">*</small></label>
                            <div class="j-input" >
                                <label class="j-icon-right" for="date_to">
                                    <i class="fa fa-clock-o"></i>
                                </label>
                                <input type="text" class="jam" name="jam_inv" >
                            </div>
                        </div>
                    </div>
                    <div class="j-row">
                        <div class="j-span6 j-unit">
                            <label class="j-label">No. Invoice <small class="text-danger">*</small></label>
                            <div class="input">
                                <input type="text" name="nomor_inv">
                            </div>
                        </div>
                        <div class="j-span6 j-unit">
                            <label class="j-label">Nama Barang <small class="text-danger">*</small></label>
                            <div class="input">
                                <input type="text" disabled value="<?=$rtc['nama_barang']?>">
                            </div>
                        </div>
                    </div>
                    <div class="j-row">
                        <div class="j-span6 j-unit">
                            <label class="j-label">Harga Pembelian <small class="text-danger">*</small></label>
                            <div class="input">
                                <input type="text" name="harga" class="currency" data-a-sign="Rp. ">
                            </div>
                        </div>
                        <div class="j-span6 j-unit">
                            <label class="j-label">Harga Penjualan <small class="text-danger">*</small></label>
                            <div class="input">
                                <input type="text" name="harga_penjualan" class="currency" data-a-sign="Rp. ">
                            </div>
                        </div>
                        <div class="j-span6 j-unit">
                            <label class="j-label">Stok Masuk <small class="text-danger">*</small></label>
                            <div class="input">
                                <input type="text" name="stok">
                            </div>
                        </div>
                        <div class="j-span6 j-unit">
                            <label class="j-label">Buku Kas <small class="text-danger">*</small></label>
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
                    </div>
                    <div class="j-unit">
                        <label class="j-label">Keterangan/Referensi</label>
                        <div class="input">
                            <textarea spellcheck="false" name="keterangan"></textarea>
                        </div>
                    </div>

                    <div class="j-unit m-b-10">
                        <button type="submit" class="pull-right btn btn-primary waves-effect btnSubmit">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="p-10">
        <table id="exampleStok" class="table custom-table table-hover table-bordered thead-center dataTable table-condensed" width="100%" data-tipe="IN">
            <thead>
                <tr>
                    <th class="min-mobile">No. Invoice</th>
                    <th>Tanggal Invoice</th>
                    <th>Stok Masuk</th>
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

   
<?php if($dataloadmodal){ ?>
    <script src="<?=base_url('assets')?>/formjs/<?=$dataloadmodal?>"></script>
<?php } ?>
<script type="text/javascript">
    $('.date_from').datepicker({
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