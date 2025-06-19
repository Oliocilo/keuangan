
    <style>
        @page { size: auto; size: A4 portrait; }

        

    </style>
  
    <page>
        <div class="content-block">
           <div class="row">
            <div class="col-md-4">
                <div class="card user-card-full">
                    <div class="card-block front-icon-breadcrumb  card-booktitle">
                        <h6 class="m-b-20 p-b-5 b-b-primary f-w-600">Informasi
                        </h6>
                        <div class="big-icon">
                            <i class="fa fa-book"></i>
                        </div>
                        <div class="d-inline-block">
                            <h5 class="text-primary font-weight-bold"><?=$page_name?></h5>
                            <span><?=$bukuDetail['deskripsi']?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table id="example" class="table custom-table table-bordered thead-center" style="width:100%;font-size: 11px;">
            <thead>
                <tr>
                    <th rowspan="2">Tipe</th>
                    <th rowspan="2">Tanggal</th>
                    <th rowspan="2">Kategori</th>
                    <th colspan="2">Jenis</th>
                    <th rowspan="2">Saldo Akhir</th>
                </tr>
                <tr>
                    <th>Pemasukan</th>
                    <th>Pengeluaran</th>
                </tr>
            </thead>
            <tbody>
            <?php
            
            foreach ($transaksiBuku as $key => $val) {?>
                <tr>
                 <td><?=$val['tipe']?></td>
                 <td><?=$val['tanggal']?></td>
                 <td><?=$val['nama_kategori']?></td>
                 <td><?=$val['nominal_masuk']?></td>
                 <td><?=$val['nominal_keluar']?></td>
                 <td><?=$saldoBuku[$val['id']]?></td>
             </tr>
           <?php } ?>
            </tbody>
        </table>
    </div>
    </page>
