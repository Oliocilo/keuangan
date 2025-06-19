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
                        <?php if($this->template->checkAccessed('SP013') == 1){ ?>
                            <button class="btn btn-success btn-outline-primary" onclick="renderLRExcel()"><i class="icofont icofont-file-excel" ></i> Ekspor Excel</button>
                            <button class="btn btn-danger btn-outline-primary" onclick="renderLRPdf()"><i class="icofont icofont-file-pdf"></i> Print Pdf</button>
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
                                    <th style="width:50%; text-decoration: underline;" colspan="3">Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <?php if(empty($pemasukan)) { ?>
                                    <th style="width:50%; text-decoration: underline;">Total Pemasukan</th>
                                    <td style="width:1px; text-align: right">Rp.</td>
                                    <td class="text-right">0</td>
                                    <?php } else { ?>
                                    <th style="width:50%; text-decoration: underline;" colspan="3">Total Pemasukan</th>
                                    <?php } ?>
                                </tr>
                                <?php
                                    foreach($pemasukan as $masuk){
                                ?>
                                <tr>
                                    <th scope="row" class="pl-4"><?=$masuk['nama_kategori']?></th>
                                    <td>Rp.</td>
                                    <td><?=number_format($masuk['total_masuk'], 0, ',', '.')?></td>
                                </tr>
                                <?php
                                    }
                                ?>
                                <tr>
                                    <th class="text-right" scope="row">Akumulasi</th>
                                    <td>Rp.</td>
                                    <td><?=number_format($totalMasuk, 0, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th style="width:50%; text-decoration: underline;" colspan="3">Harga Pokok Penjualan (HPP)</th>
                                </tr>
                                <tr>
                                    <th scope="row" class="pl-4">Pembelian Barang Dagang</th>
                                    <td>Rp.</td>
                                    <td><?=number_format($pembelianBarang, 0, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <th class="text-right" scope="row">Total HPP</th>
                                    <td>Rp.</td>
                                    <td><?=number_format($pembelianBarang, 0, ',', '.')?></td>
                                </tr>
                                <thead>
                                    <tr>
                                        <th colspan="3"></th>
                                    </tr>
                                    <tr>
                                        <th style="width:50%; text-decoration: underline;">Laba Kotor</th>
                                        <th style="width:1px; text-align: right">Rp.</th>
                                        <th class="text-right"><?=number_format($labaKotor, 0, ',', '.')?></th>
                                    </tr>
                                </thead>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-condensed neracatable">
                            <thead>
                                <tr>
                                    <th style="width:50%; text-decoration: underline;" colspan="3">Pengeluaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <?php if(empty($pengeluaran)) { ?>
                                    <th style="width:50%; text-decoration: underline;">Total Pengeluaran</th>
                                    <td style="width:1px; text-align: right">Rp.</td>
                                    <td class="text-right">0</td>
                                    <?php } else { ?>
                                    <th style="width:50%; text-decoration: underline;" colspan="3">Total Pengeluaran</th>
                                    <?php } ?>
                                </tr>
                                <?php
                                    foreach($pengeluaran as $keluar){
                                ?>
                                <tr>
                                    <th scope="row" class="pl-4"><?=$keluar['nama_kategori']?></th>
                                    <td>Rp.</td>
                                    <td><?=number_format($keluar['total_keluar'], 0, ',', '.')?></td>
                                </tr>
                                <?php
                                    }
                                ?>
                                <tr>
                                    <th class="text-right" scope="row">Akumulasi</th>
                                    <td>Rp.</td>
                                    <td><?=number_format($totalKeluar, 0, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th style="width:50%; text-decoration: underline;">Beban Penyusutan</th>
                                    <td>Rp.</td>
                                    <td><?=number_format($bebanPenyusutan, 0, ',', '.')?></td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th style="width:50%; text-decoration: underline;">Laba Bersih</th>
                                    <th style="width:1px; text-align: right">Rp.</th>
                                    <th class="text-right"><?=number_format($labaBersih, 0, ',', '.')?></th>
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