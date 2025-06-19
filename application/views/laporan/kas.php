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
            <div class="col text-right">
                
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="card">
            <div class="card-header">
                <div class="row m-b-10 b-b-primary p-b-10">
                    <div class="col-md-8">
                        <form action="" method="GET" class="row">
                            <div class="col-md-4">
                                <label>Buku Kas</label>
                                <select class="form-control" name="buku" id="getBuku">
                                    <?php
                                        $id_buku = isset($_GET['buku']) ? $_GET['buku'] : '';
                                        $getTipe = isset($_GET['tipe']) ? $_GET['tipe'] : 'Bulanan';
                                        $tanggal_awal = isset($_GET['tanggal_awal']) && $_GET['tanggal_awal'] != ''
                                            ? date('Y-m-d',strtotime($_GET['tanggal_awal'])) : date('01-m-Y');
                                        $tanggal_akhir = isset($_GET['tanggal_akhir']) && $_GET['tanggal_akhir'] != ''
                                            ? date('Y-m-d',strtotime($_GET['tanggal_akhir'])) : date('t-m-Y');
                                        $tahunStart = date('Y' ,strtotime('- 5 Years'));
                                        $bulanNow = isset($_GET['tanggal_awal']) ? date_format(date_create($_GET['tanggal_awal']), 'm') : date('m');
                                        $pilihTahun = isset($_GET['tanggal_awal']) ? date_format(date_create($_GET['tanggal_awal']), 'Y') : date('Y');
                                    ?>
                                    <option value="">-- Semua Buku Kas --</option>
                                    <?php foreach ($bukuKasList as $key => $bkl) { ?>
                                        <option value="<?=$this->template->matEnc($bkl['id_buku'])?>" 
                                            <?=$this->template->matDec($id_buku) == $bkl['id_buku'] ? 'selected' : ''?>><?=$bkl['nama']?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-2 pl-lg-0 mt-3 mt-lg-0">
                                <label>Tipe</label>
                                <select id="tipenya" class="form-control" name="tipe" onchange="gantiTipe(this.value)">
                                    <?php
                                        $tipenya = ['Harian', 'Bulanan','Tahunan', 'Custom'];
                                        foreach ($tipenya as $tipe) { 
                                    ?>
                                        <option value="<?=$tipe?>" <?=$getTipe == $tipe ? 'selected' : ''?>>
                                            <?=$tipe?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                                <div class="col-md-2 pl-lg-0 hideBulanan mt-3 mt-lg-0">
                                    <label>Bulan</label>
                                    <select class="form-control" id="filterBulan" onchange="gantiTipe($('#tipenya').val())">
                                        <?php foreach ($namaBulan as $key => $bln) { ?>
                                            <option value="<?=$key?>" <?=$bulanNow == $key ? 'selected' : ''?>><?=$bln?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-2 pl-lg-0 hideBulanan showTahunan mt-3 mt-lg-0">
                                    <label>Tahun</label>
                                    <select class="form-control" id="filterTahun" onchange="gantiTipe($('#tipenya').val())">
                                        <?php for ($i=$tahunStart; $i <= date('Y'); $i++){ ?>
                                        <option value="<?=$i?>" <?=$pilihTahun == $i ? 'selected' : ''?>><?=$i?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <div class="col-md-2 pl-lg-0 hideCustom">
                                <label>Tanggal Dari</label>
                                <input id="tanggalAwal" type="text" class="form-control tgl" name="tanggal_awal" readonly="" value="<?=$tanggal_awal?>">
                            </div>
                            <div class="col-md-2 pl-lg-0 hideCustom">
                                <label>Tanggal Sampai</label>
                                <input id="tanggalAkhir" type="text" class="form-control tgl" name="tanggal_akhir" readonly="" value="<?=$tanggal_akhir?>">
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
                        <?php 
                            $this->session->set_flashdata('getSearch',$this->input->get());
                            if($this->template->checkAccessed('SP011') == 1){ 
                        ?>
                            <button class="btn btn-success btn-outline-primary" onclick="renderExcel()"><i class="icofont icofont-file-excel" ></i> Ekspor Excel</button>
                            <button class="btn btn-danger btn-outline-primary" onclick="renderPdf()"><i class="icofont icofont-file-pdf"></i> Print Pdf</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="card-block">
                <div class="row m-b-20">
                    <div class="col-md-12 b-b-primary">
                        <h3>Rekap Buku Kas Umum</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-condensed smalltable">
                            <thead>
                                <tr>
                                    <th style="width:60%">Saldo Awal</th>
                                    <th style="width:1px">Rp.</th>
                                    <th class="text-right"><?=number_format($rekapKasUmum['saldo_awal'], 0, ',', '.')?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th scope="row">Semua Pemasukan</th>
                                    <td>Rp.</td>
                                    <td class="text-right"><?=number_format($rekapKasUmum['transaksi'][0]['total_masuk'], 0, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Semua Pengeluaran</th>
                                    <td>Rp.</td>
                                    <td class="text-right"><?=number_format($rekapKasUmum['transaksi'][0]['total_keluar'], 0, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <th class="text-right" scope="row">Akumulasi</th>
                                    <td>Rp.</td>
                                    <td class="text-right"><?=number_format($rekapKasUmum['transaksi'][0]['diff_total'], 0, ',', '.')?></td>
                                </tr>

                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th scope="row">Transfer Masuk</th>
                                    <td>Rp.</td>
                                    <td class="text-right"><?=number_format($rekapKasUmum['transfer'][0]['total_masuk'], 0, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Transfer Keluar</th>
                                    <td>Rp.</td>
                                    <td class="text-right"><?=number_format($rekapKasUmum['transfer'][0]['total_keluar'], 0, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <th class="text-right" scope="row">Akumulasi</th>
                                    <td>Rp.</td>
                                    <td class="text-right"><?=number_format($rekapKasUmum['transfer'][0]['diff_total'], 0, ',', '.')?></td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th style="width:50%">Saldo Akhir</th>
                                    <th style="width:1px">Rp.</th>
                                    <th class="text-right"><?=number_format($rekapKasUmum['saldo_akhir'], 0, ',', '.')?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div style="height: 300px;">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand"><div class=""></div></div>
                                <div class="chartjs-size-monitor-shrink"><div class=""></div></div>
                            </div>
                            <canvas id="newuserchartPie" height="224" width="259" style="display: block; height: 150px; width: 208px;" class="chartjs-render-monitor"></canvas>
                            <input type="hidden" class="chartDataPie" value="newuserchartPie,<?=$rekapKasUmum['transaksi'][0]['total_masuk']?>,<?=$rekapKasUmum['transaksi'][0]['total_keluar']?>">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row m-b-20">
                    <div class="col-md-12 b-b-primary">
                        <h3>Rekap Buku Kas per Kategori</h3>
                    </div>
                </div>
                <div class="row m-b-20">
                    <div class="col-md-6">
                        <table  class="table  table-condensed smalltable thead-center " width="100%">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Pemasukan</th>
                                    <th>Pengeluaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $totalMasuk = 0;
                                    $totalKeluar = 0;
                                    foreach ($rekapKategori['kategori'] as $key => $rKat) { 
                                        $totalMasuk += $rKat['total_masuk'];
                                        $totalKeluar += $rKat['total_keluar'];
                                        ?>
                                        <tr>
                                            <td class="font-weight-bold" style="background:#ddd">
                                                <a href="#kategori_0" onclick="$('#subKategori_<?=$key+1?>').toggleClass('d-none')"><?=$rKat['nama_kategori']?></a>
                                            </td>
                                            <td class="text-right">Rp. <?=number_format($rKat['total_masuk'], 0, ',', '.')?></td>
                                            <td class="text-right">Rp. <?=number_format($rKat['total_keluar'], 0, ',', '.')?></td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="3" style="padding: 0 !important">
                                                <table class="table my-3 d-none" style="width:80% !important;" id="subKategori_<?=$key+1?>">
                                                    <thead>
                                                        <tr>
                                                            <th>Tanggal</th>
                                                            <th>Deskripsi</th>
                                                            <th>Nominal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                        $totalNominal = 0;
                                                        foreach ($rekapKategori['detail'][$rKat['nama_kategori']] as $key2 => $rKatDet) { 
                                                            $totalNominal += $rKatDet['nominal'];
                                                    ?>
                                                            <tr>
                                                                <td class="font-weight-bold" <?=$rKatDet['bgTipe']?>><?=$rKatDet['tanggal']?></td>
                                                                <td class="text-right text-break"><?=$rKatDet['deskripsi']?></td>
                                                                <td class="text-right">Rp. <?=number_format($rKatDet['nominal'], 0, ',', '.')?></td>
                                                            </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="2">Total</th>
                                                            <td class="text-right font-weight-bold">Rp. <?=number_format($totalNominal, 0, ',', '.')?></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </td>
                                        </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <td class="text-right font-weight-bold">Rp. <?=number_format($totalMasuk, 0, ',', '.')?></td>
                                    <td class="text-right font-weight-bold">Rp. <?=number_format($totalKeluar, 0, ',', '.')?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 b-r-default">
                                <div style="height: 200px;">
                                    <canvas id="newuserchartPemasukan"  height="300" width="200" style="display: block; height: 150px; width: 208px;" class="chartjs-render-monitor"></canvas>
                                    <input type="hidden" class="chartData" data-tipe="Pemasukan" value="newuserchartPemasukan">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="height: 200px;">
                                    <div class="chartjs-size-monitor">
                                        <div class="chartjs-size-monitor-expand"><div class=""></div></div>
                                        <div class="chartjs-size-monitor-shrink"><div class=""></div></div>
                                    </div>
                                    <canvas id="newuserchartPengeluaran"  height="300" width="200" style="display: block; height: 150px; width: 208px;" class="chartjs-render-monitor"></canvas>
                                    <input type="hidden" class="chartData" data-tipe="Pengeluaran" value="newuserchartPengeluaran">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <label class="font-weight-bold">Kategori :</label>
                        <div id="legendPemasukan" style="margin-top: 5px;font-size: 11px;">
                            <ul id="legend-list" style="list-style: none; padding: 0;"></ul>
                        </div>
                        <div id="legendPengeluaran" style="margin-top: 5px;font-size: 11px;">
                            <ul id="legend-list" style="list-style: none; padding: 0;"></ul>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row m-b-20">
                    <div class="col-md-12 b-b-primary">
                        <h3>Rekap Akumulasi Transfer per Buku Kas</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <table  class="table table-condensed smalltable thead-center " width="100%">
                            <thead>
                                <tr>
                                    <th>Buku Kas</th>
                                    <th>Transfer Masuk</th>
                                    <th>Transfer Keluar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalTfMasuk = 0;
                                $totalTfKeluar = 0;
                                foreach ($rekapKas['buku'] as $key => $rKas) { 
                                    $totalTfMasuk += $rKas['tf_masuk'];
                                    $totalTfKeluar += $rKas['tf_keluar'];
                                    ?>
                                <tr>
                                    <td class="font-weight-bold" style="background:#ddd">
                                        <a href="#transfer_0" onclick="$('#subTransfer_<?=$key+1?>').toggleClass('d-none');$('#newuserchartBar').height('200')"><?=$rKas['namaBuku']?></a>
                                    </td>
                                    <td class="text-right">Rp. <?=number_format($rKas['tf_masuk'], 0, ',', '.')?></td>
                                    <td class="text-right">Rp. <?=number_format($rKas['tf_keluar'], 0, ',', '.')?></td>
                                </tr>
                                        
                                <tr>
                                    <td colspan="3" style="padding: 0 !important">
                                        <table class="table my-3 d-none" id="subTransfer_<?=$key+1?>">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Deskripsi</th>
                                                    <th>Nominal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $totalNominal = 0;
                                                foreach ($rekapKas['detail'][$rKas['namaBuku']] as $key2 => $rKatDet) { 
                                                    $totalNominal += $rKatDet['nominal'];
                                            ?>
                                                    <tr>
                                                        <td class="font-weight-bold" <?=$rKatDet['bgTipe']?>><?=$rKatDet['tanggal']?></td>
                                                        <td class="text-right text-break"><?=$rKatDet['deskripsi']?></td>
                                                        <td class="text-right">Rp. <?=number_format($rKatDet['nominal'], 0, ',', '.')?></td>
                                                    </tr>
                                            <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2">Total</th>
                                                    <td class="text-right font-weight-bold">Rp. <?=number_format($totalNominal, 0, ',', '.')?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="">Total</th>
                                    <td class="text-right font-weight-bold">Rp. <?=number_format($totalTfMasuk, 0, ',', '.')?></td>
                                    <td class="text-right font-weight-bold">Rp. <?=number_format($totalTfKeluar, 0, ',', '.')?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand"><div class=""></div></div>
                            <div class="chartjs-size-monitor-shrink"><div class=""></div></div>
                        </div>
                        <canvas id="newuserchartBar" height="224" width="259" style="display: block; height: 150px; width: 208px;" class="chartjs-render-monitor"></canvas>
                        <input type="hidden" class="chartDataBar" value="newuserchartBar,10000000,500000">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>