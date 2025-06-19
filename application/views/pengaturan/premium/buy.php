<div class="page-wrapper">
    

    <div class="page-body">
        <div class="package">
   <div class="pheader">
       KONFIRMASI
   </div>
   <div class="pbody">
    <form  action="<?= base_url('pengaturan/premium/pembayaran/') ?>" method="POST">
        <input type="hidden" name="id_premium" value="<?=$rtc['id']?>">
       <p class="text-center">
           Anda telah memilih berlangganan Paket Premium
       </p>

       <h4 class="text-center">Paket Langganan</h4>
       
       <div class="cards">
           <div class="card bg-c-green">
                <div class="card-block text-center">
                    <h1 class="d-block f-40"><?=$rtc['value']?></h1>
                    <h4 class="m-t-20"><?=$rtc['satuan']?></h4>
                    <h2 class="m-b-40 m-t-40">Rp. <?=number_format($rtc['harga'], 0, ',', '.')?></h2>
                    
                </div>
            </div>
            <hr>
            <div class="">
                <button class="btn btn-primary btn-block btn-md">Bayar</button>
         </div>
       </div>
   </form>
   </div>
</div>
    </div>
</div>