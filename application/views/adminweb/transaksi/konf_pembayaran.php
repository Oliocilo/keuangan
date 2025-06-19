<style type="text/css">
	.table {
    width: 100%;
    border-collapse: collapse;
}

.table th, .table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
    word-wrap: break-word; /* Enable word wrapping */
}
</style>
<div class="col-md-12">
	<table class="table">
		<tr>
		<th colspan="3" style="background: #ddd;"> INFORMASI</th>
	</tr>
	<tr>
		<th>Paket Premium</th>
		<th style="width:1px">:</th>
		<td><?=$rtcdata['jumlah_satuan']?> <?=$rtcdata['tipe_satuan']?></td>
	</tr>
	<tr>
		<th>Tanggal Pembelian</th>
		<th style="width:1px">:</th>
		<td><?=$rtcdata['tanggal_daftar']?></td>
	</tr>
	<tr>
		<th>Harga</th>
		<th style="width:1px">:</th>
		<td><?=number_format($rtcdata['harga'])?></td>
	</tr>
	<tr>
		<th>Kode Unik</th>
		<th style="width:1px">:</th>
		<td><?=$rtcdata['kode_unik']?></td>
	</tr>
	<tr>
		<th>Tanggal Bayar</th>
		<th style="width:1px">:</th>
		<td><?=$rtcdata['tanggal_bayar']?></td>
	</tr>
</table>
<div class="row">
	<div class="col-md-6">
<table class="table">
	<tr>
		<th colspan="3" style="background: #ffa8a8;"> TRANSFER DARI</th>
	</tr>
	<tr>
		<th>Nama Bank</th>
		<th style="width:1px">:</th>
		<td><?=$rtcdata['tf_dari_bank']?></td>
	</tr>
	<tr>
		<th>Nama Rekening</th>
		<th style="width:1px">:</th>
		<td><?=$rtcdata['tf_dari_nama']?></td>
	</tr>
	<tr>
		<th>Nominal</th>
		<th style="width:1px">:</th>
		<td><?=number_format($rtcdata['tf_nominal'])?></td>
	</tr>
</table>
</div>
<div class="col-md-6">
	<table class="table">
		<tr>
		<th colspan="3" style="background: #30dda5;"> TRANSFER TUJUAN</th>
	</tr>
	<tr>
		<th>Nama Bank</th>
		<th style="width:1px">:</th>
		<td><?=$rtcdata['metode']?></td>
	</tr>
	<tr>
		<th>Nama Rekening</th>
		<th style="width:1px">:</th>
		<td><?=$rtcdata['nama_rekening']?></td>
	</tr>
	<tr>
		<th>Nomor Rekening</th>
		<th style="width:1px">:</th>
		<td><?=$rtcdata['nomor_rekening']?></td>
	</tr>
</table>
</div>
</div>
	<div class="row">
<div class="col-md-12">
	<table class="table">
	<tr>
		<th style="background:#ddd">Status</th>
		<th style="background:#ddd">Masa Aktif</th>
		<th style="background:#ddd;width:100px">Aksi</th>
	</tr>
	<tr>
		<th>
			<select class="form-control" name="type">
				<option value="Premium">Premium</option>
			</select>
		</th>
		<th>
			<?php 
			$tgl_tempo = date('Y-m-d');
			if($rtcdata['tipe'] == 'Perpanjangan'){
				$this->db->order_by('id','DESC');
				$dataSebelum = $this->rtcmodel->selectDataone('v_riwayat_pembayaran',['id_user'=>$rtcdata['id_user'],'status'=>'Terverifikasi']);
			$tgl_tempo =date('Y-m-d', strtotime($dataSebelum['tanggal_tempo']));
			}
			
			?>

			<input type="date" class="form-control" id="tanggal_exp" value="<?=date('Y-m-d', strtotime($tgl_tempo . ' +'.$rtcdata['durasi'].' month'));?>"> </th>
		<th><button type="button" class="btn btn-secondary btnConfirm" data-url="<?=base_url('adminweb/transaksi_aw/prosesPremium')?>" data-id="<?=$rtcdata['id']?>"> PROSES <i class="fa fa-arrow-right"></i></button> </th>
	</tr>
</table>
</div>
</div>
</div>

