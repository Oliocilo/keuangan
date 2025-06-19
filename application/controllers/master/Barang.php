<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends RDC_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['page_name'] = 'List Barang';
		$data['page_active'] = 'master_barang';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-users';
		$data['dataload'] = 'barang.js';
		$data['namaBulan'] = $this->template->namaBulanIndo();
		$this->template->view('master/barang/list',$data);
	}

	public function jsonData()
	{
		header('Content-Type: application/json');
		$this->datatables->select('id_barang,tanggal,kode_barang,nama_barang,stok');
		$this->datatables->where('id_user',$this->session->userdata('idapp'));
		$this->datatables->where('deleted_at IS NULL', null);
		$this->datatables->where('MONTH(tanggal)',$this->input->post('bulan'));
		$this->datatables->where('YEAR(tanggal)',$this->input->post('tahun'));
		$this->datatables->from('v_barang');
		$this->datatables->add_column('view', '
			<button data-toggle="tooltip" data-placement="top" title="Stok" id="stokform" data-id="$1" class="btn btn-info btn-xs stokform">
				<i class="fa fa-info-circle"></i>
			</button>
			<button data-toggle="tooltip" data-placement="top" title="Histori Penjualan" id="penjualanhis" data-id="$1" class="btn btn-warning btn-xs penjualanhis"> 
				<i class="fa fa-shopping-basket"></i>
			</button>
			<button data-toggle="tooltip" data-placement="top" title="Edit" data-id="$1" class="btn btn-secondary btn-xs edit">
				<i class="fa fa-edit"></i>
			</button>
			<button class="btn btn-danger btn-xs btndelete" data-id="$1" data-url="'.base_url('master/barang/delete/$1').'"> 
				<i class="fa fa-trash"></i>
			</button>', 'id_barang');
		echo $this->datatables->generate();
	}

	public function add()
	{

		$data['page_name'] = 'Tambah Data Barang';
		$data['page_active'] = 'master_barang';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-users';
		$this->load->view('master/barang/add',$data);
		
	}

	function validate(){
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('tanggal', '<strong>Tanggal</strong>', 'required');
		$this->form_validation->set_rules('jam', '<strong>Jam</strong>', 'required');
		$this->form_validation->set_rules('kode_barang', '<strong>Kode Barang</strong>', 'required');
		$this->form_validation->set_rules('nama_barang', '<strong>Nama Barang</strong>', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$result = returnValidate('error','Barang Gagal Ditambahkan', validation_errors());
			echo $result;
			return false;
		}else{
			return true;
		}
	}

	public function store()
	{
		$post = $this->input->post();
		$getKode = $this->rtcmodel->selectDataOne('rtc_barang',['id_user' =>$this->session->userdata('idapp'), 'kode_barang'=>$post['kode_barang'], 'deleted_by'=>null]);
		// if($getKode){
		// 	$result = returnValidate('error','Kode Barang sudah digunakan', 'Kode Barang sudah digunakan');
		// } else {
			if($this->validate()){
				$dataInsert = array(
					'id_user' =>$this->session->userdata('idapp'),
					'tanggal'=>date('Y-m-d',strtotime($post['tanggal'])).' '.$post['jam'].':00',
					'kode_barang'=>$post['kode_barang'],
					'nama_barang'=>$post['nama_barang'],
					'created_at'=>date('Y-m-d H:i:s'),
					'created_by'=> $this->session->userdata('id')
				);
				if($this->rtcmodel->insertData('rtc_barang',$dataInsert)){
					$result = returnResult('success','Barang Berhasil Ditambahkan', 1,1);
				}else{
					$result = returnResult('error','Barang Gagal Ditambahkan', 1);
				}
			}
		// }
		echo $result;
	}

	public function edit($id)
	{

		$data['page_name'] = 'Ubah Data Barang';
		$data['page_active'] = 'master_barang';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-users';
		$data['dataEdit'] = $this->rtcmodel->selectDataone('rtc_barang',['id_barang'=> $id]);
		$this->load->view('master/barang/edit',$data);
		
	}

	public function update()
	{
		$post = $this->input->post();
		$getKode = $this->rtcmodel->selectDataOne('rtc_barang',['id_user' =>$this->session->userdata('idapp'), 'kode_barang'=>$post['kode_barang']]);
		// if($getKode){
		// 	$result = returnValidate('error','Kode Barang sudah digunakan', 'Kode Barang sudah digunakan');
		// } else {
			if($this->validate()){
				$dataInsert = array(
					'id_user' =>$this->session->userdata('idapp'),
					'tanggal'=>date('Y-m-d',strtotime($post['tanggal'])).' '.$post['jam'].':00',
					'kode_barang'=>$post['kode_barang'],
					'nama_barang'=>$post['nama_barang'],
					'updated_at'=>date('Y-m-d H:i:s'),
					'updated_by'=> $this->session->userdata('id')
				);
				if($this->rtcmodel->updateData('rtc_barang',$dataInsert,['id_barang'=>$post['id']])){
					$result = returnResult('success','Barang Berhasil Diubah', 1,1);
				}else{
					$result = returnResult('error','Barang Gagal Diubah', 1);
				}
			}
		// }
		echo $result;
	}

	public function stok($id)
	{

		$data['page_name'] = 'Stok Data Barang';
		$data['page_active'] = 'master_barang';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-users';
		$data['dataloadmodal'] = 'stok.js';
		$data['rtc'] = $this->rtcmodel->selectDataone('rtc_barang',['id_barang'=> $id]);
		$data['buku'] = $this->rtcmodel->selectWhere('rtc_buku',['id_user'=>$this->session->userdata('idapp')]);
		$this->load->view('master/barang/stok',$data);
		
	}

	function validateStok(){
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('tanggal', '<strong>Tanggal Update</strong>', 'required');
		$this->form_validation->set_rules('tanggal_inv', '<strong>Tanggal Invoice</strong>', 'required');
		$this->form_validation->set_rules('nomor_inv', '<strong>Nomor Invoice</strong>', 'required');
		$this->form_validation->set_rules('harga', '<strong>Harga Beli</strong>', 'required');
		$this->form_validation->set_rules('harga_penjualan', '<strong>Harga Jual</strong>', 'required');
		$this->form_validation->set_rules('stok', '<strong>Stok Masuk</strong>', 'required');
		$this->form_validation->set_rules('id_buku', '<strong>Buku Kas</strong>', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$result = returnValidate('error','Stok Barang Gagal Diperbaharui', validation_errors());
			echo $result;
			return false;
		}else{
			return true;
		}
	}

	public function updateStok()
	{
		if($this->validateStok()){
			$post = $this->input->post();

			$hargaBeli = floatval(preg_replace('/\D/', '', $post['harga']));
			$hargaJual = floatval(preg_replace('/\D/', '', $post['harga_penjualan']));

			$dataInsert = array(
				'tanggal_update'=>date('Y-m-d',strtotime($post['tanggal'])).' '.$post['jam'].':00',
				'tanggal_invoice'=>date('Y-m-d',strtotime($post['tanggal_inv'])).' '.$post['jam_inv'].':00',
				'id_barang'=>$post['id_barang'],
				'no_invoice' => $post['nomor_inv'],
				'stok' => $post['stok'],
				'harga'=>$hargaBeli,
				'harga_jual'=>$hargaJual,
				'keterangan'=>$post['keterangan'],
				'created_at'=>date('Y-m-d H:i:s'),
				'created_by'=> $this->session->userdata('id')
			);
			if($this->rtcmodel->insertData('rtc_barang_stok',$dataInsert)){
				$result = returnResult('success','Stok Barang Berhasil Diupdate', 1,1);
				$post['nominal'] = $post['stok']*$hargaBeli;
				$post['tipe'] = 2;
				$post['kategori'] = 2;
				$post['keterangan'] = "No. Invoice: ".$post['nomor_inv'].", ".$post['keterangan'];
				$this->session->set_flashdata('postBook',$post);
				$this->session->set_flashdata('id_barang_stok',$this->db->insert_id());
				$this->session->set_flashdata('postResult',$result);
				redirect('book/store');
			}else{
				$result = returnResult('error','Stok Barang Gagal Diupdate', 1);
			}
			echo $result;
		}
	}

	public function jsonStokData($id,$tipe)
	{
		header('Content-Type: application/json');
		$this->datatables->select('id_barang,tanggal_invoice,no_invoice,stok,harga,harga_jual,keterangan,created_by');
		$this->datatables->where('id_barang',$id);
		$this->datatables->where('tipe',$tipe);
		$this->datatables->from('v_barang_stok');
		echo $this->datatables->generate();
	}

	public function delete($id)
	{
		// $id_barang = $this->rtcmodel->selectDataone('rtc_barang',['id_barang'=> $id])['id_barang'];
		// $data_stok = $this->rtcmodel->selectWhere('rtc_barang_stok', ['id_barang'=>$id_barang]);
		// foreach($data_stok as $stok){
		// 	$id_bt = $stok['id_buku_transaksi'];
		// 	if($id_bt != null) $this->rtcmodel->deleteData('rtc_buku_transaksi',['id'=>$id_bt]);
		// }
		$this->rtcmodel->deleteDataSoft('rtc_barang',['id_barang'=>$id]);
		$result = returnResult('success','Data deleted',1);
		echo $result;
	}

	public function getBarang()
	{
		$search_term = $this->input->get('search'); 
		$this->db->like('nama_barang',$search_term,'BOTH');
		$this->db->where('id_user',$this->session->userdata('idapp'));
		$this->db->where('deleted_at IS NULL', null);
		$suggestions = $this->rtcmodel->selectWhere('v_barang', ['id_user'=>$this->session->userdata('idapp')]);
		$list = [];
		foreach ($suggestions as $key => $val) {
			$list[$key]['id'] = $val['id_barang'];
			$list[$key]['text'] = $val['nama_barang'];
			$list[$key]['stok'] = $val['stok'];
			$list[$key]['harga_beli'] = $val['harga_pembelian'];
			$list[$key]['harga_jual'] = $val['harga_penjualan'];
		}
		
		echo json_encode($list);
	}


	public function history($id)
	{

		$data['page_name'] = 'Stok Data Barang';
		$data['page_active'] = 'master_barang';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-users';
		$data['dataloadmodal'] = 'stok.js';
		$data['rtc'] = $this->rtcmodel->selectDataone('rtc_barang',['id_barang'=> $id]);
		$this->load->view('master/barang/history',$data);
		
	}


	

}

/* End of file Barang.php */
/* Location: ./application/controllers/master/Barang.php */