
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
                            <span>Harap dibayar</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table id="example" class="table custom-table table-bordered thead-center" style="width:100%;font-size: 11px;">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Klien</th>
                    <th>Deskripsi</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
            <?php
            
            foreach ($alldata as $key => $val) {
                if($val['status'] == 'Lunas') $status = '<label class="label bg-success">'.$val['status'].'</label>';
                else $status = '<label class="label bg-danger">'.$val['status'].'</label>';

                $mbTanggal = $val['tanggal_awal'] != $val['tanggal_akhir'] || $val['tanggal_tempo'] != null ? '' : 'mb-lg-0';
                $tanggal = '<h6 class="longDate'.$mbTanggal.'">'.date_format(date_create($val['tanggal_awal']), 'd M Y, H:i').'</h6>';
                if($val['tanggal_awal'] != $val['tanggal_akhir']){
                    $tanggal .= '<p style="font-size: 9px;" class="m-0 text-secondary">Diperbarui: '.date_format(date_create($val['tanggal_akhir']), 'd M Y, H:i').'</p>';
                }
                if($val['tanggal_tempo'] != null){
                    $tanggal .= '<p style="font-size: 9px;" class="m-0 text-secondary">Jatuh Tempo: '.date_format(date_create($val['tanggal_tempo']), 'd M Y, H:i').'</p>';
                }

                
                $mbSaldo = $val['saldo_awal'] != $val['saldo_akhir'] ? '' : 'class="mb-lg-0"';  
                $saldonya = '<h6 '.$mbSaldo.'>Rp. '.number_format($val['saldo_akhir'], 0, ',', '.').'</h6>';
                if($val['saldo_awal'] != $val['saldo_akhir']){
                    $saldonya .= '<p style="font-size: 9px;" class="m-0 text-secondary">Saldo Awal: Rp. '.number_format($val['saldo_awal'], 0, ',', '.').'</p>';
                }
            ?>
                <tr>
                    <td class="text-center align-middle"><?=$status?></td>
                    <td class="text-center align-middle"><?=$tanggal?></td>
                    <td class="align-middle"><?=$val['klien']?></td>
                    <td class="align-middle"><?=$val['deskripsi']?></td>
                    <td class="text-center align-middle"><?=$saldonya?></td>
                </tr>
           <?php } ?>
            </tbody>
        </table>
    </div>
    </page>
