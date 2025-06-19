<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Einvoice extends RDC_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
		$data['page_name'] = 'e-Invoice';
		$data['page_active'] = 'invoice';
		$data['page_sub_active'] = '';
		$data['dataload'] = 'einvoice.js';
		$data['noInv'] = $this->rtcmodel->buatKodeInv('rtc_alat_invoice');
		$this->template->view('alat/einvoice/add',$data);	
	}

	public function uploadLogo()
	{
		if($this->session->userdata('id')){
			$uploader = $this->upload_file('file');
			echo json_encode($uploader);
		}else{
			echo "NOT_LOGIN";
		}
		
	}

	public function getPelanggan()
	{
		$search_term = $this->input->get('term'); 
		$this->db->like('nama',$search_term,'BOTH');
		$suggestions = $this->rtcmodel->selectWhere('rtc_alat_invoice_pelanggan', ['id_user'=>$this->session->userdata('idapp')]);
		
		echo json_encode($suggestions);
	}

	public function print($id)
	{

		$data['page_name'] = 'e-Invoice';
		$data['invoice'] = $this->rtcmodel->selectDataone('rtc_alat_invoice',['id'=>$id]);
		$data['invoiceItem'] = $this->rtcmodel->selectWhere('rtc_alat_invoice_item',['id_alat_invoice'=>$id]);
		$this->template->print('alat/einvoice/print',$data);
		
	}

	

	public function store()
	{
		$post = $this->input->post();
		$st = $_POST['st'];

		$checkOf = ['pajak','sudahbayar','diskon','pajak','ongkir'];
		$stemp = ['stampLunas','stampFinal','stampDisetujui','stampDikirim','stampJatuhTempo','stampSegera'];

		$noOfAlamat = [2,3,6];

		$alamatJson = [];
		foreach ($noOfAlamat as $key => $valAl) {
			for ($i=1; $i <=3 ; $i++) { 
				$alamatJson[$valAl]['alamat'][$i] = $st[$valAl]['alamat_baris_'.$i];
			}
		}


		$arrayInvoice = array(
			
			'id_user' =>$this->session->userdata('idapp'),
			'no_invoice' =>$st[1]['invoice_no'],
			'tanggal' =>$st[1]['invoice_tanggal'],
			'tanggal_jatuh_tempo'=>$st[1]['invoice_jatuhTempo'],

			'nama_perusahaan'=>$st[2]['nama_perusahaan'],
			'alamat_perusahaan'=>json_encode($alamatJson[2]),

			'nama_pelanggan'=>$st[3]['nama_pelanggan'],
			'alamat_pelanggan'=>json_encode($alamatJson[3]),

			

			'subtotal'=>cleanInt($st[4]['subtotal']),
			'total'=>cleanInt($st[4]['totalfinal']),
			'catatan'=>$st[5]['catatan']
		);

		if (isset($st[6]['is_dikirim'])) {
			$arrayInvoice['is_dikirim']= 1;
			$arrayInvoice['nama_penerima']=$st[6]['nama_penerima'];
			$arrayInvoice['alamat_penerima']=json_encode($alamatJson[6]);
		}

		foreach ($checkOf as $key => $val) {
			if (isset($_POST[$val])) {
				$arrayInvoice['is_'.$val] = 1;
				$arrayInvoice[$val] = cleanInt($st[4][$val]);
			}
		}

		$arrStemp = [];
		foreach ($stemp as $key => $val) {
			if (isset($_POST[$val])) {
				array_push($arrStemp, $val);
			}
		}

		$arrayInvoice['stempel'] = json_encode($arrStemp);

		$this->db->insert('rtc_alat_invoice',$arrayInvoice);
		$last_id = $this->db->insert_id();


		foreach ($post['id'] as $key => $item) {
			$arrayItem = array(
				'id_alat_invoice'=>$last_id,
				'no'=>$post['id'][$key],
				'desc'=>$post['desc'][$key],
				'qty'=>$post['qty'][$key],
				'harga'=>cleanInt($post['harga'][$key]),
				'total'=>cleanInt($post['total'][$key])
			);

			$this->db->insert('rtc_alat_invoice_item',$arrayItem);
		}


		$arrayPelanggan = array(
			'nama'=>$st[3]['nama_pelanggan'],
			'alamat_1'=>$alamatJson[3]['alamat'][1],
			'alamat_2'=>$alamatJson[3]['alamat'][2],
			'alamat_3'=>$alamatJson[3]['alamat'][3]
		);
		$cekDup = $this->rtcmodel->selectDataone('rtc_alat_invoice_pelanggan',$arrayPelanggan);
		if(empty($cekDup)){
			$this->db->insert('rtc_alat_invoice_pelanggan',$arrayPelanggan);
		}

		echo "success";
		


	}

	public function list()
	{
		
		$data['page_name'] = 'e-Invoice';
		$data['page_active'] = 'alat';
		$data['page_sub_active'] = '';
		$data['dataload'] = 'einvoiceList.js';
		$this->template->view('alat/einvoice/list',$data);	
	}

	public function json()
	{
		header('Content-Type: application/json');
		$this->datatables->select('id,no_invoice,tanggal,tanggal_jatuh_tempo,nama_pelanggan,total');

		$this->datatables->where('id_user',$this->session->userdata('idapp'));
		$this->datatables->from('v_alat_invoice');
		$this->datatables->add_column('view', '<button data-toggle="tooltip" data-placement="top" title="Edit" data-id="$1" class="btn btn-secondary btn-xs edit"> <i class="fa fa-edit"></i></button> <button class="btn btn-danger btn-xs btndelete" data-id="$1" data-url="'.base_url('alat/einvoice/delete').'"> <i class="fa fa-trash"></i></button>', 'id');
		echo $this->datatables->generate();
	}


	public function pelanggan()
	{
		
		$data['page_name'] = 'e-Invoice';
		$data['page_active'] = 'alat';
		$data['page_sub_active'] = '';
		$data['dataload'] = 'einvoicePelanggan.js';
		$this->template->view('alat/einvoice/pelanggan',$data);	
	}


	public function jsonPelanggan()
	{
		header('Content-Type: application/json');
		$this->datatables->select('id,nama,alamat_1,alamat_2,alamat_3');

		$this->datatables->where('id_user',$this->session->userdata('idapp'));
		$this->datatables->from('rtc_alat_invoice_pelanggan');
		$this->datatables->add_column('view', '<button data-toggle="tooltip" data-placement="top" title="Edit" data-id="$1" class="btn btn-secondary btn-xs edit"> <i class="fa fa-edit"></i></button> <button class="btn btn-danger btn-xs btndelete" data-id="$1" data-url="'.base_url('alat/einvoice/deletePelanggan').'"> <i class="fa fa-trash"></i></button>', 'id');
		echo $this->datatables->generate();
	}

	function validatePelanggan(){
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('nama', '<strong>Nama</strong>', 'required');
		$this->form_validation->set_rules('alamat_1', '<strong>Alamat Baris 1</strong>', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$result = returnValidate('error','Pelanggan Gagal Ditambahkan', validation_errors());
			echo $result;
			return false;
		}else{
			return true;
		}
	}

	public function addPelanggan()
	{

		$data['page_name'] = 'e-Invoice';
		$data['page_active'] = 'alat';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-th-list';
		$this->load->view('alat/einvoice/add_pelanggan',$data);
		
	}

	public function storePelanggan()
	{
		if($this->validatePelanggan()){
		$post = $this->input->post();
		$dataInsert = array(
			
			'id_user' =>$this->session->userdata('idapp'),
			'nama'=>$post['nama'],
			'alamat_1'=>$post['alamat_1'],
			'alamat_2'=>$post['alamat_2'],
			'alamat_3'=>$post['alamat_3']
		);
		if($this->rtcmodel->insertData('rtc_alat_invoice_pelanggan',$dataInsert)){
			$result = returnResult('success','Pelanggan Berhasil Dibuat', 1,1);
		}else{
			$result = returnResult('error','Pelanggan Gagal Dibuat', 1);
		}
		echo $result;
		}
	}

	public function editPelanggan($id)
	{

		$data['page_name'] = 'e-Invoice';
		$data['page_active'] = 'alat';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-th-list';
		$data['rtc'] = $this->rtcmodel->selectDataone('rtc_alat_invoice_pelanggan',array('id'=>$id));
		$this->load->view('alat/einvoice/edit_pelanggan',$data);
		
	}

	public function updatePelanggan()
	{
		if($this->validatePelanggan()){
		$post = $this->input->post();
		$dataInsert = array(
			'nama'=>$post['nama'],
			'alamat_1'=>$post['alamat_1'],
			'alamat_2'=>$post['alamat_2'],
			'alamat_3'=>$post['alamat_3']
		);
		if($this->rtcmodel->updateData('rtc_alat_invoice_pelanggan',$dataInsert,['id'=>$post['id']])){
			$result = returnResult('success','Pelanggan Berhasil Dibuat', 1,1);
		}else{
			$result = returnResult('error','Pelanggan Gagal Dibuat', 1);
		}
		echo $result;
		}
	}

}

/* End of file Einvoice.php */
/* Location: ./application/controllers/alat/Einvoice.php */