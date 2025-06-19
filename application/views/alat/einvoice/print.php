<style type="text/css">
    body{
        background: #fff !important;
    }
</style>
<div class="card">

    <div class="card-block">
        <table class="dataTable">

            <tbody>
                <tr>
                    <td style="width:50%">
                        <div>
                            <img src="<?=base_url('assets/assets/images/logortc.png')?>" class="logoinvoicePrint">
                        </div>
                    </td>
                    <td style="width:50%">
                        <div class="text-right float-right">
                            <div style="background: #01a9ac;color: #fff;padding: 5px;text-align: left;font-weight: bold;font-size: 18px;">
                                INVOICE
                            </div>
                            <table class="smalltablePrint">
                                <tr>
                                    <th class="text-left">Invoice No.</th>
                                    <th style="width:1px">:</th>
                                    <th class="text-left">
                                        <?=$invoice['no_invoice']?>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-left">Tanggal Invoice</th>
                                    <th style="width:1px">:</th>
                                    <th class="text-left">
                                        <?=tgl_indo($invoice['tanggal'])?>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-left">Jatuh Tempo</th>
                                    <th style="width:1px">:</th>
                                    <th class="text-left">
                                        <?=tgl_indo($invoice['tanggal_jatuh_tempo'])?>
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="dataTable p-b-30">
          <tfoot>
            <tr>
                <td style="width:50%">
                    <table class="smalltablePrint" style="width:100%">
                        <tr>
                            <th class="text-left f-18" style="font-size: 18px !important;">
                                <b><?=$invoice['nama_perusahaan']?></b>
                            </th>
                        </tr>
                        <?php
                        $alamatPerusahaan = json_decode($invoice['alamat_perusahaan'],true);
                        ?>
                        <tr>
                            <td class="text-left" style="line-height: 0.7;"> <?=$alamatPerusahaan['alamat'][1]?></td>
                        </tr>
                        <tr>
                            <td class="text-left" style="line-height: 0.7;"> <?=$alamatPerusahaan['alamat'][2]?></td>
                        </tr>
                        <tr>
                            <td class="text-left" style="line-height: 0.7;"> <?=$alamatPerusahaan['alamat'][3]?></td>
                        </tr>
                    </table>
                </td>
                <td style="width:50%">
                </td>
            </tr>
        </tfoot>
    </table>
    <table class="table-hover dataTable p-b-20 custom-tablePrint">
        <thead>
            <tr>
                <th class="text-left" style="width:40%;">Ditagih kepada</th>
                <th class="text-left" style="width:20%;"></th>
                <th class="text-left" style="width:40%;"><?= $invoice['is_dikirim'] == 1 ? "Dikirim kepada" : "" ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="">
                 <?php
                 $alamatPelanggan = json_decode($invoice['alamat_pelanggan'],true);
                 ?>
                 <table class="dataTable smalltablePrint" style="width:100%">
                    <tbody>
                        <tr>
                            <td class="text-left f-16" style="font-size: 16px !important;"> <b><?=$invoice['nama_pelanggan']?></b></td>
                        </tr>
                        <tr>
                            <td class="text-left f-11" style="line-height: 0.7;"><?=$alamatPelanggan['alamat'][1]?> </td>
                        </tr>
                        <tr> 
                            <td class="text-left f-11" style="line-height: 0.7;"><?=$alamatPelanggan['alamat'][2]?> </td>
                        </tr>
                        <tr>
                            <td class="text-left f-11" style="line-height: 0.7;"><?=$alamatPelanggan['alamat'][3]?></td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td></td>
            <td>
                <?php
                $alamatpenerima = json_decode($invoice['alamat_penerima'],true);
                ?>
                <table class="dataTable smalltablePrint" style="width:100%">
                    <tbody>
                        <tr>
                            <td class="text-left f-16" style="font-size: 16px !important;"> <b><?=$invoice['nama_penerima']?></b></td>
                        </tr>
                        <tr>
                            <td class="text-left f-11" style="line-height: 0.7;"><?=$alamatpenerima['alamat'][1]?> </td>
                        </tr>
                        <tr> 
                            <td class="text-left f-11" style="line-height: 0.7;"><?=$alamatpenerima['alamat'][2]?> </td>
                        </tr>
                        <tr>
                            <td class="text-left f-11" style="line-height: 0.7;"><?=$alamatpenerima['alamat'][3]?></td>
                        </tr>
                    </tbody>
                </table>
            </td>

        </tr>
    </tbody>
</table>


