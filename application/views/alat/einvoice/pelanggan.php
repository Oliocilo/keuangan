<div class="page-wrapper">
    <div class="card page-header p-0" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;">
        <div class="card-block front-icon-breadcrumb row align-items-end">
            <div class="breadcrumb-header col title-bukukas">
                <div class="big-icon">
                    <i class="fa fa-cogs"></i>
                </div>
                <div class="d-inline-block">
                    <h5><?=$page_name?></h5>
                    <span>Peralatan</span>
                </div>
            </div>
            <div class="col text-right">

            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="m-b-25">
                  <a href="<?=base_url('alat/einvoice')?>">
                      <button class="btn btn-outline-secondary">Buat Invoice</button>
                  </a>
                  
                  <a href="<?=base_url('alat/einvoice/list')?>">
                      <button class="btn btn-outline-secondary">Buku Invoice</button>
                  </a>

                  <a href="#">
                  <button class="btn btn-primary">Daftar Pelanggan</button>
              </a>
         
        </div>


        <div class="card" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
            <div class="card-header bg-primary cardtitleAlat">
                  <span class="text-white" style="font-size: 18px !important;">Daftar Pelanggan</span>
            </div>
            <div class="card-body">
                 <div class="row m-b-10 b-b-primary p-b-10">
                    <div class="col-md-8">


                    </div>

                    <div class="col-md-4 text-right">
                        <button id="add" class="btn btn-success" data-toggle="modal" data-target="#default-Modal"><i class="fa fa-plus"></i> Tambah Pelanggan</button>
                    </div>
                </div>
                <table id="example" class="table custom-table  table-hover table-bordered thead-center " width="100%">
                    <thead>
                        <tr>
                            <th class="min-mobile" style="width: 40px;">No</th>
                            <th class="min-mobile">Nama</th>
                            <th class="min-mobile">Alamat</th>
                            <th style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

