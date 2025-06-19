<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualanbarang extends RDC_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['page_name'] = 'Data Penjualan Barang';
		$data['page_active'] = 'penjualan_barang';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-users';
		$data['dataload'] = 'penjualan_barang.js';
		$data['namaBulan'] = $this->template->namaBulanIndo();
		$this->template->view('penjualan_barang/list',$data);
	}

	public function jsonData()
	{
		header('Content-Type: application/json');
		$this->datatables->select('id,tanggal,no_penjualan,jumlah_barang,jumlah_item,total_harga_beli,total_harga_jual');
		$this->datatables->where('id_user',$this->session->userdata('idapp'));
		$this->datatables->where('MONTH(tanggal)',$this->input->post('bulan'));
		$this->datatables->where('YEAR(tanggal)',$this->input->post('tahun'));
		$this->datatables->from('v_barang_penjualan');
		$this->datatables->add_column('view', '
			<button data-toggle="tooltip" data-placement="top" title="Detail Aset" id="detail" data-id="$1" class="btn btn-info btn-xs detail">
				<i class="fa fa-info-circle"></i>
			</button>
			<button class="btn btn-danger btn-xs btndelete" data-id="$1" data-url="'.base_url('penjualanbarang/delete/$1').'">
				<i class="fa fa-trash"></i>
			</button>', 'id');
		
		echo $this->datatables->generate();
	}

	public function add()
	{

		$data['page_name'] = 'Tambah Penjualan Barang';
		$data['page_active'] = 'penjualan_barang';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-users';
		$data['roles'] = $this->rtcmodel->selectWhere('rtc_role', ['id >', 1]);
		$data['buku'] = $this->rtcmodel->selectWhere('rtc_buku',['id_user'=>$this->session->userdata('idapp')]);
		$this->load->view('penjualan_barang/add',$data);
		
	}


	public function addBarang()
	{

		$data['page_name'] = 'Tambah Penjualan Barang';
		$data['page_active'] = 'penjualan_barang';
		$data['dataloadmodal'] = 'addbarang.js';
		$this->load->view('penjualan_barang/addbarang',$data);
		
	}

	function validateBarang(){
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('nama_barang', '<strong>Nama Barang</strong>', 'required');
		$this->form_validation->set_rules('jumlah', '<strong>Jumlah</strong>', 'required|numeric|callback_check_stock');
		$this->form_validation->set_rules('harga_beli', '<strong>Harga Beli</strong>', 'required');
		$this->form_validation->set_rules('harga_jual', '<strong>Harga Jual</strong>', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$result = returnValidate('error','Barang Gagal Ditambahkan', validation_errors());
			echo $result;
			return false;
		}else{
			return true;
		}
	}

	public function check_stock($jumlah)
	{
		$id_barang = $this->input->post('nama_barang'); 
		$current_stock = $this->rtcmodel->selectColumnValue('v_barang',['id_barang'=>$id_barang],'stok');

		if ($jumlah > $current_stock) {
			$this->form_validation->set_message('check_stock', '{field} Melebihi Stok.');
			return false;
		}

		return true;
	}

	public function storeBarang()
	{

		if($this->validateBarang()){
			$post = $this->input->post();
			$this->db->where('id_user',$this->session->userdata('idapp'));
			$this->db->where('deleted_at IS NULL', null);
			$this->db->where('id_barang',$post['nama_barang']);
			$barang = $this->rtcmodel->selectDataone('rtc_barang',[]);



			$post['id_barang'] = $barang['id_barang'];
			$post['nama_barang'] = $barang['nama_barang'];
			$post['harga_beli_int'] = cleanInt($post['harga_beli']);
			$post['harga_jual_int'] = cleanInt($post['harga_jual']); 


			$post['total_harga_beli'] = number_format($post['harga_beli_int'] * (int)$post['jumlah'], 0, ',', '.');
			$post['total_harga_jual'] = number_format($post['harga_jual_int'] * (int)$post['jumlah'], 0, ',', '.');

			$post['harga_beli_text'] = number_format($post['harga_beli_int'], 0, ',', '.');
			$post['harga_jual_text'] = number_format($post['harga_jual_int'], 0, ',', '.');


			$post['status'] = 'success';
			echo json_encode($post);
		}

		
	}

	function validateTrans(){
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('nomor_penjualan', '<strong>No. Penjualan</strong>', 'required');
		$this->form_validation->set_rules('tanggal', '<strong>Tanggal Pembelian</strong>', 'required');
		$this->form_validation->set_rules('jam', '<strong>Jam Pembelian</strong>', 'required');
		$this->form_validation->set_rules('id_buku', '<strong>Buku Kas</strong>', 'required');
		$this->form_validation->set_rules('namabarangkey[0]', '<strong>Tambah Barang</strong>', 'required');
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
		if($this->validateTrans()){
			$post = $this->input->post();

			$arrayInv = array(
				'id_user' => $this->session->userdata('idapp'),
				'tanggal'=>date('Y-m-d',strtotime($post['tanggal'])).' '.$post['jam'].':00',
				'no_penjualan'=>$post['nomor_penjualan'],
				'created_at'=>date('Y-m-d H:i:s'),
				'created_by'=> $this->session->userdata('id')
			);

			$this->db->insert('rtc_barang_penjualan',$arrayInv);
			$last_id = $this->db->insert_id();
			$nominal = 0;

			foreach ($post['namabarangkey'] as $key => $val) {

				$barang = $this->rtcmodel->selectDataone('rtc_barang',[
					'id_user'=>$this->session->userdata('idapp'),
					'deleted_at IS NULL'=> null,
					'id_barang'=> $val,
				]);


				$arrayItem[$key]['id_barang_penjualan'] = $last_id;
				$arrayItem[$key]['id_barang'] = $val;
				$arrayItem[$key]['nama_barang'] = $barang['nama_barang'];
				$arrayItem[$key]['jumlah']= $post['jumlahkey'][$key];
				$arrayItem[$key]['harga_beli'] = $post['hargabelikey'][$key];
				$arrayItem[$key]['harga_jual']= $post['hargajualkey'][$key];
				$nominal += ($post['jumlahkey'][$key])*($post['hargajualkey'][$key]);
			}

			if($this->db->insert_batch('rtc_barang_penjualan_item', $arrayItem)){
				$result = returnResult('success','Penjualan Barang Berhasil Ditambahkan', 1,1);
				$post['nominal'] = $nominal;
				$post['tipe'] = 1;
				$post['kategori'] = 1;
				$post['keterangan'] = "No. Penjualan: ".$post['nomor_penjualan'];
				$this->session->set_flashdata('postBook',$post);
				$this->session->set_flashdata('id_barang_penjualan', $last_id);
				$this->session->set_flashdata('postResult',$result);
				redirect('book/store');
			}else{
				$result = returnResult('error','Stok Barang Gagal Diupdate', 1);
			}
			echo $result;
		}
	}

	public function detail($id)
	{
		$data['page_name'] = 'Data Penjualan Barang';
		$data['page_active'] = 'penjualan_barang';
		$data['dataloadmodal'] = 'detail_penjualan_barang.js';
		$data['rtc'] = $this->rtcmodel->selectDataone('v_barang_penjualan',['id'=>$id]);
		$this->load->view('penjualan_barang/detail',$data);
	}

	public function jsonItem($id)
	{
		header('Content-Type: application/json');
		$this->datatables->select('nama_barang,jumlah,harga_beli,total_harga_beli,harga_jual,total_harga_jual');
		$this->datatables->where('id_barang_penjualan',$id);
		$this->datatables->from('v_barang_penjualan_item');
		
		echo $this->datatables->generate();
	}

	public function delete($id)
	{
		$id_bt = $this->rtcmodel->selectDataone('rtc_barang_penjualan',['id'=>$id])['id_buku_transaksi'];
		if($id_bt != null) $this->rtcmodel->deleteData('rtc_buku_transaksi',['id'=>$id_bt]);
		$this->rtcmodel->deleteData('rtc_barang_penjualan',['id'=>$id]);
		$this->rtcmodel->deleteData('rtc_barang_penjualan_item',['id_barang_penjualan'=>$id]);
		$result = returnResult('success','Data deleted',1);
		echo $result;
	}




	

}

/* End of file Barang.php */
/* Location: ./application/controllers/master/Barang.php */