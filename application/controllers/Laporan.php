<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends RDC_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function kas($cetak = false, $pdf = false)
	{
		$buku = "";
		if($cetak){
			$buku = isset($_GET['buku']) && $_GET['buku'] != '' ? " ".$this->template->matDec($_GET['buku']) : " Semua Buku";
			$tanggal_awal = isset($_GET['tanggal_awal'])  && $_GET['tanggal_awal'] != '' ? date('d F Y',strtotime($_GET['tanggal_awal'])) : date('01 F Y');
			$tanggal_akhir = isset($_GET['tanggal_akhir']) && $_GET['tanggal_akhir'] != '' ? date('d F Y',strtotime($_GET['tanggal_akhir'])) : date('t F Y');
			$data['page_description'] = $tanggal_awal." - ".$tanggal_akhir;
		}
		if($cetak && !$pdf){
			//date_default_timezone_set("Asia/Bangkok");
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=Laporan Kas.xls");
			header("Cache-Control: no-cache, must-revalidate");
			header("Pragma: no-cache");
		}
		$data['page_name'] = 'Laporan Kas'.$buku;
		$data['page_active'] = 'laporan';
		$data['page_sub_active'] = 'laporankas';
		$data['dataload'] = 'laporan.js';
		$data['namaBulan'] = $this->template->namaBulanIndo();
		$data['rekapKas'] = $this->getRekapTransfer();
		$data['rekapKategori'] = $this->getRekapKategori();
		$data['rekapKasUmum'] = $this->getRekapKasUmum();
		if($cetak && !$pdf) $this->template->print('laporan/kas_excel',$data);
		else if($cetak && $pdf) $this->template->print('laporan/kas_pdf',$data);
		else $this->template->view('laporan/kas',$data);
	}

	public function getRekapKasUmum()
	{
		$buku = isset($_GET['buku']) && $_GET['buku'] != '' ? $this->template->matDec($_GET['buku']) : 0;
		$tanggal_awal = isset($_GET['tanggal_awal'])  && $_GET['tanggal_awal'] != '' ? date('Y-m-d',strtotime($_GET['tanggal_awal'])) : date('Y-m-01');
		$tanggal_akhir = isset($_GET['tanggal_akhir']) && $_GET['tanggal_akhir'] != '' ? date('Y-m-d',strtotime($_GET['tanggal_akhir'])) : date('Y-m-t');
		
		$this->db->select('tanggal,SUM(nominal_masuk_asli) as total_masuk, SUM(nominal_keluar_asli) as total_keluar,(SUM(nominal_masuk_asli) - SUM(nominal_keluar_asli)) as diff_total');
		$this->db->where('tipe !=','Transfer');
		if($buku != 0){
			$this->db->where('id_buku',$buku);
		}
		if($tanggal_awal != 0) $this->db->where('tanggal >=',$tanggal_awal);
		if($tanggal_akhir != 0) $this->db->where('tanggal <=',$tanggal_akhir);
		$this->db->order_by('tanggal','ASC');
		$dataRekap['transaksi'] =  $this->rtcmodel->selectWhere('v_buku_transaksi', ['id_user'=>$this->session->userdata('idapp')]);

		$this->db->select('tanggal,SUM(nominal_masuk_asli) as total_masuk, SUM(nominal_keluar_asli) as total_keluar,(SUM(nominal_masuk_asli) - SUM(nominal_keluar_asli)) as diff_total');
		$this->db->where('tipe','Transfer');
		if($buku != 0){
			$this->db->where('id_buku',$buku);
		}
		if($tanggal_awal != 0) $this->db->where('tanggal >=',$tanggal_awal);
		if($tanggal_akhir != 0) $this->db->where('tanggal <=',$tanggal_akhir);
		$this->db->order_by('tanggal','ASC');
		$dataRekap['transfer'] =  $this->rtcmodel->selectWhere('v_buku_transaksi', ['id_user'=>$this->session->userdata('idapp')]);

		$this->db->select('SUM(nominal_ori) as saldo_akhir');
		if($buku != 0){
			$this->db->where('id_buku',$buku);
		}
		if($tanggal_awal != 0) $this->db->where('tanggal >=',$tanggal_awal);
		if($tanggal_akhir != 0) $this->db->where('tanggal <=',$tanggal_akhir);
		$dataRekap['saldo'] =  $this->rtcmodel->selectWhere('v_buku_transaksi_rekap',['id_user'=>$this->session->userdata('idapp')]);

		$dataRekap['saldo_awal']  = $this->getSaldoPeriode($buku, 'Awal', $tanggal_awal, $tanggal_akhir);
		$dataRekap['saldo_akhir']  = $this->getSaldoPeriode($buku, 'Akhir', $tanggal_awal, $tanggal_akhir);

		return $dataRekap;
	}

	public function getRekapTransfer()
	{
		$buku = isset($_GET['buku'])  && $_GET['buku'] != '' ? $this->template->matDec($_GET['buku']) : 0;
		$tanggal_awal = isset($_GET['tanggal_awal'])  && $_GET['tanggal_awal'] != '' ? date('Y-m-d',strtotime($_GET['tanggal_awal'])) : date('Y-m-01');
		$tanggal_akhir = isset($_GET['tanggal_akhir']) && $_GET['tanggal_akhir'] != '' ? date('Y-m-d',strtotime($_GET['tanggal_akhir'])) : date('Y-m-t');
		
		$this->db->select('id_buku,tipe,nama,nominal,tipe_asli_modified');
		if($buku != 0) $this->db->where('id_buku',$buku);
		if($tanggal_awal != 0) $this->db->where('tanggal >=',$tanggal_awal);
		if($tanggal_akhir != 0) $this->db->where('tanggal <=',$tanggal_akhir);
		$dataRekapTransfer = $this->rtcmodel->selectWhere('v_rekap_transfer_per_buku_kas',['id_user'=>$this->session->userdata('idapp')]);

		$result = [];
		foreach ($dataRekapTransfer as $key => $val) {
			$namaBuku = $val['nama'];
			$tipeAsliModified = $val['tipe_asli_modified'];
			$nominal = $val['nominal'];
			if (!isset($result[$namaBuku])) {
				$result[$namaBuku] = [
					'namaBuku' => $namaBuku,
					'tf_masuk' => 0,
					'tf_keluar' => 0,
				];
			}
			if ($tipeAsliModified == 'Transfer Masuk') {
				$result[$namaBuku]['tf_masuk'] += $nominal;
			} elseif ($tipeAsliModified == 'Transfer Keluar') {
				$result[$namaBuku]['tf_keluar'] += $nominal;
			}
		}
		$finalResult['buku'] = array_values($result);

		if($buku != 0) $this->db->where('id_buku',$buku);
		$this->db->order_by('tanggal','ASC');
		$finalResult['detail'] = $this->rtcmodel->selectWhere('v_buku_transaksi', ['id_user'=>$this->session->userdata('idapp'), 'tipe'=>'Transfer']);
		$result2 = [];
		foreach ($finalResult['detail'] as $key => $val) {
			$tanggal = $val['tanggal'] == "0000-00-00 00:00:00" ? $val['created_at'] : $val['tanggal'];
			$bgTipe = $val['tipe_asli'] == "Pemasukan" ? 'style="background:#0ac282"' : 'style="background:#fe5d70"';
			$result2[$val['nama_buku']][$key] = [
				'tanggal' => date_format(date_create($tanggal), 'd M Y, H:i'),
				'deskripsi' => $val['nama_kategori'],
				'nominal' => $val['nominal_ori'],
				'bgTipe' => $bgTipe,
			];
		}
		$finalResult['detail'] = $result2;

		return $finalResult;
		
	}

	public function chartRekapTransfer(){
		$rekapTransfer = $this->getRekapTransfer();
		$data = [
			'labels' => [],
			'datasets' => [
				[
					'label' => 'Transfer Masuk',
					'backgroundColor' => [],
					'data' => []
				],
				[
					'label' => 'Transfer Keluar',
					'backgroundColor' => [],
					'data' => []
				]
			]
		];

		foreach ($rekapTransfer['buku'] as $key => $rKas) {
			$data['labels'][$key] = $rKas['namaBuku'];
			$data['datasets'][0]['data'][$key] = $rKas['tf_masuk'];
			$data['datasets'][0]['backgroundColor'][$key] = '#01c0c8';
			$data['datasets'][1]['data'][$key] = $rKas['tf_keluar'];
			$data['datasets'][1]['backgroundColor'][$key] = '#fe909d';
		}

		echo json_encode($data);
	}

	public function getRekapKategori($tipe = "", $id_kategori=0, $bulan_filter=0, $tahun_filter=0)
	{
		$buku = isset($_GET['buku'])  && $_GET['buku'] != '' ? $this->template->matDec($_GET['buku']) : 0;
		$tanggal_awal = isset($_GET['tanggal_awal'])  && $_GET['tanggal_awal'] != '' ? date('Y-m-d',strtotime($_GET['tanggal_awal'])) : date('Y-m-01');
		$tanggal_akhir = isset($_GET['tanggal_akhir']) && $_GET['tanggal_akhir'] != '' ? date('Y-m-d',strtotime($_GET['tanggal_akhir'])) : date('Y-m-t');
		
		$this->db->select('nama_kategori, SUM(nominal_masuk_asli) as total_masuk, SUM(nominal_keluar_asli) as total_keluar');
		if($tipe === "") $this->db->where('tipe !=','Transfer');
		else $this->db->where('tipe', $tipe);

		if($buku != 0) $this->db->where('id_buku',$buku);
		if($tanggal_awal != 0) $this->db->where('tanggal >=',$tanggal_awal);
		if($tanggal_akhir != 0) $this->db->where('tanggal <=',$tanggal_akhir);
		if($id_kategori!=0) $this->db->where('id_kategori',$id_kategori);
		if($bulan_filter!=0) $this->db->where('MONTH(tanggal)',$bulan_filter);
		if($tahun_filter!=0) $this->db->where('YEAR(tanggal)',$tahun_filter);

		$this->db->group_by('nama_kategori');
		$dataRekap['kategori'] =  $this->rtcmodel->selectWhere('v_buku_transaksi',['id_user'=>$this->session->userdata('idapp')]);
		

		$this->db->select('tipe, nama_kategori, tanggal, nama_buku, deskripsi, nominal_masuk_asli, nominal_keluar_asli, created_at');
		if($tipe === "") $this->db->where('tipe !=','Transfer');
		else $this->db->where('tipe', $tipe);

		if($buku != 0) $this->db->where('id_buku',$buku);
		if($tanggal_awal != 0) $this->db->where('tanggal >=',$tanggal_awal);
		if($tanggal_akhir != 0) $this->db->where('tanggal <=',$tanggal_akhir);
		if($id_kategori!=0) $this->db->where('id_kategori',$id_kategori);
		if($bulan_filter!=0) $this->db->where('MONTH(tanggal)',$bulan_filter);
		if($tahun_filter!=0) $this->db->where('YEAR(tanggal)',$tahun_filter);

		$this->db->order_by('tanggal','ASC');
		$dataRekap['detail'] =  $this->rtcmodel->selectWhere('v_buku_transaksi',['id_user'=>$this->session->userdata('idapp')]);

		$result = [];
		foreach ($dataRekap['detail'] as $key => $val) {
			$tanggal = $val['tanggal'] == "0000-00-00 00:00:00" ? $val['created_at'] : $val['tanggal'];
			$nominal = $val['tipe'] == "Pemasukan" ? $val['nominal_masuk_asli'] : $val['nominal_keluar_asli'];
			$bgTipe = $val['tipe'] == "Pemasukan" ? 'style="background:#0ac282"' : 'style="background:#fe5d70"';
			$result[$val['nama_kategori']][$key] = [
				'tanggal' => date_format(date_create($tanggal), 'd M Y, H:i'),
				'nama_buku' => $val['nama_buku'],
				'deskripsi' => $val['deskripsi'],
				'nominal' => $nominal,
				'bgTipe' => $bgTipe,
			];
		}
		$dataRekap['detail'] = $result;
		
		return $dataRekap;
	}

	public function getPenyusutan($tipe = "", $bulan_filter, $tahun_filter)
	{
		if($bulan_filter==0) $bulan_filter = 12;
		$bebanPenyusutan = 0;
		$akumulasiPenyusutan = 0;
		foreach($this->getDataAset($bulan_filter, $tahun_filter) as $key => $aset){
			$tanggal_aset = date_format(date_create($aset['tanggal_pembelian']), 'Y-m-d');
			$tanggal_filter = date_format(date_create($tahun_filter."-".$bulan_filter."-1"), 'Y-m-d');
			
			$d1=new DateTime($aset['tanggal_pembelian']); 
			$d2=new DateTime($tahun_filter."-".$bulan_filter."-1");                                  
			$Months = $d2->diff($d1); 
			$masa = (($Months->y) * 12) + ($Months->m);

			if($tanggal_filter >= $tanggal_aset){
				$bebanPenyusutan += $this->getAsetBulanan($aset['id_aset'], $masa, 'beban');
				$akumulasiPenyusutan += $this->getAsetBulanan($aset['id_aset'], $masa, $masa==0?'beban':'akumulasi');
			}
		}
		if($tipe == 'beban') return $bebanPenyusutan;
		else if($tipe == 'akumulasi') return $akumulasiPenyusutan;
		else return 0;
	}

	public function getDataAset($bulan_filter=0, $tahun_filter=0)
	{
		if($bulan_filter==0) $bulan_filter = 12;
		$tanggal_filter = date_format(date_create($tahun_filter."-".$bulan_filter."-1"), 'Y-m-d');
		$this->db->select('id_aset, tanggal_pembelian, penyusutan_bulan_ke, nama_kategori, SUM(nilai_satuan) as total');
		$this->db->where('id_user', $this->session->userdata('idapp'));
		$this->db->where('tanggal_pembelian <=',$tanggal_filter);
		$this->db->group_by('nama_kategori');
		$dataAset =  $this->rtcmodel->selectWhere('v_aset',['id_user'=>$this->session->userdata('idapp')]);
		return $dataAset;
	}

	public function chartData($tipe, $tanggal_awal, $tanggal_akhir, $buku = "")
	{
		$this->db->select('nama_kategori, SUM(nominal_masuk_asli) as total_masuk, SUM(nominal_keluar_asli) as total_keluar');
		$this->db->where('tipe',$tipe);
		if($buku != "") $this->db->where('id_buku',$this->template->matDec($buku));
		if($tanggal_awal != 0) $this->db->where('tanggal >=',$tanggal_awal);
		if($tanggal_akhir != 0) $this->db->where('tanggal <=',$tanggal_akhir);
		$this->db->group_by('nama_kategori');
		$dataChart = $this->rtcmodel->selectWhere('v_buku_transaksi',['id_user'=>$this->session->userdata('idapp')]);
		foreach ($dataChart as $key => $val) {
			$data['label'][$key] = $val['nama_kategori']; 
			if($tipe == 'Pemasukan'){
				$data['val'][$key] = $val['total_masuk']; 
			}else{
				$data['val'][$key] = $val['total_keluar']; 
			}
			$data['color'][$key] = '#'.$this->random_color(); 
		}
		echo json_encode($data);
		
	}

	function random_color_part() {
		return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
	}

	function random_color() {
		return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
	}

	function neraca($cetak = false, $pdf = false)
	{
		if($cetak && !$pdf){
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=Laporan Neraca.xls");
			header("Cache-Control: no-cache, must-revalidate");
			header("Pragma: no-cache");
		}
		$bulan_filter = $this->input->get('bulan');
		$bulan_filter = isset($bulan_filter) ? $bulan_filter : date('m');
		$bulan_filter = $bulan_filter == "Semua Bulan" ? 0 : $bulan_filter;
		$tahun_filter = $this->input->get('tahun');
		$tahun_filter = isset($tahun_filter) ? $tahun_filter : date('Y');
		$totalPiutang = $this->getTotalUtangPiutang('Piutang', $bulan_filter, $tahun_filter);
		$totalUtang = $this->getTotalUtangPiutang('Utang', $bulan_filter, $tahun_filter);
		$data['page_name'] = 'Laporan Neraca';
		$data['page_active'] = 'laporan';
		$data['page_sub_active'] = 'laporanneraca';
		$data['page_description'] = "Periode ".date_format(date_create($tahun_filter."-".$bulan_filter."-1"), 'F Y');
		$data['dataload'] = 'laporan.js';
		$data['seluruhKas']  = $this->getSaldoPeriode(0, 'Akhir', $bulan_filter, $tahun_filter);
		$data['totalPiutang'] = $totalPiutang;
		$data['persediaanBarang'] = $this->getRekapKategori("Pengeluaran",2, $bulan_filter, $tahun_filter)['kategori'];
		$data['persediaanBarang'] = empty($data['persediaanBarang']) ? 0 : $data['persediaanBarang'][0]['total_keluar'];
		$data['sumAktivaLancar'] = $data['seluruhKas'] + $totalPiutang + $data['persediaanBarang'];
		$data['akumulasiPenyusutan'] = $this->getPenyusutan('akumulasi', $bulan_filter, $tahun_filter);
		$data['totalAset'] = $this->getDataAset($bulan_filter, $tahun_filter);
		$data['totalUtang'] = $totalUtang;
		$idbuku = $this->rtcmodel->selectDataone('rtc_buku',['id_user'=>$this->session->userdata('idapp'), 'is_default'=>1])['id_buku'];
		$data['modalSaham']  = $this->getSaldoPeriode(0, 'Awal', $bulan_filter, $tahun_filter);
		$data['labaBersih'] = $this->laba(true);
		$data['namaBulan'] = $this->template->namaBulanIndo();

		if($cetak && !$pdf) $this->template->print('laporan/neraca_excel',$data);
		else if($cetak && $pdf) $this->template->print('laporan/neraca_pdf',$data);
		else $this->template->view('laporan/neraca',$data);
			
	}

	function laba($getLabaBersih = false, $cetak = false, $pdf = false) {
		if($cetak && !$pdf){
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=Laporan Laba Rugi.xls");
			header("Cache-Control: no-cache, must-revalidate");
			header("Pragma: no-cache");
		}
		$bulan_filter = $this->input->get('bulan');
		$bulan_filter = isset($bulan_filter) ? $bulan_filter : date('m');
		$bulan_filter = $bulan_filter == "Semua Bulan" ? 0 : $bulan_filter;
		$tahun_filter = $this->input->get('tahun');
		$tahun_filter = isset($tahun_filter) ? $tahun_filter : date('Y');
		$data['page_name'] = 'Laporan Laba/Rugi';
		$data['page_active'] = 'laporan';
		$data['page_sub_active'] = 'laporanlabarugi';
		$data['page_description'] = "Periode ".date_format(date_create($tahun_filter."-".$bulan_filter."-1"), 'F Y');
		$data['dataload'] = 'laporan.js';
		$data['penjualanBarang'] = $this->getRekapKategori("Pemasukan", 1, $bulan_filter, $tahun_filter)['kategori'];
		$data['penjualanBarang'] = empty($data['penjualanBarang']) ? 0 : $data['penjualanBarang'][0]['total_masuk'];
		$data['bebanPenyusutan'] = $this->getPenyusutan('beban', $bulan_filter, $tahun_filter);
		$data['totalAset'] = $this->getDataAset($bulan_filter, $tahun_filter);
		$idbuku = $this->rtcmodel->selectDataone('rtc_buku',['id_user'=>$this->session->userdata('idapp'), 'is_default'=>1])['id_buku'];
		$data['saldoAwal']  = $this->getSaldoPeriode(0, 'Awal', $bulan_filter, $tahun_filter);
		$data['pembelianBarang'] = $this->getRekapKategori("Pengeluaran",2, $bulan_filter, $tahun_filter)['kategori'];
		$data['pembelianBarang'] = empty($data['pembelianBarang']) ? 0 : $data['pembelianBarang'][0]['total_keluar'];
		$data['saldoAkhir']  = $data['saldoAwal'] - $data['pembelianBarang'];
		$data['totalHPP']  = ($data['saldoAwal'] + $data['pembelianBarang']) - $data['saldoAkhir'];
		$data['namaBulan'] = $this->template->namaBulanIndo();
		$data['pemasukan'] = $this->getRekapKategori("Pemasukan", 0, $bulan_filter, $tahun_filter)['kategori'];
		$totalMasuk = 0;
		foreach($data['pemasukan'] as $masuk){
			$totalMasuk += $masuk['total_masuk'];
		}
		$data['totalMasuk'] = $totalMasuk;
		$data['labaKotor'] = $totalMasuk - $data['totalHPP'];
		$data['pengeluaran'] = $this->getRekapKategori("Pengeluaran", 0, $bulan_filter, $tahun_filter)['kategori'];
		$totalKeluar = 0;
		foreach($data['pengeluaran'] as $keluar){
			$totalKeluar += $keluar['total_keluar'];
		}
		$data['totalKeluar'] = $totalKeluar;
		$data['labaBersih'] = $data['labaKotor'] - ($totalKeluar + $data['bebanPenyusutan']);
		if($getLabaBersih) return $data['labaBersih'];
		else {
			if($cetak && !$pdf) $this->template->print('laporan/labaRugi_excel',$data);
			else if($cetak && $pdf) $this->template->print('laporan/labaRugi_pdf',$data);
			else $this->template->view('laporan/labaRugi',$data);
		}
		
	}

}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */