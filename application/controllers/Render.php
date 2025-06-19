<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Render extends RDC_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	//Buku Kas
	public function printBukuKasPdf($idBuku, $bulan, $tahun)
	{
		$data['transaksiBuku'] = $this->rtcmodel->selectWhere('v_buku_transaksi',['id_buku'=>$idBuku, 'MONTH(tanggal)'=>$bulan, 'YEAR(tanggal)'=>$tahun]);
		$bukuDetail = $this->rtcmodel->selectDataOne('v_master_buku',['id_buku'=>$idBuku]);
		$data['page_name'] = $bukuDetail['nama'];
		$data['bukuDetail']  = $bukuDetail;
		$saldoAkhir = $this->getSaldoAkhir($idBuku);
		$data['saldoBuku'] = json_decode($saldoAkhir,true);
		$this->template->print('book/export-pdf',$data);
	}

	public function exportBukuKasPDF($idBuku, $bulan = 0, $tahun = 0)
	{
		$idBuku = $this->template->matDec($idBuku);
		$file = file_get_contents(base_url('render/printBukuKasPdf/'.$idBuku.'/'.$bulan.'/'.$tahun));
		$this->pdf->toPdfPotrait('Laporan Buku Kas',$file);
	}

	public function exportBukuKasExcel($idBuku, $bulan = 0, $tahun = 0)
	{
		$idBuku = $this->template->matDec($idBuku);
		$alldata = $this->rtcmodel->selectWhere('v_buku_transaksi',['id_buku'=>$idBuku, 'MONTH(tanggal)'=>$bulan, 'YEAR(tanggal)'=>$tahun]);
		$header = ['Tipe','Tanggal','Kategori','Pemasukan','Pengeluaran'];
		$isival = [ 'tipe','tanggal','nama_kategori','nominal_masuk','nominal_keluar'];

		$this->mat_ekspor('Laporan Buku Kas',$alldata,$header,$isival);
	}

	//Utang-Piutang
	public function printUtangPiutangPdf($id_user, $type, $bulan, $tahun)
	{
		if(urldecode($bulan) !== "Semua Bulan"){
			$this->db->where('MONTH(tanggal_awal)',$bulan);
		}
		$this->db->where('YEAR(tanggal_awal)',$tahun);
		$alldata = $this->rtcmodel->selectWhere('v_utang',[
			'id_user'=>$id_user, 
			'view'=>null,
			'tipe'=>$type,
		]);
		$data['alldata'] = $alldata;
		$data['tipe'] = $type;
		$data['page_name'] = "Buku ".$type;
		$this->template->print('utangpiutang/export-pdf',$data);
	}

	public function exportUtangPiutangPDF($type, $bulan = 0, $tahun = 0)
	{
		$id_user = $this->session->userdata('idapp'); //gabisa di taro where bjir
		$file = file_get_contents(base_url('render/printUtangPiutangPdf/'.$id_user.'/'.$type.'/'.$bulan.'/'.$tahun));
		$this->pdf->toPdfPotrait('Laporan '.$type,$file);
	}

	public function exportUtangPiutangExcel($type, $bulan = 0, $tahun = 0)
	{
		if(urldecode($bulan) !== "Semua Bulan"){
			$this->db->where('MONTH(tanggal_awal)',$bulan);
		}
		$this->db->where('YEAR(tanggal_awal)',$tahun);
		$alldata = $this->rtcmodel->selectWhere('v_utang',[
			'id_user'=>$this->session->userdata('idapp'), 
			'view'=>null,
			'tipe'=>$type,
		]);
		$header = ['Status','Tanggal','Jatuh Tempo','Klien','Deskripsi','Saldo'];
		$isival = [ 'status','tanggal_awal','tanggal_tempo','klien','deskripsi','saldo'];

		$this->mat_ekspor('Laporan '.$type,$alldata,$header,$isival);
	}

	//ASET
	public function printAsetPdf($id_user)
	{
		$alldata = $this->rtcmodel->selectWhere('v_aset',[
			'id_user'=>$id_user
		]);
		$data['alldata'] = $alldata;
		$data['page_name'] = "Daftar Aset";
		$this->template->print('aset/export-pdf',$data);
	}

	public function exportAsetPDF()
	{
		$id_user = $this->session->userdata('idapp'); //gabisa di taro where bjir
		$file = file_get_contents(base_url('render/printAsetPdf/'.$id_user));
		$this->pdf->toPdfPotrait('Daftar Aset',$file);
	}

	public function exportAsetExcel()
	{
		$alldata = $this->rtcmodel->selectWhere('v_aset',[
			'id_user'=> $this->session->userdata('idapp')
		]);
		$header = ['Kode Aset','Nama Aset','Tanggal Beli','Jenis Penyusutan','Nilai Buku'];
		$isival = [ 'kode_aset','nama_aset','tanggal_pembelian','jenis_penyusutan','nilai_perolehan'];

		$this->mat_ekspor('Daftar Aset',$alldata,$header,$isival);
	}

	//Laporan Kas
	public function exportLaporanKasPDF($tanggal_awal='', $tanggal_akhir='', $buku='')
	{
		$opts = array('http' => array('header'=> 'Cookie: ' . $_SERVER['HTTP_COOKIE']."\r\n"));
		$context = stream_context_create($opts);
		session_write_close(); // unlock the file
		$file = file_get_contents(base_url('laporan/kas/true/true?buku='.$buku.'&tanggal_awal='.$tanggal_awal.'&tanggal_akhir='.$tanggal_akhir), false, $context);
		session_start(); // Lock the file
		$this->pdf->toPdfPotrait('Laporan Buku Kas',$file);
	}

	public function exportLaporanKasExcel($tanggal_awal='', $tanggal_akhir='', $buku='')
	{
		redirect('laporan/kas/true?buku='.$buku.'&tanggal_awal='.$tanggal_awal.'&tanggal_akhir='.$tanggal_akhir);
	}

	//Laporan Neraca
	public function exportLaporanNeracaPDF($bulan='', $tahun='')
	{
		$opts = array('http' => array('header'=> 'Cookie: ' . $_SERVER['HTTP_COOKIE']."\r\n"));
		$context = stream_context_create($opts);
		session_write_close(); // unlock the file
		$file = file_get_contents(base_url('laporan/neraca/true/true?bulan='.$bulan.'&tahun='.$tahun), false, $context);
		session_start(); // Lock the file
		$this->pdf->toPdfPotrait('Laporan Neraca',$file);
	}

	public function exportLaporanNeracaExcel($bulan='', $tahun='')
	{
		redirect('laporan/neraca/true?bulan='.$bulan.'&tahun='.$tahun);
	}

	//Laporan Laba/Rugi
	public function exportLaporanLRPDF($bulan='', $tahun='')
	{
		$opts = array('http' => array('header'=> 'Cookie: ' . $_SERVER['HTTP_COOKIE']."\r\n"));
		$context = stream_context_create($opts);
		session_write_close(); // unlock the file
		$file = file_get_contents(base_url('laporan/laba/0/true/true?bulan='.$bulan.'&tahun='.$tahun), 0, $context);
		session_start(); // Lock the file
		$this->pdf->toPdfPotrait('Laporan Neraca',$file);
	}

	public function exportLaporanLRExcel($bulan='', $tahun='')
	{
		redirect('laporan/laba/0/true?bulan='.$bulan.'&tahun='.$tahun);
	}


	public function exportInvoicePDF($idInv)
	{
		$file = file_get_contents(base_url('alat/einvoice/print/'.$idInv));
		$this->pdf->toPdfPotrait('Invoice',$file);
	}


	

}

/* End of file Render.php */
/* Location: ./application/controllers/Render.php */