
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
                            <span>Penyimpanan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table id="example" class="table custom-table table-bordered thead-center" style="width:100%;font-size: 11px;">
            <thead>
                <tr>
                    <th>Kode Aset</th>
                    <th>Nama Aset</th>
                    <th>Tanggal Beli</th>
                    <th>Jenis Penyusutan</th>
                    <th>Nilai Buku</th>
                </tr>
            </thead>
            <tbody>
            <?php
            
            foreach ($alldata as $key => $val) {
            ?>
                <tr class="text-center align-middle">
                    <td><?=$val['kode_aset']?></td>
                    <td><?=$val['nama_aset']?></td>
                    <td><?=$val['tanggal_pembelian']?></td>
                    <td><?=$val['jenis_penyusutan']?></td>
                    <td>Rp. <?=number_format($val['nilai_perolehan'], 0, ',', '.')?></td>
                </tr>
           <?php } ?>
            </tbody>
        </table>
    </div>
    </page>
