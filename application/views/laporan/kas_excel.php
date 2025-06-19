
<table width="100%">
    <tr>
        <th colspan="7" class="text-center"><h2><?=$page_name?></h2></th>
    </tr>
    <tr>
        <th colspan="7" class="text-center"><h3><?=$page_description?></h3></th>
    </tr>
</table>
<hr>
<h3>Rekap Buku Kas Umum</h3>
<table width="100%">
    <thead>
        <tr>
            <th style="width:60%; text-align: left;">Saldo Awal</th>
            <th style="text-align: right;">Rp.</th>
            <th style="text-align: right;"><?=number_format($rekapKasUmum['saldo_awal'], 0, ',', '.')?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="3"></th>
        </tr>
        <tr>
            <th scope="row" style="text-align: left;">Semua Pemasukan</th>
            <td style="text-align: right;" >Rp.</td>
            <td style="text-align: right; mso-number-format:'\@';"><?=number_format($rekapKasUmum['transaksi'][0]['total_masuk'], 0, ',', '.')?></td>
        </tr>
        <tr>
            <th scope="row" style="text-align: left;">Semua Pengeluaran</th>
            <td style="text-align: right;" >Rp.</td>
            <td style="text-align: right;"><?=number_format($rekapKasUmum['transaksi'][0]['total_keluar'], 0, ',', '.')?></td>
        </tr>
        <tr>
            <th style="text-align: right;" scope="row">Akumulasi</th>
            <td style="text-align: right;" >Rp.</td>
            <td style="text-align: right; mso-number-format:'\@';"><?=number_format($rekapKasUmum['transaksi'][0]['diff_total'], 0, ',', '.')?></td>
        </tr>

        <tr>
            <th colspan="3"></th>
        </tr>
        <tr>
            <th scope="row" style="text-align: left;">Transfer Masuk</th>
            <td style="text-align: right;" >Rp.</td>
            <td style="text-align: right;"><?=number_format($rekapKasUmum['transfer'][0]['total_masuk'], 0, ',', '.')?></td>
        </tr>
        <tr>
            <th scope="row" style="text-align: left;">Transfer Keluar</th>
            <td style="text-align: right;" >Rp.</td>
            <td style="text-align: right;"><?=number_format($rekapKasUmum['transfer'][0]['total_keluar'], 0, ',', '.')?></td>
        </tr>
        <tr>
            <th style="text-align: right;" scope="row">Akumulasi</th>
            <td style="text-align: right;" >Rp.</td>
            <td style="text-align: right;"><?=number_format($rekapKasUmum['transfer'][0]['diff_total'], 0, ',', '.')?></td>
        </tr>
    </tbody>
    <thead>
        <tr>
            <th colspan="3"></th>
        </tr>
        <tr>
            <th style="width:50%; text-align: left;">Saldo Akhir</th>
            <th style="width:1px; text-align: right;">Rp.</th>
            <th style="text-align: right;"><?=number_format($rekapKasUmum['saldo_akhir'], 0, ',', '.')?></th>
        </tr>
    </thead>
