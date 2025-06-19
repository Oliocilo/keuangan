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
            <div class="card-header bg-primary cardtitleAlat">
                <?php
                    $bgColor = ['bg-c-green','bg-c-lite-green','bg-c-yellow','bg-c-pink'];
                    $text = "Akses penuh! Semua fitur bisa Anda gunakan.";
                    if($premium == 1) $text = "Perpanjangan";
                ?>
                <span class="text-white" style="font-size: 18px !important;"><?=$text?></span>
            </div>
            <div class="card-body">
                <div class="form-group row d-flex align-items-center">
                    <div class="col-md-6 col-lg-4">
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <label for="metode-1" class="block">Pilih Metode Pembayaran</label>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <select name="metode" id="metode-1" class="required form-control">
                            <option value="" selected disabled>Pilih Metode</option>
                            <?php 
                                $metode = ["Transfer Bank"];
                                foreach ($metode as $pg) { 
                                $text = '';
                                if("Transfer Bank" == $pg){
                                    $text = 'selected';
                                }
                                ?>
                                <option value="<?=$pg?>" <?=$text?>><?=$pg?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-4">
                    </div>
                </div>
                <div class="row">
                    <?php 
                        $no = 0;
                        foreach($rtc as $i => $p){ 
                            if($i>3) $no = 0;
                    ?>
                        <div class="col-md-6 col-lg-3">
                            <div class="card <?=$bgColor[$no]?>">
                                <div class="card-block text-center text-white">
                                    <h1 class="d-block f-40"><?=$p['value']?></h1>
                                    <h4 class="m-t-20"><?=$p['satuan']?></h4>
                                    <h2 class="m-b-40 m-t-40">Rp. <?=number_format($p['harga'], 0, ',', '.')?></h2>
                                    <a href="<?=base_url('premium/buy/'.$this->template->matEnc($p['id']))?>">
                                    <button class="btn btn-success btn-block btn-round">Beli</button>
                                </a>
                                </div>
                            </div>
                        </div>
                    <?php $no++; } ?>
                </div>
            </div>
            <?php if(!$premium){ ?>
            <div class="card-header bg-secondary cardtitleAlat">
                <span class="text-white" style="font-size: 18px !important;">Apa yang Anda dapatkan?</span>
            </div>
            <div class="card-body">
            </div>
            <?php } ?>
        </div>
    </div>
</div>

