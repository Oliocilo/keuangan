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
            <div class="card-header">
                <div class="row m-b-10 b-b-primary p-b-10 ">
                    <div class="col-md-8">
                        <form action="" method="GET" class="row">
                            <div class="col-md-3">
                                <label>Bulan</label>
                                <select class="form-control" id="filterBulan" name="bulan">
                                    <?php
                                        $bulanNow = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
                                    ?>
                                    <option value="Semua Bulan" <?= $bulanNow == "Semua Bulan" ? 'selected' : ''?>>Semua Bulan</option>
                                    <?php foreach ($namaBulan as $key => $bln) { ?>
                                        <option value="<?=$key?>" <?=$bulanNow == $key ? 'selected' : ''?>><?=$bln?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-2 pl-lg-0 mt-3 mt-lg-0">
                                <label>Tahun</label>
                                <select class="form-control" id="filterTahun" name="tahun">
                                    <?php 
                                        $tahunNow = date('Y');
                                        $tahunStart = date('Y' ,strtotime('- 5 Years'));
                                        $pilihTahun = isset($_GET['tahun']) ? $_GET['tahun'] : $tahunNow;
                                        for ($i=$tahunStart; $i <=$tahunNow ; $i++){ 
                                    ?>
                                    <option value="<?=$i?>" <?=$pilihTahun == $i ? 'selected' : ''?>><?=$i?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-2 pl-lg-0 d-flex align-items-center my-3 my-lg-0">
                                <button type="submit" class="btn btn-info">
                                    <i class="icofont icofont-search m-r-5"></i> Filter
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-3 d-flex flex-wrap align-items-center justify-content-between">
                        <?php if($this->template->checkAccessed('SP015') == 1){ ?>
                            <button class="btn btn-success btn-outline-primary" onclick="renderNeracaExcel()"><i class="icofont icofont-file-excel" ></i> Ekspor Excel</button>
                            <button class="btn btn-danger btn-outline-primary" onclick="renderNeracaPdf()"><i class="icofont icofont-file-pdf"></i> Print Pdf</button>
                        <?php } ?>
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
                                    <th scope="row" class="pl-4">Seluruh Kas</th>
                                    <td>Rp.</td>
                                    <td><?=number_format($seluruhKas, 0, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Piutang Dagang</th>
                                    <td>Rp.</td>
                                    <td><?=number_format($totalPiutang, 0, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Persediaan Barang</th>
                                    <td>Rp.</td>
                                    <td><?=number_format($persediaanBarang, 0, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <th class="text-right" scope="row">Akumulasi</th>
                                    <td>Rp.</td>
                                    <td><?=number_format($sumAktivaLancar, 0, ',', '.')?></td>
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
                                <?php
                                    $sumAset = 0;
                                    foreach($totalAset as $aset){
                                        $sumAset += $aset['total'];
                                ?>
                                <tr>
                                    <th scope="row" class="pl-4"><?=$aset['nama_kategori']?></th>
                                    <td>Rp.</td>
                                    <td><?=number_format($aset['total'], 0, ',', '.')?></td>
                                </tr>
                                <?php
                                    }
                                ?>
                                <tr>
                                <tr>
                                    <th scope="row" class="pl-4">Inventaris</th>
                                    <td>Rp.</td>
                                    <td><?=number_format(0, 0, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Akumulasi Penyusutan</th>
                                    <td>Rp.</td>
                                    <td><?=number_format($akumulasiPenyusutan, 0, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <th class="text-right" scope="row">Akumulasi</th>
                                    <td>Rp.</td>
                                    <td><?=number_format(($sumAset + $akumulasiPenyusutan), 0, ',', '.')?></td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th style="width:50%; text-decoration: underline;">Jumlah Aktiva</th>
                                    <th style="width:1px; text-align: right;">Rp.</th>
                                    <th class="text-right"><?=number_format(($sumAktivaLancar + $sumAset + $akumulasiPenyusutan), 0, ',', '.')?></th>
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
                                    <td>Rp.</td>
                                    <td><?=number_format($totalUtang, 0, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Simpanan Pokok</th>
                                    <td>Rp.</td>
                                    <td><?=number_format(0, 0, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Simpanan Wajib</th>
                                    <td>Rp.</td>
                                    <td><?=number_format(0, 0, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Simpanan Sukarela</th>
                                    <td>Rp.</td>
                                    <td><?=number_format(0, 0, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Ziswaf</th>
                                    <td>Rp.</td>
                                    <td><?=number_format(0, 0, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <th class="text-right" scope="row">Akumulasi</th>
                                    <td>Rp.</td>
                                    <td><?=number_format($totalUtang, 0, ',', '.')?></td>
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
                                    <td>Rp.</td>
                                    <td><?=number_format($modalSaham, 0, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Laba tahun berjalan</th>
                                    <td>Rp.</td>
                                    <td><?=number_format($labaBersih, 0, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <th class="text-right" scope="row">Akumulasi</th>
                                    <td>Rp.</td>
                                    <td><?=number_format($modalSaham+$labaBersih, 0, ',', '.')?></td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th style="width:50%; text-decoration: underline;">Total Kewajiban dan Ekuitas</th>
                                    <th style="width:1px; text-align: right;">Rp.</th>
                                    <th class="text-right"><?=number_format(($totalUtang + $modalSaham + $labaBersih), 0, ',', '.')?></th>
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