</table>
<hr>
<h3>Rekap Buku Kas per Kategori</h3>
<table width="100%">
    <thead>
        <tr>
            <th>Kategori</th>
            <th>Pemasukan</th>
            <th>Pengeluaran</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $totalMasuk = 0;
            $totalKeluar = 0;
            foreach ($rekapKategori['kategori'] as $key => $rKat) { 
                $totalMasuk += $rKat['total_masuk'];
                $totalKeluar += $rKat['total_keluar'];
                ?>
                <tr>
                    <td style="background:#ddd; font-weight: bold;"><?=$rKat['nama_kategori']?></td>
                    <td style="text-align: right;" >Rp. <?=number_format($rKat['total_masuk'], 0, ',', '.')?></td>
                    <td style="text-align: right;" >Rp. <?=number_format($rKat['total_keluar'], 0, ',', '.')?></td>
                </tr>
                
                <tr class="my-5">
                    <td colspan="7" style="padding: 0 !important">
                        <table width="100%" style="width:80% !important;" id="subKategori_<?=$key+1?>">
                            <thead>
                                <tr>
                                    <th rowspan="<?=count($rekapKategori['detail'][$rKat['nama_kategori']])+2?>" colspan="4"></th>
                                    <th>Tanggal</th>
                                    <th>Deskripsi</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $totalNominal = 0;
                                foreach ($rekapKategori['detail'][$rKat['nama_kategori']] as $key2 => $rKatDet) { 
                                    $totalNominal += $rKatDet['nominal'];
                            ?>
                                    <tr>
                                        <td style="font-weight: bold;" <?=$rKatDet['bgTipe']?>><?=$rKatDet['tanggal']?></td>
                                        <td style="text-align: right;"><?=$rKatDet['deskripsi']?></td>
                                        <td style="text-align: right;" >Rp. <?=number_format($rKatDet['nominal'], 0, ',', '.')?></td>
                                    </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">Total</th>
                                    <td style="text-align: right; font-weight: bold;" >Rp. <?=number_format($totalNominal, 0, ',', '.')?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </td>
                </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Total</th>
            <td style="text-align: right; font-weight: bold;" >Rp. <?=number_format($totalMasuk, 0, ',', '.')?></td>
            <td style="text-align: right; font-weight: bold;" >Rp. <?=number_format($totalKeluar, 0, ',', '.')?></td>
        </tr>
        <tr>
            <th>Sub Total</th>
            <td colspan="2" style="text-align: right; font-weight: bold;" >Rp. <?=number_format($totalMasuk - $totalKeluar, 0, ',', '.')?></td>
        </tr>
    </tfoot>
</table>
<hr>
<h3>Rekap Akumulasi Transfer per Buku Kas</h3>
<table class="table table-condensed smalltable thead-center " width="100%">
    <thead>
        <tr>
            <th>Buku Kas</th>
            <th>Transfer Masuk</th>
            <th>Transfer Keluar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $totalTfMasuk = 0;
        $totalTfKeluar = 0;
        foreach ($rekapKas['buku'] as $key => $rKas) { 
            $totalTfMasuk += $rKas['tf_masuk'];
            $totalTfKeluar += $rKas['tf_keluar'];
            ?>
        <tr>
            <td style="background:#ddd; font-weight: bold;"><?=$rKas['namaBuku']?></td>
            <td style="text-align: right;" >Rp. <?=number_format($rKas['tf_masuk'], 0, ',', '.')?></td>
            <td style="text-align: right;" >Rp. <?=number_format($rKas['tf_keluar'], 0, ',', '.')?></td>
        </tr>
                
        <tr>
            <td colspan="7" style="padding: 0 !important">
                <table class="table my-3" style="width:80% !important;" id="subTransfer_<?=$key+1?>">
                    <thead>
                        <tr>
                            <th rowspan="<?=count($rekapKategori['detail'][$rKat['nama_kategori']])+2?>" colspan="4"></th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $totalNominal = 0;
                        foreach ($rekapKas['detail'][$rKas['namaBuku']] as $key2 => $rKatDet) { 
                            $totalNominal += $rKatDet['nominal'];
                    ?>
                            <tr>
                                <td style="font-weight: bold;" <?=$rKatDet['bgTipe']?>><?=$rKatDet['tanggal']?></td>
                                <td style="text-align: right;"><?=$rKatDet['deskripsi']?></td>
                                <td style="text-align: right;" >Rp. <?=number_format($rKatDet['nominal'], 0, ',', '.')?></td>
                            </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">Total</th>
                            <td style="text-align: right; font-weight: bold;" >Rp. <?=number_format($totalNominal, 0, ',', '.')?></td>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th style="text-align: left;">Total</th>
            <td style="text-align: right; font-weight: bold;" >Rp. <?=number_format($totalTfMasuk, 0, ',', '.')?></td>
            <td style="text-align: right; font-weight: bold;" >Rp. <?=number_format($totalTfKeluar, 0, ',', '.')?></td>
        </tr>
    </tfoot>
</table>