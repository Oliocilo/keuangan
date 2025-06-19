<style>
    body { background-color: transparent !important; }
    @page { size: auto; size: A4 portrait; font-family: "Times New Roman", Times, serif !important; }
</style>
<page>
    <table width="100%">
        <tr>
            <th colspan="6" class="text-center"><h2><?=$page_name?></h2></th>
        </tr>
        <tr>
            <th colspan="6" class="text-center"><h3><?=$page_description?></h3></th>
        </tr>
    </table>
    <hr>
    <table class="table table-condensed neracatable">
        <thead>
            <tr>
                <th style="width:50%; text-decoration: underline;" colspan="6">Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th colspan="6"></th>
            </tr>
            <tr>
                <?php if(empty($pemasukan)) { ?>
                <th style="width:50%; text-decoration: underline;" colspan="4">Total Pemasukan</th>
                <td style="width:1px; text-align: right">Rp.</td>
                <td class="text-right">0</td>
                <?php } else { ?>
                <th style="width:50%; text-decoration: underline;" colspan="6">Total Pemasukan</th>
                <?php } ?>
            </tr>
            <?php
                foreach($pemasukan as $masuk){
            ?>
            <tr>
                <th scope="row" class="pl-4" colspan="4"><?=$masuk['nama_kategori']?></th>
                <td>Rp.</td>
                <td class="DDD" ><?=number_format($masuk['total_masuk'], 0, ',', '.')?></td>
            </tr>
            <?php
                }
            ?>
            <tr>
                <th class="text-right" scope="row" colspan="4">Akumulasi</th>
                <td>Rp.</td>
                <td class="DDD" ><?=number_format($totalMasuk, 0, ',', '.')?></td>
            </tr>
            <tr>
                <th colspan="6"></th>
            </tr>
            <tr>
                <th style="width:50%; text-decoration: underline;" colspan="6">Harga Pokok Penjualan (HPP)</th>
            </tr>
            <tr>
                <th scope="row" class="pl-4" colspan="4">Pembelian Barang Dagang</th>
                <td>Rp.</td>
                <td class="DDD" ><?=number_format($pembelianBarang, 0, ',', '.')?></td>
            </tr>
            <tr>
                <th class="text-right" scope="row" colspan="4">Total HPP</th>
                <td>Rp.</td>
                <td class="DDD" ><?=number_format($pembelianBarang, 0, ',', '.')?></td>
            </tr>
            <thead>
                <tr>
                    <th colspan="6"></th>
                </tr>
                <tr>
                    <th style="width:50%; text-decoration: underline;" colspan="4">Laba Kotor</th>
                    <th style="width:1px; text-align: right">Rp.</th>
                    <th class="DDD" ><?=number_format($labaKotor, 0, ',', '.')?></th>
                </tr>
            </thead>
    </table>
    <hr>
    <table class="table table-condensed neracatable">
        <thead>
            <tr>
                <th style="width:50%; text-decoration: underline;" colspan="6">Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th colspan="6"></th>
            </tr>
            <tr>
                <?php if(empty($pengeluaran)) { ?>
                <th style="width:50%; text-decoration: underline;" colspan="4">Total Pengeluaran</th>
                <td style="width:1px; text-align: right">Rp.</td>
                <td class="text-right" >0</td>
                <?php } else { ?>
                <th style="width:50%; text-decoration: underline;" colspan="6">Total Pengeluaran</th>
                <?php } ?>
            </tr>
            <?php
                foreach($pengeluaran as $keluar){
            ?>
            <tr>
                <th scope="row" class="pl-4" colspan="4"><?=$keluar['nama_kategori']?></th>
                <td>Rp.</td>
                <td class="DDD" ><?=number_format($keluar['total_keluar'], 0, ',', '.')?></td>
            </tr>
            <?php
                }
            ?>
            <tr>
                <th class="text-right" scope="row" colspan="4">Akumulasi</th>
                <td>Rp.</td>
                <td class="DDD" ><?=number_format($totalKeluar, 0, ',', '.')?></td>
            </tr>
            <tr>
                <th colspan="6"></th>
            </tr>
            <tr>
                <th style="width:50%; text-decoration: underline;" colspan="4">Beban Penyusutan</th>
                <td>Rp.</td>
                <td class="DDD" ><?=number_format($bebanPenyusutan, 0, ',', '.')?></td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th colspan="6"></th>
            </tr>
            <tr>
                <th style="width:50%; text-decoration: underline;" colspan="4">Laba Bersih</th>
                <th style="width:1px; text-align: right">Rp.</th>
                <th class="text-right" ><?=number_format($labaBersih, 0, ',', '.')?></th>
            </tr>
        </thead>
    </table>
</page>