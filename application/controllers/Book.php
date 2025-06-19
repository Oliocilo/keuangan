<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends RDC_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('session_rtc') == "") redirect('login');
	}

	public function index($idbuku)
	{
		$idbuku = $this->template->matDec($idbuku);
		$bukuDetail = $this->rtcmodel->selectDataOne('v_master_buku',['id_buku'=>$idbuku]);
		$data['page_name'] = $bukuDetail['nama'];
		$data['page_active'] = 'book';
		$data['page_sub_active'] = $idbuku;
		$data['page_icon'] = 'fa fa-book';
		$data['dataload'] = 'book.js';
		$data['bukuDetail']  = $bukuDetail;
		$data['total_saldo'] = $this->getTotalSaldo();
		$data['detailSaldoAwal']  = $this->getSaldoPeriode($idbuku, 'Awal', $this->input->get('bulan'), $this->input->get('tahun'));
		$data['detailSaldoAkhir']  = $this->getSaldoPeriode($idbuku, 'Akhir', $this->input->get('bulan'), $this->input->get('tahun'));
		$data['saldoAkhir']  = $this->getSaldoAkhir($idbuku);
		$data['namaBulan'] = $this->template->namaBulanIndo();
		$data['tipeTransaksi'] = $this->rtcmodel->selectWhere('rtc_tipe_transaksi',null);
		$this->template->view('book/index',$data);
		
	}

	public function jsonData($idbuku)
	{
		$aksesSP003 = 0;
		if($this->template->checkAccessed('SP003') == 1){ 
			$aksesSP003 = 1;
		}

		$aksesSP004 = 0;
		if($this->template->checkAccessed('SP004') == 1){ 
			$aksesSP004 = 1;
		}

		$idbuku = $this->template->matDec($idbuku);
		$post = $this->input->post();
		header('Content-Type: application/json');
		$this->datatables->select('id,id_kategori,tipe,tanggal,nominal_masuk,nominal_keluar,deskripsi,nama_kategori,day_only,nominal,created_at,created_by_name');
		$this->datatables->where('id_buku',$idbuku);
		$this->datatables->where('MONTH(tanggal)',$post['bulan']);
		$this->datatables->where('YEAR(tanggal)',$post['tahun']);
		if($aksesSP004 != 1){
		$this->datatables->where('created_by_id',$this->session->userdata('id'));
		}
		$this->datatables->from('v_buku_transaksi');
		$this->datatables->add_column('view', '
			<button data-toggle="tooltip" data-placement="top" title="Edit Transaksi" data-trans="$1" data-tipe="$2" class="btn btn-secondary btn-xs editTransaksiBtn">
				<i class="fa fa-edit"></i>
			</button>
			<button class="btn btn-danger btn-xs btndelete" data-id="$1" data-url="'.base_url('book/delete').'">
				<i class="fa fa-trash"></i>
			</button>', 'id,tipe');
		$this->datatables->add_column('view_barang', '
			<button class="btn btn-danger btn-xs btndelete" data-id="$1" data-url="'.base_url('book/delete').'">
				<i class="fa fa-trash"></i>
			</button>', 'id');
		echo $this->datatables->generate();
	}

	public function add($type, $id_buku)
	{

		$data['page_name'] = 'PROSAFEMART';
		$data['page_active'] = 'book';
		$data['page_sub_active'] = 'daftaraset';
		$data['page_icon'] = 'fa fa-th-list';
		$data['dataloadmodal'] = 'pemasukan.js';
		$data['type'] = $type;
		$data['id_buku'] = $id_buku;
		$data['kategori'] = $this->rtcmodel->selectWhere('rtc_kategori',['id_tipe_transaksi'=>$type, 'id_user'=>$this->session->userdata('idapp')]);
		if($type == 3){
			$data['buku'] = $this->rtcmodel->selectWhere('rtc_buku',['id_user'=>$this->session->userdata('idapp')]);
			$this->load->view('book/add_transfer',$data);
		}else{
			$this->load->view('book/add',$data);
		}
		
		
	}



	function validate($normal){
		if($normal){
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('tanggal', '<strong>Tanggal</strong>', 'required');
			$this->form_validation->set_rules('jam', '<strong>Jam</strong>', 'required');
			$this->form_validation->set_rules('kategori', '<strong>Kategori</strong>', 'required');
			$this->form_validation->set_rules('nominal', '<strong>Nominal</strong>', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$result = returnValidate('error','Transaksi Gagal Ditambahkan', validation_errors());
				echo $result;
				return false;
			}else{
				return true;
			}
		} else return true;
	}


	function validateTransfer(){
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('tanggal', '<strong>Tanggal</strong>', 'required');
		$this->form_validation->set_rules('jam', '<strong>Jam</strong>', 'required');
		$this->form_validation->set_rules('buku_from', '<strong>Dari Buku Kas</strong>', 'required');
		$this->form_validation->set_rules('buku_to', '<strong>Ke Buku Kas</strong>', 'required');
		$this->form_validation->set_rules('nominal', '<strong>Nominal</strong>', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$result = returnValidate('error','Transaksi Transfer Gagal Ditambahkan', validation_errors());
			echo $result;
			return false;
		}else{
			return true;
		}
	}

	public function store()
	{
		$postBook = $this->session->flashdata('postBook');

		$post = $postBook != "" ? $postBook : $this->input->post();
		$normal =  $postBook != "" ? false : true;

		if($post['tipe'] == 3){
			if($this->validateTransfer()){
				$this->store_transfer();
			}
		}else{
			if($this->validate($normal)){
				$idbuku = $this->template->matDec($post['id_buku']);
				$nominal = floatval(preg_replace('/\D/', '', $post['nominal']));
				$tipeTransaksi = $this->rtcmodel->selectDataOne('rtc_tipe_transaksi',['id'=>$post['tipe']]);

				if($tipeTransaksi['rumus'] == 'minus'){
					$nominal = $nominal * -1;
				}

				$dataInsert = array(
					'id_buku' => $idbuku,
					'id_kategori'=>$post['kategori'],
					'tipe' =>$tipeTransaksi['tipe'],
					'tanggal'=>date('Y-m-d',strtotime($post['tanggal'])).' '.$post['jam'].':00',
					'nominal'=>$nominal,
					'deskripsi'=>$post['keterangan'],
					'created_at' => date('Y-m-d H:i:s'),
					'created_by_id' => $this->session->userdata('id'),
					'created_by_name' => $this->session->userdata('nama')
				);
				$this->rtcmodel->insertData('rtc_buku_transaksi',$dataInsert);
				$success = true;
				
				if($postBook != ""){
					$dataUpdate = array(
						'id_buku_transaksi'=> $this->db->insert_id()
					);
					if(isset($post['id_barang'])){
						$id_barang_stok = $this->session->flashdata('id_barang_stok');
						$success = $this->rtcmodel->updateData('rtc_barang_stok',$dataUpdate,['id_barang_stok'=>$id_barang_stok]);
					}else if(isset($post['nomor_penjualan'])){
						$id_barang_penjualan = $this->session->flashdata('id_barang_penjualan');
						$success = $this->rtcmodel->updateData('rtc_barang_penjualan',$dataUpdate,['id'=>$id_barang_penjualan]);
					}else {
						$id_transaksi_utang = $this->session->flashdata('id_transaksi_utang');
						$success = $this->rtcmodel->updateData('rtc_transaksi_utang_piutang',$dataUpdate,['id'=>$id_transaksi_utang]);
					}
				}

				if($success){
					$result = $postBook == "" ? returnResult('success','Transaksi Berhasil Ditambahkan', 1,1) : $this->session->flashdata('postResult');
				}else{
					$result = returnResult('error','Transaksi Gagal Ditambahkan', 1,1);
				}
				echo $result;
			}
		}
	

	}

	public function store_transfer()
	{
		$post = $this->input->post();

		$tipeTransaksi = $this->rtcmodel->selectDataOne('rtc_tipe_transaksi',['id'=>$post['tipe']]);
		$nominal = floatval(preg_replace('/\D/', '', $post['nominal']));
		$nominal_minus = $nominal * -1;

		$bukuDari = $this->rtcmodel->selectColumnValue('rtc_buku',['id_buku'=>$post['buku_from']],'nama');
		$bukuke = $this->rtcmodel->selectColumnValue('rtc_buku',['id_buku'=>$post['buku_to']],'nama');

		$dataInsert = array(
			'id_buku' =>$post['buku_from'],
			'id_kategori'=>3,
			'tipe' =>'Pengeluaran',
			'tanggal'=>date('Y-m-d',strtotime($post['tanggal'])).' '.$post['jam'].':00',
			'nominal'=>$nominal_minus,
			'deskripsi'=>$post['keterangan'],
			'remark_transfer' => 'Transfer Ke '.$bukuke,
			'created_at' => date('Y-m-d H:i:s'),
			'created_by_id' => $this->session->userdata('id'),
			'created_by_name' => $this->session->userdata('nama')
		);
		$this->rtcmodel->insertData('rtc_buku_transaksi',$dataInsert);
		$last_id = $this->db->insert_id();

		$dataInsertTo = array(
			'id_buku' =>$post['buku_to'],
			'id_kategori'=>3,
			'tipe' =>'Pemasukan',
			'tanggal'=>date('Y-m-d',strtotime($post['tanggal'])).' '.$post['jam'].':00',
			'nominal'=>$nominal,
			'deskripsi'=>$post['keterangan'],
			'remark_transfer' => 'Transfer Dari '.$bukuDari,
			'created_at' => date('Y-m-d H:i:s'),
			'created_by_id' => $this->session->userdata('id'),
			'created_by_name' => $this->session->userdata('nama')
		);
		$this->rtcmodel->insertData('rtc_buku_transaksi',$dataInsertTo);
		$last_id2 = $this->db->insert_id();

		$kodeTransfer = $post['buku_from'].'_'.$post['buku_to'].'-'.$last_id.'_'.$last_id2;
		$this->db->where_in('id',[$last_id,$last_id2]);
		$this->db->update('rtc_buku_transaksi',['kode_transfer'=>$kodeTransfer]);

		$result = returnResult('success','Transaksi Transfer Berhasil Ditambahkan', 1,1);
		echo $result;

	}

	public function edit($type, $idTrans)
	{


		$data['dataEdit'] = $this->rtcmodel->selectDataOne('rtc_buku_transaksi',['id'=>$idTrans]);

		$tipeTransaksi = $this->rtcmodel->selectDataOne('rtc_tipe_transaksi',['tipe'=>$data['dataEdit']['tipe']]);
		$data['page_name'] = 'PROSAFEMART';
		$data['page_active'] = 'book';
		$data['page_sub_active'] = 'daftaraset';
		$data['page_icon'] = 'fa fa-th-list';
		$data['dataloadmodal'] = 'pemasukan.js';
		$data['type'] = $type;
		$data['kategori'] = $this->rtcmodel->selectWhere('rtc_kategori',['id_tipe_transaksi'=>$tipeTransaksi['id'], 'id_user'=>$this->session->userdata('idapp')]);
		if($data['dataEdit']['id_kategori'] == '3'){
			$data['buku'] = $this->rtcmodel->selectWhere('rtc_buku',['id_user'=>$this->session->userdata('idapp')]);
			$transferKode = $data['dataEdit']['kode_transfer'];
			$pecahTransferKodeRaw = explode('-', $transferKode);
			$pecahTransferKode = explode('_', $pecahTransferKodeRaw[0]);
			$data['kodeTransfer'] = $pecahTransferKode;
			$this->load->view('book/edit_transfer',$data);
		}else{
			$this->load->view('book/edit',$data);
		}
		
		
	}


	public function update()
	{
		$post = $this->input->post();
		$dataEdit = $this->rtcmodel->selectDataOne('rtc_buku_transaksi',['id'=>$post['idTrans']]);

		if($dataEdit['id_kategori'] == 3){
			if($this->validateTransfer()){
				$this->update_transfer();
			}
		}else{

			if($this->validate(true)){

				$tipeTransaksi = $this->rtcmodel->selectDataOne('rtc_tipe_transaksi',['tipe'=>$dataEdit['tipe']]);
				$nominal = floatval(preg_replace('/\D/', '', $post['nominal']));


				if($tipeTransaksi['rumus'] == 'minus'){
					$nominal = $nominal * -1;
				}

				$dataUpdate = array(
					'id_kategori'=>$post['kategori'],
					'tanggal'=>date('Y-m-d',strtotime($post['tanggal'])).' '.$post['jam'].':00',
					'nominal'=>$nominal,
					'deskripsi'=>$post['keterangan'],
				);

				if($this->rtcmodel->updateData('rtc_buku_transaksi',$dataUpdate,['id'=>$post['idTrans']])){
					$result = returnResult('success','Transaksi Berhasil Ditambahkan', 1,1);
				}else{
					$result = returnResult('error','Transaksi Gagal Ditambahkan', 1,1);
				}
				echo $result;
			}
		}

	}

	public function update_transfer()
	{
		$post = $this->input->post();
		$dataEdit = $this->rtcmodel->selectDataOne('rtc_buku_transaksi',['id'=>$post['idTrans']]);

		$nominal = floatval(preg_replace('/\D/', '', $post['nominal']));
		$nominal_minus = $nominal * -1;

		$bukuDari = $this->rtcmodel->selectColumnValue('rtc_buku',['id_buku'=>$post['buku_from']],'nama');
		$bukuke = $this->rtcmodel->selectColumnValue('rtc_buku',['id_buku'=>$post['buku_to']],'nama');
		$kodeTransfer = $post['buku_from'].'_'.$post['buku_to'];


		$transferKode = $dataEdit['kode_transfer'];
		$pecahTransferKodeRaw = explode('-', $transferKode);
		$pecahTransferKode = explode('_', $pecahTransferKodeRaw[1]);


		$dataInsert = array(
			'id_buku' =>$post['buku_from'],
			'id_kategori'=>3,
			'tipe' =>'Pengeluaran',
			'tanggal'=>date('Y-m-d',strtotime($post['tanggal'])).' '.$post['jam'].':00',
			'nominal'=>$nominal_minus,
			'deskripsi'=>$post['keterangan'],
			'remark_transfer' => 'Transfer Ke '.$bukuke,
			'updated_at' => date('Y-m-d H:i:s'),
			'updated_by_id' => $this->session->userdata('id'),
			'updated_by_name' => $this->session->userdata('nama')
		);
		$this->rtcmodel->updateData('rtc_buku_transaksi',$dataInsert,['id'=>$pecahTransferKode[0]]);
		$last_id = $pecahTransferKode[0];

		$dataInsertTo = array(
			'id_buku' =>$post['buku_to'],
			'id_kategori'=>3,
			'tipe' =>'Pemasukan',
			'tanggal'=>date('Y-m-d',strtotime($post['tanggal'])).' '.$post['jam'].':00',
			'nominal'=>$nominal,
			'deskripsi'=>$post['keterangan'],
			'remark_transfer' => 'Transfer Dari '.$bukuDari,
			'updated_at' => date('Y-m-d H:i:s'),
			'updated_by_id' => $this->session->userdata('id'),
			'updated_by_name' => $this->session->userdata('nama')
		);
		$this->rtcmodel->updateData('rtc_buku_transaksi',$dataInsertTo,['id'=>$pecahTransferKode[1]]);
		$last_id2 = $pecahTransferKode[1];

		$kodeTransfer = $post['buku_from'].'_'.$post['buku_to'].'-'.$last_id.'_'.$last_id2;
		$this->db->where_in('id',[$last_id,$last_id2]);
		$this->db->update('rtc_buku_transaksi',['kode_transfer'=>$kodeTransfer]);

		$result = returnResult('success','Transaksi Transfer Berhasil Diupdate',1,1);
		echo $result;

	}

	public function delete()
	{
		$id = $_POST['id'];
		$Trans = $this->rtcmodel->selectDataOne('rtc_buku_transaksi',['id'=>$id]);
		if($Trans['id_kategori'] == 3){
			$transferKode = $Trans['kode_transfer'];
			$pecahTransferKodeRaw = explode('-', $transferKode);
			$pecahTransferKode = explode('_', $pecahTransferKodeRaw[1]);
			$this->rtcmodel->deleteData('rtc_buku_transaksi',['id'=>$pecahTransferKode[0]]);
			$this->rtcmodel->deleteData('rtc_buku_transaksi',['id'=>$pecahTransferKode[1]]);
		}else{
			$this->rtcmodel->deleteData('rtc_buku_transaksi',['id'=>$id]);
			//Delete Penjualan
			if($Trans['id_kategori'] == 1){
				$id_bp = $this->rtcmodel->selectDataone('rtc_barang_penjualan',['id_buku_transaksi'=>$id])['id'];
				$this->rtcmodel->deleteData('rtc_barang_penjualan',['id_buku_transaksi'=>$id]);
				$this->rtcmodel->deleteData('rtc_barang_penjualan_item',['id_barang_penjualan'=>$id_bp]);
			}
			//Delete Pembelian
			if($Trans['id_kategori'] == 2){
				$this->rtcmodel->deleteData('rtc_barang_stok',['id_buku_transaksi'=>$id]);
			}
		}
		$result = returnResult('success','Transaksi Berhasil Dihapus',1,0);
		echo $result;
	}




	

}

// PROGRAMMER : RAHMAT HIDAYAT
/* End of file voucher.php */
/* Location: ./application/controllers/voucher.php */