<div class="page-wrapper">
   <div class="card page-header p-0">
        <div class="card-block front-icon-breadcrumb row align-items-end">
            <div class="breadcrumb-header col title-bukukas">
                <div class="big-icon">
                    <i class="fa fa-book"></i>
                </div>
                <div class="d-inline-block">
                    <h5><?=$page_name?></h5>
                    <span>Master Data</span>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="card">
            <div class="card-header filterCard">
                <div class="row m-b-10 b-b-primary p-b-10 ">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Bulan</label>
                                <select class="form-control">
                                    <?php
                                        $bulanNow = date('m'); 
                                        foreach ($namaBulan as $key => $bln) { ?>
                                        <option value="<?=$key?>" <?=$bulanNow == $key ? 'selected' : ''?>><?=$bln?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-2 p-l-0">
                                <label>Tahun</label>
                                <select class="form-control">
                                    <?php 
                                    $tahunNow = date('Y');
                                    $tahunStart = date('Y' ,strtotime('- 5 Years'));
                                    for ($i=$tahunStart; $i <=$tahunNow ; $i++){ ?>
                                    <option value="<?=$i?>" <?=$tahunNow == $i ? 'selected' : ''?>><?=$i?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-2 p-l-0">
                                <label style="opacity: 0;">filter</label>
                                <button type="submit" class="btn btn-info">
                                    <i class="icofont icofont-search m-r-5"></i> Filter
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-right">
                        <button class="btn btn-success btn-outline-primary" onclick="renderExcel()"><i class="icofont icofont-file-excel" ></i> Ekspor Excel</button>
                        <button class="btn btn-danger btn-outline-primary" onclick="renderPdf()"><i class="icofont icofont-file-pdf"></i> Print Pdf</button>
                    </div>
                </div>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-condensed neracatable">
                            <thead>
                                <tr>
                                    <th style="width:50%; text-decoration: underline;" colspan="3">Aktiva</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th style="width:50%; text-decoration: underline;" colspan="3">Aktiva Lancar</th>
                                </tr>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Kas</th>
                                    <td>Rp</td>
                                    <td><?=number_format($rekapKasUmum['transaksi'][0]['total_masuk'])?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Piutang Dagang</th>
                                    <td>Rp</td>
                                    <td><?=number_format($rekapKasUmum['transaksi'][0]['total_keluar'])?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Persediaan</th>
                                    <td>Rp</td>
                                    <td><?=number_format($rekapKasUmum['transaksi'][0]['total_keluar'])?></td>
                                </tr>
                                <tr>
                                    <th class="text-right" scope="row">Akumulasi</th>
                                    <td>Rp</td>
                                    <td><?=number_format($rekapKasUmum['transaksi'][0]['diff_total'])?></td>
                                </tr>

                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th style="width:50%; text-decoration: underline;" colspan="3">Aktiva Tetap</th>
                                </tr>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Tanah</th>
                                    <td>Rp</td>
                                    <td><?=number_format($rekapKasUmum['transaksi'][0]['total_masuk'])?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Bangunan</th>
                                    <td>Rp</td>
                                    <td><?=number_format($rekapKasUmum['transaksi'][0]['total_keluar'])?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Mesin</th>
                                    <td>Rp</td>
                                    <td><?=number_format($rekapKasUmum['transaksi'][0]['total_keluar'])?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Inventaris</th>
                                    <td>Rp</td>
                                    <td><?=number_format($rekapKasUmum['transaksi'][0]['total_keluar'])?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Akumulasi Penyusutan</th>
                                    <td>Rp</td>
                                    <td><?=number_format($rekapKasUmum['transaksi'][0]['total_keluar'])?></td>
                                </tr>
                                <tr>
                                    <th class="text-right" scope="row">Akumulasi</th>
                                    <td>Rp</td>
                                    <td><?=number_format($rekapKasUmum['transaksi'][0]['diff_total'])?></td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th style="width:50%; text-decoration: underline;">Jumlah Aktiva</th>
                                    <th style="width:1px">Rp</th>
                                    <th><?=number_format($rekapKasUmum['saldo'][0]['saldo_akhir'])?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-condensed neracatable">
                            <thead>
                                <tr>
                                    <th style="width:50%; text-decoration: underline;" colspan="3">Kewajiban dan Ekuitas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th style="width:50%; text-decoration: underline;" colspan="3">Kewajiban Lancar</th>
                                </tr>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Hutang Dagang</th>
                                    <td>Rp</td>
                                    <td><?=number_format($rekapKasUmum['transaksi'][0]['total_masuk'])?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Simpanan Pokok</th>
                                    <td>Rp</td>
                                    <td><?=number_format($rekapKasUmum['transaksi'][0]['total_keluar'])?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Simpanan Wajib</th>
                                    <td>Rp</td>
                                    <td><?=number_format($rekapKasUmum['transaksi'][0]['total_keluar'])?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Simpanan Sukarela</th>
                                    <td>Rp</td>
                                    <td><?=number_format($rekapKasUmum['transaksi'][0]['total_keluar'])?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Ziswaf</th>
                                    <td>Rp</td>
                                    <td><?=number_format($rekapKasUmum['transaksi'][0]['total_keluar'])?></td>
                                </tr>
                                <tr>
                                    <th class="text-right" scope="row">Akumulasi</th>
                                    <td>Rp</td>
                                    <td><?=number_format($rekapKasUmum['transaksi'][0]['diff_total'])?></td>
                                </tr>

                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th style="width:50%; text-decoration: underline;" colspan="3">Ekuitas</th>
                                </tr>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Modal Saham</th>
                                    <td>Rp</td>
                                    <td><?=number_format($rekapKasUmum['transaksi'][0]['total_masuk'])?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Laba tahun berjalan</th>
                                    <td>Rp</td>
                                    <td><?=number_format($rekapKasUmum['transaksi'][0]['total_keluar'])?></td>
                                </tr>
                                <tr>
                                    <th class="text-right" scope="row">Akumulasi</th>
                                    <td>Rp</td>
                                    <td><?=number_format($rekapKasUmum['transaksi'][0]['diff_total'])?></td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th style="width:50%; text-decoration: underline;">Total Kewajiban dan Ekuitas</th>
                                    <th style="width:1px">Rp</th>
                                    <th><?=number_format($rekapKasUmum['saldo'][0]['saldo_akhir'])?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
            </div>
            <div class="col-6">
            </div>
        </div>
    </div>
</div>
<div id="formDelete"></div>