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
                        <span><?=$deskripsi==''?"Harap dibayar":$deskripsi?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 info-saldo">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xl-4 col-6">
                        <div class="card z-depth-5 waves-effect cardinfosaldo">
                            <div class="card-body">
                                <h6 class="text-muted m-b-10">Saldo Awal</h6>
                                <h5 class="m-b-0">Rp. <?=number_format($saldo_awal, 0, ',', '.')?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-6">
                        <div class="card z-depth-5 waves-effect cardinfosaldo">
                            <div class="card-body">
                                <h6 class="text-muted m-b-10">Saldo Akhir</h6>
                                <h5 class="m-b-0">Rp. <?=number_format($saldo_akhir, 0, ',', '.')?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card z-depth-5 waves-effect cardinfosaldo">
                            <div class="card-body">
                                <h6 class="text-muted m-b-10">Total Saldo <?=$tipe?></h6>
                                <h5 class="m-b-0">Rp. <?=number_format($total_saldo, 0, ',', '.')?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="card">
            <div class="card-header filterCard">
                <div class="row m-b-10 b-b-primary p-b-10 ">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-4 text-right">
                        <button class="btn btn-success btn-outline-primary" onclick="renderExcel()"><i class="icofont icofont-file-excel" ></i> Ekspor Excel</button>
                        <button class="btn btn-danger btn-outline-primary" onclick="renderPdf()"><i class="icofont icofont-file-pdf"></i> Print Pdf</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right">
                    </div>
                    <div class="col-md-8 text-right">
                        <?php if($saldo_akhir != 0){?>
                        <button onclick="addForm(<?= $idnya.',\''.$tipe.'\'' ?>,'Bayar')" class="btn <?= $tipe == 'Utang' ? 'btn-success' : 'btn-danger' ?>" data-toggle="tooltip" data-placement="top" title="Bayar <?= $tipe ?>"><i class="fa fa-minus-square"></i> <?= $tipe == "Utang" ? "Bayar Utang" : "Piutang Dibayar" ?></button>
                        <?php } ?>
                        <button onclick="addForm(<?= $idnya.',\''.$tipe.'\'' ?>,'Tambah')" class="btn <?= $tipe == 'Utang' ? 'btn-danger' : 'btn-success'?>" data-toggle="tooltip" data-placement="top" title=" Tambah <?= $tipe ?>"><i class="fa fa-plus-square"></i> Tambah <?= $tipe ?></button>
                    </div>
                </div>
            </div>
            <div class="card-body cardbodytbale mb-5 mb-md-0">
                <table id="example" data-id="<?=$idnya?>" data-tipe="<?=$tipe?>" data-idbuku="<?=$idbuku?>" class="table custom-table table-hover table-bordered thead-center dataTable" width="100%">
                    <thead>
                        <tr>
                            <th class="min-mobile">Tipe</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
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
            <td style="width: 50%;padding: 0px;">
                <button onclick="addForm(<?= $idnya.',\''.$tipe.'\'' ?>,'Bayar')" class="btn btn-sm btn-block <?= $tipe == 'Utang' ? 'btn-success' : 'btn-danger' ?>" data-toggle="tooltip" data-placement="top" title="Bayar <?= $tipe ?>"><i class="fa fa-plus-square"></i> Bayar <?= $tipe ?></button>
            </td>
            <td style="width: 50%;padding: 0px;">
                <button onclick="addForm(<?= $idnya.',\''.$tipe.'\'' ?>,'Tambah')" class="btn btn-sm btn-block <?= $tipe == 'Utang' ? 'btn-danger' : 'btn-success'?>" data-toggle="tooltip" data-placement="top" title=" Tambah <?= $tipe ?>"><i class="fa fa-plus-square"></i> Tambah <?= $tipe ?></button>
            </td>
        </tr>
    </table>
</div>
<div id="formDelete"></div>