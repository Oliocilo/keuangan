<style>
    body { background-color: transparent !important; }
    @page { size: auto; size: A4 portrait; font-family: "Times New Roman", Times, serif !important; }
</style>

<page>
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
    <table class="table table-condensed smalltable">
        <thead>
            <tr>
                <th style="width:60%">Saldo Awal</th>
                <th class="text-right" >Rp.</th>
                <th class="text-right"><?=number_format($rekapKasUmum['saldo_awal'], 0, ',', '.')?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th colspan="3"></th>
            </tr>
            <tr>
                <th scope="row">Semua Pemasukan</th>
                <td class="text-right" >Rp.</td>
                <td class="text-right"><?=number_format($rekapKasUmum['transaksi'][0]['total_masuk'], 0, ',', '.')?></td>
            </tr>
            <tr>
                <th scope="row">Semua Pengeluaran</th>
                <td class="text-right" >Rp.</td>
                <td class="text-right"><?=number_format($rekapKasUmum['transaksi'][0]['total_keluar'], 0, ',', '.')?></td>
            </tr>
            <tr>
                <th class="text-right" scope="row">Akumulasi</th>
                <td class="text-right" >Rp.</td>
                <td class="text-right"><?=number_format($rekapKasUmum['transaksi'][0]['diff_total'], 0, ',', '.')?></td>
            </tr>

            <tr>
                <th colspan="3"></th>
            </tr>
            <tr>
                <th scope="row">Transfer Masuk</th>
                <td class="text-right" >Rp.</td>
                <td class="text-right"><?=number_format($rekapKasUmum['transfer'][0]['total_masuk'], 0, ',', '.')?></td>
            </tr>
            <tr>
                <th scope="row">Transfer Keluar</th>
                <td class="text-right" >Rp.</td>
                <td class="text-right"><?=number_format($rekapKasUmum['transfer'][0]['total_keluar'], 0, ',', '.')?></td>
            </tr>
            <tr>
                <th class="text-right" scope="row">Akumulasi</th>
                <td class="text-right" >Rp.</td>
                <td class="text-right"><?=number_format($rekapKasUmum['transfer'][0]['diff_total'], 0, ',', '.')?></td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th colspan="3"></th>
            </tr>
            <tr>
                <th style="width:50%">Saldo Akhir</th>
                <th style="width:1px" class="text-right" >Rp.</th>
                <th class="text-right"><?=number_format($rekapKasUmum['saldo_akhir'], 0, ',', '.')?></th>
            </tr>
        </thead>
    </table>
    <hr>
    <h3>Rekap Buku Kas per Kategori</h3>
    <table  class="table  table-condensed smalltable thead-center " width="100%">
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
                        <td class="font-weight-bold" style="background:#ddd"><?=$rKat['nama_kategori']?></td>
                        <td class="text-right" class="text-right" >Rp. <?=number_format($rKat['total_masuk'], 0, ',', '.')?></td>
                        <td class="text-right" class="text-right" >Rp. <?=number_format($rKat['total_keluar'], 0, ',', '.')?></td>
                    </tr>
                    
                    <tr class="my-5">
                        <td style="padding: 0 !important">
                            <table class="table my-3" style="width:80% !important;" id="subKategori_<?=$key+1?>">
                                <thead>
                                    <tr>
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
                                            <td class="font-weight-bold" <?=$rKatDet['bgTipe']?>><?=$rKatDet['tanggal']?></td>
                                            <td class="text-right text-break"><?=$rKatDet['deskripsi']?></td>
                                            <td class="text-right" class="text-right" >Rp. <?=number_format($rKatDet['nominal'], 0, ',', '.')?></td>
                                        </tr>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Total</th>
                                        <td class="text-right font-weight-bold" class="text-right" >Rp. <?=number_format($totalNominal, 0, ',', '.')?></td>
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
                <td class="text-right font-weight-bold" class="text-right" >Rp. <?=number_format($totalMasuk, 0, ',', '.')?></td>
                <td class="text-right font-weight-bold" class="text-right" >Rp. <?=number_format($totalKeluar, 0, ',', '.')?></td>
            </tr>
            <tr>
                <th>Sub Total</th>
                <td colspan="2" class="text-right font-weight-bold" class="text-right" >Rp. <?=number_format($totalMasuk - $totalKeluar, 0, ',', '.')?></td>
            </tr>
        </tfoot>
    </table>
    <hr>
    <h3>Rekap Akumulasi Transfer per Buku Kas</h3>
    <table  class="table table-condensed smalltable thead-center " width="100%">
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
                <td class="font-weight-bold" style="background:#ddd"><?=$rKas['namaBuku']?></td>
                <td class="text-right" class="text-right text-break" >Rp. <?=number_format($rKas['tf_masuk'], 0, ',', '.')?></td>
                <td class="text-right" class="text-right" >Rp. <?=number_format($rKas['tf_keluar'], 0, ',', '.')?></td>
            </tr>
                    
            <tr>
                <td style="padding: 0 !important">
                    <table class="table my-3" style="width:80% !important;" id="subTransfer_<?=$key+1?>">
                        <thead>
                            <tr>
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
                                    <td class="font-weight-bold" <?=$rKatDet['bgTipe']?>><?=$rKatDet['tanggal']?></td>
                                    <td class="text-right"><?=$rKatDet['deskripsi']?></td>
                                    <td class="text-right" class="text-right" >Rp. <?=number_format($rKatDet['nominal'], 0, ',', '.')?></td>
                                </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">Total</th>
                                <td class="text-right font-weight-bold" class="text-right" >Rp. <?=number_format($totalNominal, 0, ',', '.')?></td>
                            </tr>
                        </tfoot>
                    </table>
                </td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th class="">Total</th>
                <td class="text-right font-weight-bold" class="text-right" >Rp. <?=number_format($totalTfMasuk, 0, ',', '.')?></td>
                <td class="text-right font-weight-bold" class="text-right" >Rp. <?=number_format($totalTfKeluar, 0, ',', '.')?></td>
            </tr>
        </tfoot>
    </table>
</page>