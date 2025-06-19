<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_aw extends RDC_Controller {


	public function __construct()
	{
		parent::__construct();
	}

	
	public function index()
	{

		$data['page_name'] = 'Pengguna Terdaftar';
		$data['page_active'] = 'pengguna';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-home';
		$data['dataloadweb'] = 'pengguna.js';
		$this->template->admin('adminweb/pengguna/index',$data);
		
	}

	public function jsonData()
	{
		header('Content-Type: application/json');
		$this->datatables->select('id,username,nama,subscription_type,totalchild,created_at');
		$this->datatables->from('v_aw_pengguna');
		$this->datatables->add_column('view', '<button data-toggle="tooltip" data-placement="top" title="Detail" data-id="$1" class="btn btn-secondary btn-xs edit"> <i class="fa fa-arrow-right"></i></button>', 'id');
		echo $this->datatables->generate();
	}

	public function detail($id)
	{

		$data['page_name'] = 'Pengguna Terdaftar';
		$data['page_active'] = 'pengguna';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-home';
		$data['pengguna'] = $this->rtcmodel->selectDataone('rtc_user',['id'=>$id]);
		$this->template->admin('adminweb/pengguna/detail',$data);
		
	}

}

/* End of file Pengguna_aw.php */
/* Location: ./application/controllers/adminweb/Pengguna_aw.php */