<div class="page-wrapper">
    <div class="card page-header p-0" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;">
        <div class="card-block front-icon-breadcrumb row align-items-end">
            <div class="breadcrumb-header col title-bukukas">
                <div class="big-icon">
                    <i class="<?=$page_icon?>"></i>
                </div>
                <div class="d-inline-block">
                    <h5><?=$page_name?></h5>
                    <span>Pengaturan</span>
                </div>
            </div>
            <div class="col text-right">

            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="row">
            <div class="col-md-12">
            <div class="card" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
                <div class="card-body">
                    <b>Anda memiliki proses pembelian yang belum selesai.</b>
                    <p>Jika Anda sudah melakukan transfer melalui bank, klik tombol <b>"Konfirmasi Pembayaran"</b> untuk mengkonfirmasi pembayaran, atau klik tombol <b>"Batalkan"</b> untuk membatalkan pembelian ini.</p>

                    <hr>
                    <table id="examples" class="table custom-table table-hover table-bordered thead-center dataTable no-footer" width="100%">
                        <thead>
                            <tr>
                                <th class="min-mobile">Keterangan</th>
                                <th style="width:200px">Jumlah Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?=$rtc['tipe']?> <b><?=$rtc['jumlah_satuan'].' '.$rtc['tipe_satuan']?></b></td>
                                <td class="text-right">Rp <?=number_format($rtc['harga'])?></td>
                            </tr>
                            <tr>
                                <td>Kode Unik</td>
                                <td class="text-right">Rp <?=number_format($rtc['kode_unik'])?></td>
                            </tr>
                            <tr>
                                <td style="background:#ddd"><b>Total Bayar</b></td>
                                <td style="background:#ddd" class="text-right"><b>Rp <?=number_format($rtc['harga']+$rtc['kode_unik'])?></b></td>
                            </tr>
                        </tbody>
                    </table>
                        <hr>
                        <div class="text-right">
                        <button type="button" class="btn btn-danger bntBatal" data-id="<?=$this->template->matEnc($rtc['id'])?>"><i class="fa fa-times"></i> Batalkan </button>
                    </div>

                </div>
            </div>
        </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
                    <div class="card-header bg-primary cardtitleAlat">
                        <span class="text-white" style="font-size: 18px !important;">Pembayaran Via Transfer Bank</span>
                    </div>
                    <div class="card-body text-center">
                        <b>Silahkan transfer sebesar :</b>
                        <br>
                        <br>
                        <h3 class="text-primary">Rp <?=number_format($rtc['harga']+$rtc['kode_unik'])?></h3>
                         <br>
                        <p>Menuju ke salah satu rekening berikut :</p>

                        <?php foreach ($bank as $key => $val) { ?>
                          <div class="image">
                              <img src="<?=base_url($val['logo_bank'])?>" style="width: 140px;">
                          </div>
                          <div class="info-bank mt-2">
                            <table class="table">
                                <tr>
                                    <th>Nama Bank</th>
                                    <th style="width:1px">:</th>
                                    <td><?=$val['nama_bank']?></td>
                                </tr>
                                <tr>
                                    <th>Nomor Rekening</th>
                                    <th style="width:1px">:</th>
                                    <td><?=$val['nomor_rekening']?></td>
                                </tr>
                                <tr>
                                    <th>Nama Rekening</th>
                                    <th style="width:1px">:</th>
                                    <td><?=$val['nama_rekening']?></td>
                                </tr>
                            </table>
                          </div>
                          <hr>
                        <?php } ?>

                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
                    <div class="card-header bg-primary cardtitleAlat">
                        <span class="text-white" style="font-size: 18px !important;">Konfirmasi Pembayaran</span>
                    </div>
                    <div class="card-body">
                        Sesudah transfer, <b>isilah formulir konfirmasi pembayaran di bawah </b>. <?=$rtc['tipe']?> akan segera kami proses sesudah Anda mengisi formulir ini.
                        <hr>
                         <div class="errorValidate" style="display:none;margin-bottom: 10px;"><ul></ul></div>
                          <form   novalidate=""  id="formajax" action="<?= base_url('pengaturan/premium/konfirmPayment') ?>" autocomplete="off">
                            <input type="hidden" name="id" value="<?=$this->template->matEnc($rtc['id'])?>">
                        <div class="form-group">
                            <label>Tanggal Transfer</label>
                            <input type="date" class="form-control" name="tanggal_transfer" value="<?=date('Y-m-d')?>">
                        </div>
                         <div class="form-group">
                            <label>Nominal Transfer</label>
                            <input type="number" class="form-control" name="nominal" value="<?=$rtc['harga']+$rtc['kode_unik']?>">
                        </div>
                        <hr>
                        <label class="font-weight-bold">Transfer Dari</label>
                         <div class="form-group">
                            <label>Nama Bank</label>
                            <input type="text" class="form-control" name="nama_bank" >
                        </div>
                         <div class="form-group">
                            <label>Nama Pemilik Rekening</label>
                            <input type="text" class="form-control" name="nama_rekening" value="">
                        </div>
                        <hr>
                         <label class="font-weight-bold">Transfer Ke</label>
                         <div class="form-group">
                            <label>Rekening Duitqu</label>
                            <select class="form-control" name="rekening_tujuan">
                                 <?php foreach ($bank as $key => $val) { ?>
                                    <option value="<?=$val['id']?>"><?=$val['nama_bank']?> - <?=$val['nomor_rekening']?> - <?=$val['nama_rekening']?></option>
                                 <?php } ?>
                            </select>
                        </div>
                         <hr>
                        <button class="btn btn-primary btn-block btnSubmit"> Konfirmasi Pembayaran</button>
                    </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

