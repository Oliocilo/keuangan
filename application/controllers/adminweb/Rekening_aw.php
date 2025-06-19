<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening_aw extends RDC_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['page_name'] = 'Daftar Rekening';
		$data['page_active'] = 'rekening';
		$data['page_sub_active'] = 'rekening';
		$data['dataloadweb'] = 'rekening.js';
		$this->template->admin('adminweb/rekening/list',$data);
	}

	public function jsonData()
	{
		header('Content-Type: application/json');
		$this->datatables->select('id,nama_bank,nama_rekening,nomor_rekening,logo_bank');
		$this->datatables->from('rtc_web_rekening');
		$this->datatables->add_column('view', '<button data-toggle="tooltip" data-placement="top" title="Edit" data-id="$1" data-name="Daftar Rekening" class="btn btn-secondary btn-xs editBtnaw" data-route="rekening" > <i class="fa fa-edit"></i></button> <button class="btn btn-danger btn-xs btndeleteaw" data-id="$1" data-url="'.base_url('conf/rekening/delete').'"> <i class="fa fa-trash"></i></button>', 'id');
		echo $this->datatables->generate();
	}

	public function add()
	{
		$data['page_name'] = 'Daftar Rekening';
		$this->load->view('adminweb/rekening/add',$data);
	}

	public function store()
	{
		$post = $this->input->post();
		$logoBank = '';
		if (isset($_FILES['file']) && $_FILES['file']['error'] === 0 && $_FILES['file']['size'] > 0) {

			$uploadLogo = $uploader = $this->upload_file('file');
			if($uploadLogo['response'] == false){
				$result = returnResultAw('error',$uploadLogo['message']);
				echo $result;
				die();
			}else{
				$logoBank = $uploadLogo['message']['dir'];
			}
		}
		$dataInsert = array(
			'nama_bank' => $post['nama_bank'],
			'nama_rekening'=>$post['nama_rekening'],
			'nomor_rekening' => $post['nomor_rekening'],
			'logo_bank' => $logoBank
		);
		$this->db->insert('rtc_web_rekening',$dataInsert);
		$result = returnResultAw('success','Rekening Berhasil Ditambahkan',1,1);
		
		echo $result;
	}


	public function edit($id)
	{
		$data['page_name'] = 'Daftar Rekening';
		$data['rtcdata'] = $this->rtcmodel->selectDataOne('rtc_web_rekening',['id'=>$id]);
		$this->load->view('adminweb/rekening/edit',$data);
	}


	public function update()
	{
		$post = $this->input->post();
		$dataOld = $this->rtcmodel->selectDataOne('rtc_web_rekening',['id'=>$post['id']]);
		$logoBank = $dataOld['logo_bank'];
		if (isset($_FILES['file']) && $_FILES['file']['error'] === 0 && $_FILES['file']['size'] > 0) {
			$uploadLogo = $uploader = $this->upload_file('file');
			if($uploadLogo['response'] == false){
				$result = returnResultAw('error',$uploadLogo['message']);
				echo $result;
				die();
			}else{
				$logoBank = $uploadLogo['message']['dir'];
			}
		}
		$dataInsert = array(
			'nama_bank' => $post['nama_bank'],
			'nama_rekening'=>$post['nama_rekening'],
			'nomor_rekening' => $post['nomor_rekening'],
			'logo_bank' => $logoBank
		);
		$this->rtcmodel->updateData('rtc_web_rekening',$dataInsert,['id'=>$post['id']]);
		$result = returnResultAw('success','Daftar Rekening Berhasil Diupdate',1,1);
		echo $result;
	}

		public function delete()
	{
		$post = $this->input->post();
		$id = $post['id'];
		$this->db->delete('rtc_web_rekening',['id'=>$id]);
		$result = returnResultAw('success','Data deleted',1,0);
		echo $result;
	}

}

/* End of file Rekening_aw.php */
/* Location: ./application/controllers/adminweb/Rekening_aw.php */