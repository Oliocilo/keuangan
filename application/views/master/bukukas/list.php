<div class="page-wrapper">
    <div class="card page-header p-0" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
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
                <button id="addBukuKas" class="btn btn-primary" data-toggle="modal" data-target="#default-Modal"><i class="fa fa-plus"></i> Buat Buku Kas</button>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="row m-b-20">
            <?php foreach ($bukukasMaster as $key => $bukum) { ?>
                <div class="col-xl-4 col-md-12">
                    <div class="card bukukas-card">
                        <div class="card-header text-primary">
                            <div class="media">
                                <a class="media-left media-middle" href="#">
                                    <i class="fa fa-book fa-4x"></i>
                                </a>
                                <div class="media-body media-middle">
                                    <div class="company-name" style="height: 100px;">
                                        <p><?=$bukum['nama']?></p>
                                        <span class="text-muted f-12"><?=$bukum['deskripsi']?></span>
                                    </div>
                                    <?php if($bukum['is_default'] == 1){ ?>
                                        <div class="job-badge">
                                            <label class="label bg-primary">Default</label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand"><div class=""></div></div>
                                <div class="chartjs-size-monitor-shrink"><div class=""></div></div>
                            </div>
                            <canvas id="newuserchart<?=$bukum['id_buku']?>" height="224" width="259" style="display: block; height: 250px; width: 208px;" class="chartjs-render-monitor"></canvas>
                        </div>
                        <div class="card-footer">
                            <div class="row text-center b-t-default ">
                                <div class="col-6 b-r-default m-t-15">
                                    <span class="f-15 text-primary"><i class="fa fa-money"></i> Saldo Awal</span>
                                    <p class="text-black m-b-0">Rp. <?=number_format($bukum['saldo_awal'], 0, ',', '.')?></p>
                                </div>
                                <div class="col-6 m-t-15">
                                    <span class="f-15 text-primary"><i class="fa fa-money"></i> Saldo Akhir</span>
                                    <p class="text-black m-b-0">Rp. <?=number_format($bukum['saldo_akhir'], 0, ',', '.')?></p>
                                </div>
                            </div>
                            <hr>
                            <?php if(!$bukum['is_default']){?>
                                <button class="btn btn-success pull-right btn-sm" onclick="defaultAlert('<?=base_url('master/bukukas/default/'.$bukum['id_buku'])?>')"><i class="fa fa-wrench"></i> Set Default</button>
                                <button class="btn btn-danger pull-right btn-sm m-r-5" onclick="deleteAlert('<?=base_url('master/bukukas/delete/'.$bukum['id_buku'])?>')"><i class="fa fa-trash"></i> Delete</button>
                            <?php } ?>
                            <button class="btn btn-secondary pull-right btn-sm  m-r-5" onclick="editForm(<?=$bukum['id_buku']?>)" data-toggle="modal" data-target="#default-Modal"><i class="fa fa-edit"></i> Edit</button>
                        </div>
                    </div>
                    <input type="hidden" class="chartData" value="newuserchart<?=$bukum['id_buku']?>,<?=$bukum['total_pemasukan']?>,<?=$bukum['total_pengeluaran']?>">
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div id="formDelete"></div>
