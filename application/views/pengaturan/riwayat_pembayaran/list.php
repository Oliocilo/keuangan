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
        <div class="card" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
            <div class="card-body">
                <div class="row">
                    <?php
                    if($ada_riwayat){ 
                        foreach($rtc as $p){ 
                    ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-green update-card">
                                <div class="card-block">
                                    <h4 class="text-white"><?=$p['jumlah_satuan'].' '.$p['tipe_satuan']?> Premium, Rp. <?=number_format($p['harga'], 0, ',', '.')?></h4>
                                    <h6 class="text-white m-b-0">Transfer ke <?=$p['metode']?></h6>
                                    <h6 class="text-white m-b-0 font-weight-bold">Status: <?=$p['status']?></h6>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i><?=date_format(date_create($p['tanggal_bayar']), 'd F Y, H:i:s')?></p>
                                </div>
                            </div>
                        </div>
                    <?php 
                        } 
                    } else {
                    ?>
                    <div class="col-12 text-center">Belum ada riwayat pembelian.</div>
                    <?php 
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

