 <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
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
            <div class="col-md-6">
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
                            <th>Penyusutan Tahun ini</th>
                            <td style="width:1px">:</td>
                            <td>Rp. <?=number_format($aset['penyusutan_tahunan'], 0, ',', '.')?></td>
                        </tr>
                        <tr>
                            <th>Penyusutan Bulan ini</th>
                            <td style="width:1px">:</td>
                            <td>Rp. <?=number_format($aset['penyusutan_bulanan'], 0, ',', '.')?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>