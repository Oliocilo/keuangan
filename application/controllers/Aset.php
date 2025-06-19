<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aset extends RDC_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['page_name'] = 'Data Aset';
		$data['page_active'] = 'aset';
		$data['page_sub_active'] = 'daftaraset';
		$data['dataload'] = 'aset.js';
		$this->template->view('aset/index',$data);
	}

	public function jsonData()
	{
		$aksesSP019 = 0;
		if($this->template->checkAccessed('SP019') == 1){
			$aksesSP019 = 1;
		}
		header('Content-Type: application/json');
		$this->datatables->select('id_aset,kode_aset,nama_aset,tanggal_pembelian,masa_manfaat,tarif_penyusutan,nilai_satuan,qty,nama_kategori,metode_penyusutan,nilai_perolehan');
		$this->datatables->where('id_user',$this->session->userdata('idapp'));
		$this->datatables->from('v_aset');
		if($aksesSP019 == 1){
			$this->datatables->add_column('view', '
			<button data-toggle="tooltip" data-placement="top" title="Detail Aset" id="detailAset" data-id="$1" class="btn btn-info btn-xs detail">
				<i class="fa fa-info-circle"></i>
			</button>
			<button data-toggle="tooltip" data-placement="top" title="Edit" data-id="$1" class="btn btn-secondary btn-xs edit">
				<i class="fa fa-edit"></i>
			</button>
			<button class="btn btn-danger btn-xs btndelete" data-id="$1" data-url="'.base_url('aset/delete').'">
				<i class="fa fa-trash"></i>
			</button>', 'id_aset');
		}else{
			$this->datatables->add_column('view', 'F');
		}
		echo $this->datatables->generate();
	}

	public function add()
	{
		$data['page_name'] = 'Data Aset';
		$data['page_active'] = 'aset';
		$data['page_sub_active'] = 'daftaraset';
		$data['dataloadmodal'] = 'aset.js';
		$data['kategori'] = $this->rtcmodel->selectWhere('rtc_aset_kategori',['id_user'=>$this->session->userdata('idapp')]);
		$data['metode'] = $this->rtcmodel->selectData('rtc_aset_metode');
		$this->load->view('aset/add',$data);
	}
	
	function validate(){
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('metode', '<strong> Tarif Penyusutan / Nilai Residu </strong>', 'callback_validateMetode[metode]');
		$this->form_validation->set_rules('kategori', '<strong>Kategori</strong>', 'required');
		$this->form_validation->set_rules('tanggal', '<strong>Tanggal Perolehan</strong>', 'required');
		$this->form_validation->set_rules('kode_aset', '<strong>Kode Aset</strong>', 'required');
		$this->form_validation->set_rules('nama_aset', '<strong>Nama Aset</strong>', 'required');
		$this->form_validation->set_rules('harga_beli', '<strong>Harga Beli</strong>', 'required');
		$this->form_validation->set_rules('masa_manfaat', '<strong>Masa Manfaat</strong>', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$result = returnValidate('error','Aset gagal dibuat', validation_errors());
			echo $result;
			return false;
		}else{
			return true;
		}
	}
	
	function validateMetode($metode){
		if($metode == "garis_lurus"){
			if($this->input->post('tarif_penyusutan') == "" && (!$this->input->post('nilai_residu') == 0 && !$this->input->post('check_nilai_residu'))){
				$this->form_validation->set_message('validateMetode', 'Bagian <strong>{field}</strong> wajib diisi.');
				return false;
			} else if($this->input->post('tarif_penyusutan') == ""){
				$this->form_validation->set_message('validateMetode', 'Bagian <strong>Tarif Penyusutan</strong> wajib diisi.');
				return false;
			} else if($this->input->post('nilai_residu') == 0 && !$this->input->post('check_nilai_residu')){
				$this->form_validation->set_message('validateMetode', 'Bagian <strong>Nilai Residu</strong> wajib diisi.');
				return false;
			} else return true;
		} else if($metode == ""){
			$this->form_validation->set_message('validateMetode', 'Bagian <strong>Metode</strong> wajib diisi.');
			return false;
		}else return true;
	}

	public function store()
	{

		if($this->validate()){
			$post = $this->input->post();
			$post['jumlah'] = 1;
			$nominal = floatval(preg_replace('/\D/', '', $post['harga_beli']));
			$nilai_residu = floatval(preg_replace('/\D/', '', $post['nilai_residu']));
			
			// Data yang diberikan
			$masaManfaat = $post['masa_manfaat']; // Masa manfaat dalam tahun
			$hargaBeli = $nominal; // Harga beli dalam Rupiah

			if($post['metode'] == 'garis_lurus'){
			$tarifPenyusutanPersen = $post['tarif_penyusutan']; // Tarif penyusutan dalam persen
			
			$tarifPenyusutan = $tarifPenyusutanPersen / 100;
			// Menghitung nilai residu
			$nilaiResidu = $nilai_residu;
			// Menghitung penyusutan tahunan
			$penyusutanTahunan = ($hargaBeli - $nilaiResidu) / $masaManfaat;
			// Menghitung penyusutan bulanan
			$penyusutanBulanan = $penyusutanTahunan / 12;
			}else{
			$tarifPenyusutan = 1 / $masaManfaat;
			$post['tarif_penyusutan'] = $tarifPenyusutan * 100;
			$nilai_residu = 0;
			$penyusutanTahunan = 0;
			$penyusutanBulanan = 0;
			}

			$dataAset = array(
				'id_user' =>$this->session->userdata('idapp'),
				'kode_aset' => $post['kode_aset'],
				'nama_aset' => $post['nama_aset'],
				'metode_penyusutan' => $post['metode'],
				'kategori' => $post['kategori'],
				'tanggal_pembelian' => date('Y-m-d',strtotime($post['tanggal'])),
				'masa_manfaat' => $post['masa_manfaat'],
				'tarif_penyusutan' => $post['tarif_penyusutan'],
				'nilai_satuan' => $nominal,
				'qty' => $post['jumlah'],
				'nilai_perolehan' => $hargaBeli,
				'nilai_residu' => $nilai_residu,
				'penyusutan_tahunan' => round($penyusutanTahunan),
				'penyusutan_bulanan' => round($penyusutanBulanan),
				'created_at' => date('Y-m-d H:i:s')
			);

			$this->rtcmodel->insertData('rtc_aset',$dataAset);

			$result = returnResult('success','Aset Berhasil Ditambahkan', 1,1);
			echo $result;
		}

	}

	public function edit($id)
	{
		$data['page_name'] = 'Data Aset';
		$data['page_active'] = 'aset';
		$data['page_sub_active'] = 'daftaraset';
		$data['dataloadmodal'] = 'aset.js';
		$data['aset'] = $this->rtcmodel->selectDataone('rtc_aset',['id_aset'=>$id]);
		$data['kategori'] = $this->rtcmodel->selectWhere('rtc_aset_kategori',['id_user'=>$this->session->userdata('idapp')]);
		$data['metode'] = $this->rtcmodel->selectData('rtc_aset_metode');
		$this->load->view('aset/edit',$data);
	}

	public function update($id)
	{

		if($this->validate()){
			$post = $this->input->post();
			$post['jumlah'] = 1;
			$nominal = floatval(preg_replace('/\D/', '', $post['harga_beli']));
			$nilai_residu = floatval(preg_replace('/\D/', '', $post['nilai_residu']));
			
			// Data yang diberikan
			$masaManfaat = $post['masa_manfaat']; // Masa manfaat dalam tahun
			$hargaBeli = $nominal; // Harga beli dalam Rupiah

			if($post['metode'] == 'garis_lurus'){
				$tarifPenyusutanPersen = $post['tarif_penyusutan']; // Tarif penyusutan dalam persen
				
				$tarifPenyusutan = $tarifPenyusutanPersen / 100;
				// Menghitung nilai residu
				$nilaiResidu = $nilai_residu;
				// Menghitung penyusutan tahunan
				$penyusutanTahunan = ($hargaBeli - $nilaiResidu) / $masaManfaat;
				// Menghitung penyusutan bulanan
				$penyusutanBulanan = $penyusutanTahunan / 12;
			}else{
				$tarifPenyusutan = 1 / $masaManfaat;
				$post['tarif_penyusutan'] = $tarifPenyusutan * 100;
				$nilai_residu = 0;
				$penyusutanTahunan = 0;
				$penyusutanBulanan = 0;
			}

			$dataAset = array(
				'id_user' =>$this->session->userdata('idapp'),
				'kode_aset' => $post['kode_aset'],
				'nama_aset' => $post['nama_aset'],
				'metode_penyusutan' => $post['metode'],
				'kategori' => $post['kategori'],
				'tanggal_pembelian' => date('Y-m-d',strtotime($post['tanggal'])),
				'masa_manfaat' => $post['masa_manfaat'],
				'tarif_penyusutan' => $post['tarif_penyusutan'],
				'nilai_satuan' => $nominal,
				'qty' => $post['jumlah'],
				'nilai_perolehan' => $hargaBeli,
				'nilai_residu' => $nilai_residu,
				'penyusutan_tahunan' => round($penyusutanTahunan),
				'penyusutan_bulanan' => round($penyusutanBulanan),
				'updated_at' => date('Y-m-d H:i:s')
			);

			$this->rtcmodel->updateData('rtc_aset',$dataAset,['id_aset'=>$id]);

			$result = returnResult('success','Aset Berhasil Diubah', 1,1);
			echo $result;
		}

	}

	public function detail($id)
	{
		$data['page_name'] = 'Detail Data Aset';
		$data['page_active'] = 'aset';
		$data['page_sub_active'] = 'daftaraset';
		$data['dataload'] = 'aset_detail.js';
		$data['aset'] = $this->rtcmodel->selectDataone('v_aset',['id_aset'=>$id]);
		$data['aset_tahunan'] = $this->generateDetail($data['aset']);
		$data['aset_bulanan'] = $this->generateDataBulanan($data['aset']);
		$data['v_tahunan'] = $this->load->view('aset/penyusutan_tahunan',$data,true);
		$data['v_grafik_tahunan'] = $this->load->view('aset/grafik',$data,true);
		$data['v_grafik_bulanan'] = $this->load->view('aset/grafik_bulanan',$data,true);
		$data['v_bulanan'] = $this->load->view('aset/penyusutan_bulanan',$data,true);
		$this->template->view('aset/detail',$data);
	}

	public function detailModal($id)
	{
		$data['page_name'] = 'Detail Data Aset';
		$data['page_active'] = 'aset';
		$data['page_sub_active'] = 'daftaraset';
		$data['dataload'] = 'aset_detail.js';
		$data['aset'] = $this->rtcmodel->selectDataone('v_aset',['id_aset'=>$id]);
		$this->load->view('aset/detailModal',$data);
	}


	public function generateDetail($aset)
	{
		$dataGrafik = [
			'labels' => [],
			'datasets' => [
				[
					'label' => 'Nilai Buku',
					'backgroundColor' => [],
					'data' => []
				]
			]
		];
		$hargaBeli = $aset['nilai_satuan']; 
		$tarifPenyusutan = $aset['tarif_penyusutan'] * 100; 
		$masaManfaat = $aset['masa_manfaat']; 
		$jumlah = $aset['qty'];
		$nilaiResiduSatuUnit = $aset['nilai_residu'];
		$penyusutanTahunanSatuUnit = $aset['penyusutan_tahunan'];

		$nilaiResiduTotal = $nilaiResiduSatuUnit * $jumlah;

		$tabelData = [];
		$nilaiBukuTotal = $hargaBeli * $jumlah;
		$akumulasiPenyusutanTotal = 0;

		$tanggalPembelian = $aset['tanggal_pembelian'];
		$tanggalAwal = strtotime($tanggalPembelian);
		$tanggalAwal = strtotime("+1 year", $tanggalAwal);
		$nilaiBukuPerUnit = $hargaBeli;
		$key = 0;
		for ($tahun = 1; $tahun <= $masaManfaat; $tahun++) {
			if($aset['metode_penyusutan'] == 'garis_lurus'){
				$penyusutanTahunanSatuUnit = ($hargaBeli - $nilaiResiduSatuUnit) / $masaManfaat;
				$nilaiBukuPerUnit = $hargaBeli - ($penyusutanTahunanSatuUnit * $tahun);
				$nilaiBukuTotal -= ($penyusutanTahunanSatuUnit * $jumlah);
				$akumulasiPenyusutanTotal += ($penyusutanTahunanSatuUnit * $jumlah);
			}else{
				$tarif_penyusutan_tahunan = 1 / $masaManfaat;
				$penyusutanTahunanSatuUnit = $nilaiBukuPerUnit * $tarif_penyusutan_tahunan;
				$akumulasiPenyusutanTotal += $penyusutanTahunanSatuUnit;
				$nilaiBukuPerUnit -= $penyusutanTahunanSatuUnit;

			}
			$tahunAngka = date("Y", strtotime("+" . ($tahun - 1) . " years", $tanggalAwal));


			$tabelData[] = [
				'Tahun' => $tahunAngka,
				'Biaya Penyusutan' => 'Rp. ' . number_format($penyusutanTahunanSatuUnit, 0, ',', '.'),
				'Akumulasi Penyusutan' => 'Rp. ' . number_format($akumulasiPenyusutanTotal, 0, ',', '.'),
				'Nilai Buku' => 'Rp. ' . number_format($nilaiBukuPerUnit, 0, ',', '.')
			];

			$dataGrafik['labels'][$key] = $tahunAngka;
			$dataGrafik['datasets'][0]['data'][$key] = round($nilaiBukuPerUnit);
			$dataGrafik['datasets'][0]['backgroundColor'][$key] = '#61bfab';

		$key++;
		}




    	$dataRet['grafik'] = json_encode($dataGrafik);
    	$dataRet['table'] = $tabelData;

		return $dataRet;
	}

	public function generateDataBulanan($aset)
	{
		$dataGrafik = [
			'labels' => [],
			'datasets' => [
				[
					'label' => 'Nilai Buku',
					'backgroundColor' => [],
					'data' => []
				]
			]
		];
		$hargaBeli = $aset['nilai_satuan']; 
		$tarifPenyusutan = $aset['tarif_penyusutan'] * 100; 
		$masaManfaat = $aset['masa_manfaat']; 
		$jumlah = $aset['qty'];
		$nilaiResiduSatuUnit = $aset['nilai_residu'];
		$penyusutanTahunanSatuUnit = $aset['penyusutan_tahunan'];

		$nilaiResiduTotal = $nilaiResiduSatuUnit * $jumlah;

		$tabelData = [];

		$tanggalPembelian = $aset['tanggal_pembelian'];
		$tanggalAwal = strtotime($tanggalPembelian);
		$tanggalAwal = strtotime("+1 month", $tanggalAwal);

		$nilaiBukuTotal = $hargaBeli * $jumlah;
		$akumulasiPenyusutanTotal = 0;
		for ($bulan = 1; $bulan <= $masaManfaat * 12; $bulan++) {
			if($aset['metode_penyusutan'] == 'garis_lurus'){
				$penyusutanBulananSatuUnit = ($hargaBeli - $nilaiResiduSatuUnit) / ($masaManfaat * 12);
				$nilaiBukuPerUnit = $hargaBeli - ($penyusutanBulananSatuUnit * $bulan);
				$nilaiBukuTotal -= ($penyusutanBulananSatuUnit * $jumlah);
				$akumulasiPenyusutanTotal += ($penyusutanBulananSatuUnit * $jumlah);
			}else{
				$masa_manfaat_bulan = $masaManfaat * 12;
				$tarif_penyusutan_bulanan = 1 / $masa_manfaat_bulan;
				$tarif_penyusutan_bulanan = round($tarif_penyusutan_bulanan,2);

				$penyusutanBulananSatuUnit = $nilaiBukuTotal * $tarif_penyusutan_bulanan;
				$akumulasiPenyusutanTotal += $penyusutanBulananSatuUnit;
				$nilaiBukuTotal -= $penyusutanBulananSatuUnit;
				$nilaiBukuPerUnit = $nilaiBukuTotal;

			}

			$bulanAngka = date("F Y", strtotime("+" . ($bulan - 1) . " months", $tanggalAwal));

			$key = 0;
			$tabelData[] = [
				'Bulan' => $bulanAngka,
				'Biaya Penyusutan' => 'Rp. ' . number_format($penyusutanBulananSatuUnit, 0, ',', '.'),
				'Akumulasi Penyusutan' => 'Rp. ' . number_format($akumulasiPenyusutanTotal, 0, ',', '.'),
				'Nilai Buku' => 'Rp. ' . number_format($nilaiBukuPerUnit, 0, ',', '.')
			];
			if($key > 0){
				$dataGrafik['labels'][] = $bulanAngka;
				$dataGrafik['datasets'][0]['data'][] = round($nilaiBukuPerUnit);
				$dataGrafik['datasets'][0]['backgroundColor'][] = '#61bfab';
			}

		$key++;
		}
		$dataRet['grafik'] = json_encode($dataGrafik);
    	$dataRet['table'] = $tabelData;

		return $dataRet;
	}

	public function buatKode($idKat)
	{
		$kategori = $this->rtcmodel->selectDataone('rtc_aset_kategori',['id'=>$idKat]);
		$kode = $this->rtcmodel->buatKode('rtc_aset','kode_aset',$kategori['kode_kategori']);
		echo $kode;
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$this->rtcmodel->deleteData('rtc_aset',['id_aset'=>$id]);
		$result = returnResult('success','Data deleted',1);
		echo $result;
	}

	public function test()
	{
		$nilai_perolehan = 200000000; // Nilai Perolehan (Biaya Aset) dalam Rupiah
		$masa_manfaat = 5; // Masa Manfaat dalam tahun
		$nilai_residu = 0; // Nilai Residu (asumsi) dalam Rupiah

		// Hitung Tarif Penyusutan Tahunan
		$tarif_penyusutan_tahunan = 1 / $masa_manfaat;

		// Inisialisasi Nilai Buku Awal
		$nilai_buku = $nilai_perolehan;

		// Loop untuk menghitung penyusutan setiap tahun
		for ($tahun = 1; $tahun <= $masa_manfaat; $tahun++) {
			// Hitung Penyusutan Tahunan
			$penyusutan_tahunan = $nilai_buku * $tarif_penyusutan_tahunan;

			// Hitung Nilai Buku Setelah Penyusutan
			$nilai_buku -= $penyusutan_tahunan;

			// Output Hasil untuk Tahun Tertentu
			echo "Tahun $tahun: Penyusutan = Rp. " . number_format($penyusutan_tahunan, 0, ',', '.') . ", Nilai Buku = Rp. " . number_format($nilai_buku, 0, ',', '.') . "<br>";
		}
	}

	

}

/* End of file Aset.php */
/* Location: ./application/controllers/Aset.php */