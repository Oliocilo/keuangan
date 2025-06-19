

<div class="page-wrapper">
    <div class="row">
        <div class="col-md-4">
            <div class="card user-card-full cardbook card-shadow">
                <div class="card-block front-icon-breadcrumb card-booktitle">
                    
                    <div class="d-inline-block">
                        <h5 class="text-primary font-weight-bold titlebook"><?=$page_name?></h5>
                        <span><?=$bukuDetail['deskripsi']?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 info-saldo">
            <?php if($this->template->checkAccessed('SP004') == 1){ ?>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xl-4 col-6">
                        <div class="card z-depth-5 waves-effect cardinfosaldo">
                            <div class="card-body">
                                <h6 class="text-muted m-b-10">Saldo Awal Bulan</h6>
                                <h5 class="m-b-0">Rp. <?=number_format($detailSaldoAwal, 0, ',', '.')?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-6">
                        <div class="card z-depth-5 waves-effect cardinfosaldo">
                            <div class="card-body">
                                <h6 class="text-muted m-b-10">Saldo Akhir Bulan</h6>
                                <h5 class="m-b-0">Rp. <?=number_format($detailSaldoAkhir, 0, ',', '.')?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card z-depth-5 waves-effect cardinfosaldo">
                            <div class="card-body">
                                <h6 class="text-muted m-b-10">Saldo semua Buku Kas</h6>
                                <h5 class="m-b-0">Rp. <?=number_format($total_saldo, 0, ',', '.')?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
    <div class="page-body">
        <div class="card b-t-primary card-top-shadow">
            <div class="card-header filterCard" style="padding-bottom: 0px !important;">
                <div class="row m-b-10 b-b-primary p-b-10 ">
                    <div class="col-md-8">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Tipe Transaksi</label>
                                    <select class="form-control">
                                        <option value="">-- Semua Tipe --</option>
                                        <?php
                                        foreach ($tipeTransaksi as $key => $val) { ?>
                                            <option value="<?=$val['tipe']?>"><?=$val['tipe']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3  pl-lg-0">
                                    <label>Bulan</label>
                                    <select class="form-control" id="filterBulan" name="bulan">
                                        <?php
                                            $bulanNow = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
                                        ?>
                                        <?php foreach ($namaBulan as $key => $bln) { ?>
                                            <option value="<?=$key?>" <?=$bulanNow == $key ? 'selected' : ''?>><?=$bln?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-2 pl-lg-0">
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
                                <div class="col-md-2 pl-lg-0 d-flex align-items-center">
                                    <button type="submit" class="btn btn-info" id="btnFilter">
                                        <i class="icofont icofont-search m-r-5"></i> Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-3 d-flex flex-wrap align-items-center justify-content-between">
                        <?php if($this->template->checkAccessed('SP002') == 1){ ?>
                        <button class="btn btn-success btn-outline-primary" onclick="renderExcel()"><i class="icofont icofont-file-excel" ></i> Ekspor Excel</button>
                        <button class="btn btn-danger btn-outline-primary" onclick="renderPdf()"><i class="icofont icofont-file-pdf"></i> Print Pdf</button>
                        <?php } ?>
                    </div>
                </div>
                <?php if($this->template->checkAccessed('SP002') == 1){ ?>
                <div class="row m-b-10 b-b-primary p-b-10">
                    <div class="col-md-4 text-right">
                    </div>
                    <div class="col-md-8 text-right">
                        <button id="addTransfer" class="btn btn-primary addTransfer" data-toggle="modal" data-target="#default-Modal"><i class="fa fa-exchange"></i>Transfer</button>
                        <button id="addPemasukan" class="btn btn-success addPemasukan" data-toggle="modal" data-target="#default-Modal"><i class="fa fa-sign-in"></i>Pemasukan</button>
                        <button id="addPengeluaran" class="btn btn-danger addPengeluaran" data-toggle="modal" data-target="#default-Modal"><i class="fa fa-sign-out"></i>Pengeluaran</button>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="card-body cardbodytbale mb-5 mb-md-0">
                <div id="custom_element" class="hidden-xl" style="padding: 10px;">
                    <table class="table" style="margin-bottom :0px;">
                        <tr>
                            <td style="vertical-align:middle; width:20%; text-align:center; cursor:pointer;" onclick="gantiFilter('-','')">
                                <i class="fa fa-caret-left"></i>
                            </td>
                            <td>
                                <select class="selectsmall" onchange="gantiFilter('Bulan',this.selectedIndex)">
                                    <?php
                                    foreach ($namaBulan as $key => $bln) { ?>
                                        <option value="<?=$key?>" <?=$bulanNow == $key ? 'selected' : ''?>><?=$bln?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <select class="selectsmall" onchange="gantiFilter('Tahun',this.selectedIndex)">
                                    <?php 
                                        $tahunNow = date('Y');
                                        $tahunStart = date('Y' ,strtotime('- 5 Years'));
                                        $pilihTahun = isset($_GET['tahun']) ? $_GET['tahun'] : $tahunNow;
                                        for ($i=$tahunStart; $i <=$tahunNow ; $i++){ 
                                    ?>
                                    <option value="<?=$i?>" <?=$pilihTahun == $i ? 'selected' : ''?>><?=$i?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td style="vertical-align:middle; width:20%; text-align:center; cursor:pointer;" onclick="gantiFilter('+')">
                                <i class="fa fa-caret-right"></i>
                            </td>
                        </tr>
                    </table>
                </div>
                <table id="example" data-buku="<?=$this->template->matEnc($bukuDetail['id_buku'])?>" class="table custom-table table-hover table-bordered thead-center dataTable" width="100%">
                    <thead style="box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;">
                        <tr>
                            <th class="min-mobile" style="width: 80px;">Tipe</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th class="min-mobile" style="width: 170px;">Deskripsi</th>
                            <th class="min-mobile">Pemasukan</th>
                            <th class="min-mobile">Pengeluaran</th>
                            <th class="min-mobile">Saldo Akhir</th>
                            <th class="min-mobile" style="width: 70px;">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="footButton hidden-xl" style="position: fixed;bottom: 0px;background: #ddd;width: 100%;z-index: 99;">
    <table class="table" style="margin-bottom :0px;">
        <tr>
            <td style="width: 30%;padding: 0px;">
                <button id="addTransfer" class="btn-sm btn-block btn btn-primary addTransfer" data-toggle="modal" data-target="#default-Modal"><i class="fa fa-exchange"></i>Transfer</button>
            </td>
            <td style="width: 30%;padding: 0px;">
                <button id="addPemasukan" class="btn-sm btn-block btn btn-success addPemasukan" data-toggle="modal" data-target="#default-Modal"><i class="fa fa-sign-in"></i>Pemasukan</button>
            </td>
            <td style="width: 30%;padding: 0px;">
                <button id="addPengeluaran" class="btn-sm btn-block btn btn-danger addPengeluaran" data-toggle="modal" data-target="#default-Modal"><i class="fa fa-sign-out"></i>Pengeluaran</button>
            </td>
        </tr>
    </table>
</div>


<script type="text/javascript">
    function getSaldoAkhir(id) {
        var saldoAkhir = <?=$saldoAkhir?>;
        return saldoAkhir[id];
    }
</script>