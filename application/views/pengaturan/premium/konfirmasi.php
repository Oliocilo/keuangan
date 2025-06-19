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
        <div class="row">
            <div class="col-md-12">
            <div class="card" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
                <div class="card-body text-center">
                    <div class="text-center">
                    <img src="<?=base_url('assets/images/check.png')?>" style="width: 200px;">
                </div>
                 <h3><b>Terima Kasih, <?=$this->session->userdata('nama');?>!</b></h3>
                 Kami sedang memeriksa pembayaran Anda<br>
                 Jika transfer sudah kami terima, maka kami akan segera mengupgrade atau memperpanjang status PREMIUM Anda.<br>
                 Mohon beri tahu kami jika status PREMIUM Anda tidak terupgrade atau belum diperpanjang hingga 3 hari ke depan.


                </div>
            </div>
        </div>
        </div>

        
    </div>
</div>

