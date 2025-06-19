<table width="100%">
    <tr>
        <th colspan="4" class="text-center"><h2><?=$page_name?></h2></th>
    </tr>
    <tr>
        <th colspan="4" class="text-center"><h3><?=$page_description?></h3></th>
    </tr>
</table>
<hr>
<table width="100%">
    <thead>
        <tr>
            <th style="width:50%; text-decoration: underline;" colspan="4">Aktiva</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="4"></th>
        </tr>
        <tr>
            <th style="width:50%; text-decoration: underline;" colspan="4">Aktiva Lancar</th>
        </tr>
        <tr>
            <th colspan="4"></th>
        </tr>
        <tr>
            <th scope="row" class="pl-4" style="text-align: left;">Seluruh Kas</th>
            <td>Rp.</td>
            <td style="text-align: right;" colspan="2"><?=number_format($seluruhKas, 0, ',', '.')?></td>
        </tr>
        <tr>
            <th scope="row" class="pl-4" style="text-align: left;">Piutang Dagang</th>
            <td>Rp.</td>
            <td style="text-align: right; mso-number-format:'\@';" colspan="2"><?=number_format($totalPiutang, 0, ',', '.')?></td>
        </tr>
        <tr>
            <th scope="row" class="pl-4" style="text-align: left;">Persediaan Barang</th>
            <td>Rp.</td>
            <td style="text-align: right; mso-number-format:'\@';" colspan="2"><?=number_format($persediaanBarang, 0, ',', '.')?></td>
        </tr>
        <tr>
            <th style="text-align: right;" scope="row">Akumulasi</th>
            <td>Rp.</td>
            <td style="text-align: right;" colspan="2"><?=number_format($sumAktivaLancar, 0, ',', '.')?></td>
        </tr>

        <tr>
            <th colspan="4"></th>
        </tr>
        <tr>
            <th style="width:50%; text-decoration: underline;" colspan="4">Aktiva Tetap</th>
        </tr>
        <tr>
            <th colspan="4"></th>
        </tr>
        <?php
            $sumAset = 0;
            foreach($totalAset as $aset){
                $sumAset += $aset['total'];
        ?>
        <tr>
            <th scope="row" class="pl-4" style="text-align: left;"><?=$aset['nama_kategori']?></th>
            <td>Rp.</td>
            <td style="text-align: right;" colspan="2"><?=number_format($aset['total'], 0, ',', '.')?></td>
        </tr>
        <?php
            }
        ?>
        <tr>
        <tr>
            <th scope="row" class="pl-4" style="text-align: left;">Inventaris</th>
            <td>Rp.</td>
            <td colspan="2"><?=number_format(0, 0, ',', '.')?></td>
        </tr>
        <tr>
            <th scope="row" class="pl-4" style="text-align: left;">Akumulasi Penyusutan</th>
            <td>Rp.</td>
            <td style="text-align: right;" colspan="2"><?=number_format($akumulasiPenyusutan, 0, ',', '.')?></td>
        </tr>
        <tr>
            <th style="text-align: right;" scope="row">Akumulasi</th>
            <td>Rp.</td>
            <td style="text-align: right;" colspan="2"><?=number_format(($sumAset + $akumulasiPenyusutan), 0, ',', '.')?></td>
        </tr>
    </tbody>
    <thead>
        <tr>
            <th colspan="4"></th>
        </tr>
        <tr>
            <th style="width:50%; text-decoration: underline; text-align: left;">Jumlah Aktiva</th>
            <th style="width:1px; text-align: right;">Rp.</th>
            <th style="text-align: right;" colspan="2"><?=number_format(($sumAktivaLancar + $sumAset + $akumulasiPenyusutan), 0, ',', '.')?></th>
        </tr>
    </thead>
</table>
<hr>
<table width="100%">
    <thead>
        <tr>
            <th style="width:50%; text-decoration: underline;" colspan="4">Kewajiban dan Ekuitas</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="4"></th>
        </tr>
        <tr>
            <th style="width:50%; text-decoration: underline;" colspan="4">Kewajiban Lancar</th>
        </tr>
        <tr>
            <th colspan="4"></th>
        </tr>
        <tr>
            <th scope="row" class="pl-4" style="text-align: left;">Hutang Dagang</th>
            <td>Rp.</td>
            <td colspan="2"><?=number_format($totalUtang, 0, ',', '.')?></td>
        </tr>
        <tr>
            <th scope="row" class="pl-4" style="text-align: left;">Simpanan Pokok</th>
            <td>Rp.</td>
            <td colspan="2"><?=number_format(0, 0, ',', '.')?></td>
        </tr>
        <tr>
            <th scope="row" class="pl-4" style="text-align: left;">Simpanan Wajib</th>
            <td>Rp.</td>
            <td colspan="2"><?=number_format(0, 0, ',', '.')?></td>
        </tr>
        <tr>
            <th scope="row" class="pl-4" style="text-align: left;">Simpanan Sukarela</th>
            <td>Rp.</td>
            <td colspan="2"><?=number_format(0, 0, ',', '.')?></td>
        </tr>
        <tr>
            <th scope="row" class="pl-4" style="text-align: left;">Ziswaf</th>
            <td>Rp.</td>
            <td colspan="2"><?=number_format(0, 0, ',', '.')?></td>
        </tr>
        <tr>
            <th style="text-align: right;" scope="row">Akumulasi</th>
            <td>Rp.</td>
            <td colspan="2"><?=number_format($totalUtang, 0, ',', '.')?></td>
        </tr>

        <tr>
            <th colspan="4"></th>
        </tr>
        <tr>
            <th style="width:50%; text-decoration: underline;" colspan="4">Ekuitas</th>
        </tr>
        <tr>
            <th colspan="4"></th>
        </tr>
        <tr>
            <th scope="row" class="pl-4" style="text-align: left;">Modal Saham</th>
            <td>Rp.</td>
            <td style="text-align: right;" colspan="2"><?=number_format($modalSaham, 0, ',', '.')?></td>
        </tr>
        <tr>
            <th scope="row" class="pl-4" style="text-align: left;">Laba tahun berjalan</th>
            <td>Rp.</td>
            <td style="text-align: right;" colspan="2"><?=number_format($labaBersih, 0, ',', '.')?></td>
        </tr>
        <tr>
            <th style="text-align: right;" scope="row">Akumulasi</th>
            <td>Rp.</td>
            <td style="text-align: right;" colspan="2"><?=number_format($modalSaham+$labaBersih, 0, ',', '.')?></td>
        </tr>
    </tbody>
    <thead>
        <tr>
            <th colspan="4"></th>
        </tr>
        <tr>
            <th style="width:50%; text-decoration: underline; text-align: left;">Total Kewajiban dan Ekuitas</th>
            <th style="width:1px; text-align: right;">Rp.</th>
            <th style="text-align: right;" colspan="2"><?=number_format(($totalUtang + $modalSaham + $labaBersih), 0, ',', '.')?></th>
        </tr>
    </thead>
</table>