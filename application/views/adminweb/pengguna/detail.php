<div class="page-wrapper">
    <div class="card page-header p-0 titleweb">
        <div class="card-block front-icon-breadcrumb row align-items-end">
            <div class="breadcrumb-header col ">
                <div class="d-inline-block">
                 <h5><?=$page_name?></h5>

             </div>
         </div>
     </div>
 </div>

 <div class="page-body">
      <div class="row">
        <div class="col-xl-6 col-md-12">
            <div class="card user-card-full">
                <div class="row m-l-0 m-r-0">
                    <div class="col-sm-4 bg-c-lite-green user-profile">
                        <div class="card-block text-center text-white">
                            <div class="m-b-25">
                                <img src="<?=base_url('assets/images/user/user1.jpg')?>" class="img-radius" style="width: 100px;" alt="User-Profile-Image">
                            </div>
                            <h6 class="f-w-600"><?=$pengguna['nama']?></h6>
                            <p>
                                <?php  if($pengguna['type'] == 0){ ?>
                                    <label class="label label-inverse">Free</label>
                                <?php }else{ ?>
                                    <label class="label label-success">Premium</label>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="card-block">
                            <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Informasi
                            </h6>
                            <div class="row">
                                <div class="col-12">
                                    <table style="width:100%">
                                    <tr>
                                        <th>Email</th>
                                        <th style="width:5px">:</th>
                                        <td><?=$pengguna['username']?></td>
                                    </tr>
                                    <tr>
                                        <th>Telepon</th>
                                        <th style="width:5px">:</th>
                                        <td><?=$pengguna['telepon']?></td>
                                    </tr>
                                </table>
                                </div>
                            </div>
                            <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">
                            Alamat</h6>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="m-b-10 f-w-600">Recent</p>
                                    <h6 class="text-muted f-w-400">Guruable Admin
                                    </h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="m-b-10 f-w-600">Most Viewed</p>
                                    <h6 class="text-muted f-w-400">Able Pro Admin
                                    </h6>
                                </div>
                            </div>
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
</div>
</div>