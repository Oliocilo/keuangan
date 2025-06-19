<div class="page-wrapper">
    <div class="row justify-content-between">
        <div class="col-md-4">
            <div class="card user-card-full cardbook">
                <div class="card-block front-icon-breadcrumb  card-booktitle">
                    <div class="big-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="d-inline-block">
                        <h5 class="text-primary font-weight-bold titlebook"><?=$page_name?></h5>
                        <span>Harap dibayar</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 info-saldo">
            <div class="card z-depth-5 waves-effect cardinfosaldo">
                <div class="card-body">
                    <h6 class="text-muted m-b-10">Total Saldo <?= $tipe ?></h6>
                    <h5 class="m-b-0">Rp. <?=number_format($total_saldo, 0, ',', '.')?></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="card">
            <div class="card-header filterCard">
                <div class="row m-b-10 b-b-primary p-b-10 ">
                    <div class="col-md-8">
                        <form action="" method="GET" class="row" id="formFilter">
                            <div class="col-md-3">
                                <label>Bulan</label>
                                <select class="form-control" id="filterBulan" name="bulan">
                                    <?php
                                        $bulanNow = isset($_GET['bulan']) ? $_GET['bulan'] : "Semua Bulan";
                                    ?>
                                    <option value="Semua Bulan" <?= $bulanNow == "Semua Bulan" ? 'selected' : ''?>>Semua Bulan</option>
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
                        </form>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-3 d-flex flex-wrap align-items-center justify-content-between">
                        <button class="btn btn-success btn-outline-primary" onclick="renderExcel()"><i class="icofont icofont-file-excel" ></i> Ekspor Excel</button>
                        <button class="btn btn-danger btn-outline-primary" onclick="renderPdf()"><i class="icofont icofont-file-pdf"></i> Print Pdf</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right">
                    </div>
                    <div class="col-md-8 text-right">
                        <button onclick="addForm('<?= $tipe ?>')" class="btn <?= $tipe == 'Utang' ? 'btn-danger' : 'btn-success'?>" data-toggle="tooltip" data-placement="top" title="Tambah <?= $tipe ?>"><i class="fa fa-plus-square"></i> <?= $tipe ?> Baru</button>
                    </div>
                </div>
            </div>
            <div class="card-body cardbodytbale mb-5 mb-md-0">
                <div id="custom_element" class="hidden-xl" style="padding: 10px;">
                    <table class="table" style="margin-bottom :0px;">
                        <tr>
                            <td style="vertical-align:middle; width:20%; text-align:center;" onclick="gantiFilter('-')">
                                <i class="fa fa-caret-left"></i>
                            </td>
                            <td>
                                <select class="selectsmall" onchange="gantiFilter('Bulan',this.value)">
                                    <option value="">Semua Bulan</option>
                                        <?php
                                            $bulanNow = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
                                        ?>
                                        <?php foreach ($namaBulan as $key => $bln) { ?>
                                            <option value="<?=$key?>" <?=$bulanNow == $key ? 'selected' : ''?>><?=$bln?></option>
                                        <?php } ?>
                                </select>
                            </td>
                            <td>
                                <select class="selectsmall" onchange="gantiFilter('Tahun',this.value)">
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
                            <td style="vertical-align:middle; width:20%; text-align:center;" onclick="gantiFilter('+')">
                                <a href="#"><i class="fa fa-caret-right"></i></a>
                            </td>
                        </tr>
                    </table>
                </div>
                <table id="example" data-tipe="<?=$tipe?>" class="table custom-table table-hover table-bordered thead-center dataTable" width="100%">
                    <thead>
                        <tr>
                            <th class="min-mobile">Status</th>
                            <th>Tanggal</th>
                            <th>Klien</th>
                            <th class="min-mobile">Deskripsi</th>
                            <th class="min-mobile">Saldo</th>
                            <th class="min-mobile">Aksi</th>
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
            <td style="width: 100%;padding: 0px;">
                <button onclick="addForm('<?= $tipe ?>')" class="btn btn-sm btn-block <?= $tipe == 'Utang' ? 'btn-danger' : 'btn-success'?>" data-toggle="tooltip" data-placement="top" title="Tambah <?= $tipe ?>"><i class="fa fa-plus-square"></i> <?= $tipe ?> Baru</button>
            </td>
        </tr>
    </table>
</div>
<div id="formDelete"></div>