<table class="custom-table2 table-hover table-bordered thead-center dataTable" style="width:100%;font-size: 12px !important;">
    <thead>
        <tr>
            <th style="width:10%">ID</th>
            <th style="width:40%">Deskripsi</th>
            <th style="width:10%">Jumlah</th>
            <th style="width:20%">Harga Satuan</th>
            <th style="width:20%">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($invoiceItem as $key => $item) { ?>
         <tr>
            <td class="text-center"><?=$item['no']?></td>
            <td class="text-left"><?=$item['desc']?></td>
            <td class="text-center"><?=$item['qty']?></td>
            <td class="text-right">Rp. <?=number_format($item['harga'])?></td>
            <td class="text-right">Rp. <?=number_format($item['total'])?></td>
        </tr>
    <?php } ?>
</tbody>
<tfoot>
    <tr>
     <td class="text-center vCenter" colspan="3"></td>
     <td class="text-right vCenter font-weight-bold">Sub Total</td>
     <td class="text-right vCenter font-weight-bold">Rp. <?=number_format($invoice['subtotal'])?></td>
 </tr>
 <?php if($invoice['is_sudahbayar'] == 1){ ?>
   <tr>
     <td class="text-center vCenter" colspan="3"></td>
     <td class="text-right vCenter">Sudah Dibayar (-)</td>
     <td class="text-right">Rp. <?=number_format($invoice['sudahbayar'])?></td>
 </tr>
<?php } ?>
<?php if($invoice['is_diskon'] == 1){ ?>
   <tr>

       <td class="text-center vCenter" colspan="3"></td>
       <td class="text-right vCenter">Diskon (-)</td>
       <td class="text-right">Rp. <?=number_format($invoice['diskon'])?></td>
   </tr>
<?php } ?>
<?php if($invoice['is_pajak'] == 1){ ?>
   <tr>

       <td class="text-center vCenter" colspan="3"></td>
       <td class="text-right vCenter">Pajak (+)</td>
       <td class="text-right">Rp. <?=number_format($invoice['pajak'])?></td>
   </tr>
<?php } ?>
<?php if($invoice['is_ongkir'] == 1){ ?>
   <tr>

       <td class="text-center vCenter" colspan="3"></td>
       <td class="text-right vCenter">Biaya Pengiriman (+)</td>
       <td class="text-right">Rp. <?=number_format($invoice['ongkir'])?></td>
   </tr>
<?php } ?>
<tr style="background:#ddd">

   <td class="text-center vCenter" colspan="3"></td>
   <td class="text-right vCenter font-weight-bold">TOTAL</td>
   <td class="text-right font-weight-bold">Rp. <?=number_format($invoice['total'])?></td>
</tr>
</tfoot>
</table>

<div style="position: relative;">
    <?php
    $stemp = json_decode($invoice['stempel'],true);
    ?>
    <?php if(in_array('stampLunas', $stemp)){ ?>
        <img src="<?=base_url('assets/images/stamp/')?>stamp_lunas.png" width="130" height="100" class="stampImg stampLunasPrint">
    <?php } ?>
    <?php if(in_array('stampSegera', $stemp)){ ?>
        <img src="<?=base_url('assets/images/stamp/')?>stamp_segera.png" width="130" height="100" class=" stampImg stampSegeraPrint">
    <?php } ?>
    <?php if(in_array('stampJatuhTempo', $stemp)){ ?>
        <img src="<?=base_url('assets/images/stamp/')?>stamp_jatuh_tempo.png" width="130" height="100" class=" stampImg stampJatuhTempoPrint">
    <?php } ?>
    <?php if(in_array('stampFinal', $stemp)){ ?>
        <img src="<?=base_url('assets/images/stamp/')?>stamp_final.png" width="130" height="100" class=" stampImg stampFinalPrint">
    <?php } ?>
    <?php if(in_array('stampDikirim', $stemp)){ ?>
        <img src="<?=base_url('assets/images/stamp/')?>stamp_dikirim.png" width="130" height="100" class=" stampImg stampDikirimPrint">
    <?php } ?>
    <?php if(in_array('stampDisetujui', $stemp)){ ?>
        <img src="<?=base_url('assets/images/stamp/')?>stamp_disetujui.png" width="130" height="100" class=" stampImg stampDisetujuiPrint">
    <?php } ?>
</div>

<table class="table-hover dataTable p-t-20 custom-tablePrint">
    <thead>
        <tr>
            <th class="text-left" style="width:40%;">Catatan</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?=$invoice['catatan']?></td>
        </tr>
    </tbody>
</table>

</div>
</div>


