

<div class="page-wrapper">
<div class="card page-header p-0">
        <div class="card-block front-icon-breadcrumb row align-items-end">
            <div class="breadcrumb-header col title-bukukas">
                <div class="big-icon">
                    <i class="fa fa-book"></i>
                </div>
                <div class="d-inline-block">
                    <h5><?=$page_name?></h5>
                    <span><?=$aset['nama_aset']?></span>
                </div>
            </div>
            <div class="col text-right">
                
            </div>
        </div>
    </div>

<div class="page-body">
    
    

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                   <table class="table table-hover table-condensed smalltable">
                    <tbody>
                        <tr>
                            <th>Kode Aset</th>
                            <td style="width:1px">:</td>
                            <td><?=$aset['kode_aset']?></td>
                        </tr>
                        <tr>
                            <th>Kode Aset</th>
                            <td style="width:1px">:</td>
                            <td><?=$aset['nama_aset']?></td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td style="width:1px">:</td>
                            <td><?=$aset['nama_kategori']?></td>
                        </tr>
                        <tr>
                            <th>Nilai Beli</th>
                            <td style="width:1px">:</td>
                            <td>Rp. <?=number_format($aset['nilai_satuan'], 0, ',', '.')?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Pembelian</th>
                            <td style="width:1px">:</td>
                            <td><?=$aset['tanggal_pembelian']?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                   <table class="table table-hover table-condensed smalltable">
                    <tbody>
                        <tr>
                            <th>Metode Penyusutan</th>
                            <td style="width:1px">:</td>
                            <td><?=ucwords(str_replace('_',' ',$aset['metode_penyusutan']))?></td>
                        </tr>
                        <tr>
                            <th>Masa Manfaat</th>
                            <td style="width:1px">:</td>
                            <td><?=$aset['masa_manfaat']?> Tahun</td>
                        </tr>
                        <tr>
                            <th>Tarif Penyusutan</th>
                            <td style="width:1px">:</td>
                            <td><?=$aset['tarif_penyusutan']?>%</td>
                        </tr>
                        <?php if($aset['metode_penyusutan'] == 'garis_lurus'){ ?>
                        <tr>
                            <th>Nilai Residu</th>
                            <td style="width:1px">:</td>
                            <td>Rp. <?=number_format($aset['nilai_residu'], 0, ',', '.')?></td>
                        </tr>
                        <tr>
                            <th>Penyusutan Tahunan</th>
                            <td style="width:1px">:</td>
                            <td>Rp. <?=number_format($aset['penyusutan_tahunan'], 0, ',', '.')?></td>
                        </tr>
                        <tr>
                            <th>Penyusutan Bulanan</th>
                            <td style="width:1px">:</td>
                            <td>Rp. <?=number_format($aset['penyusutan_bulanan'], 0, ',', '.')?></td>
                        </tr>
                    <?php } ?>
                    <?php if($aset['metode_penyusutan'] == 'saldo_menurun'){ ?>
                        <tr>
                            <th>Nilai Residu</th>
                            <td style="width:1px">:</td>
                            <td>Rp. <?=number_format($aset['nilai_residu'], 0, ',', '.')?></td>
                        </tr>
                        <tr>
                            <th>Penyusutan Tahunan</th>
                            <td style="width:1px">:</td>
                            <td>Rp. <?=number_format($aset['penyusutan_tahunan'], 0, ',', '.')?></td>
                        </tr>
                        <tr>
                            <th>Penyusutan Bulanan</th>
                            <td style="width:1px">:</td>
                            <td>Rp. <?=number_format($aset['penyusutan_bulanan'], 0, ',', '.')?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs  tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home1" role="tab" aria-selected="false">Tabel Penyusutan Tahunan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile1" role="tab" aria-selected="false">Grafik Penyusutan Tahunan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#messages1" role="tab" aria-selected="false">Tabel Penyusutan Bulanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#settings1" role="tab" aria-selected="true">Grafik Penyusutan Bulanan</a>
                    </li>
                </ul>

                <div class="tab-content tabs">
                    <div class="tab-pane active" id="home1" role="tabpanel">
                     <?=$v_tahunan?>
                    </div>
                    <div class="tab-pane" id="profile1" role="tabpanel">
                        <div style="height:500px">
                       <?=$v_grafik_tahunan?>
                   </div>
                    </div>
                    <div class="tab-pane" id="messages1" role="tabpanel">
                     <?=$v_bulanan?>
                    </div>
                    <div class="tab-pane" id="settings1" role="tabpanel">
                         <div style="height:500px">
                        <?=$v_grafik_bulanan?>
                    </div>
                    </div>
                </div>
            </div>

           

        </div>
           
        </div>
    </div>
</div>
</div>

