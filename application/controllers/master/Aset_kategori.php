<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aset_kategori extends RDC_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['page_name'] = 'List Kategori Aset';
		$data['page_active'] = 'aset';
		$data['page_sub_active'] = 'kategoriaset';
		$data['page_icon'] = 'fa fa-th-list';
		$data['dataload'] = 'aset_kategori.js';
		$this->template->view('master/aset_kategori/list',$data);
	}

	public function jsonData()
	{
		$aksesSP017 = 0;
		if($this->template->checkAccessed('SP017') == 1){
			$aksesSP017 = 1;
		}
		header('Content-Type: application/json');
		$this->datatables->select('id,kode_kategori,nama_kategori');
		$this->datatables->where('id_user',$this->session->userdata('idapp'));
		$this->datatables->from('rtc_aset_kategori');
		if($aksesSP017 == 1){
		$this->datatables->add_column('view', '
			<button data-toggle="tooltip" data-placement="top" title="Edit" data-id="$1" class="btn btn-secondary btn-xs edit"> 
				<i class="fa fa-edit"></i>
			</button> 
			<button class="btn btn-danger btn-xs btndelete" data-id="$1" data-url="'.base_url('master/aset_kategori/delete/$1').'"> 
				<i class="fa fa-trash"></i>
			</button>', 'id');
		}else{
			$this->datatables->add_column('view', 'F');
		}
		echo $this->datatables->generate();
	}

	public function add()
	{

		$data['page_name'] = 'List Kategori';
		$data['page_active'] = 'master_kategori';
		$data['page_icon'] = 'fa fa-th-list';
		$this->load->view('master/aset_kategori/add',$data);
		
	}

	public function store()
	{
		$post = $this->input->post();
		$getKode = $this->rtcmodel->selectDataOne('rtc_aset_kategori',['id_user' =>$this->session->userdata('idapp'), 'kode_kategori'=>$post['kode']]);
		if($getKode){
			$result = returnValidate('error','Kode Kategori sudah digunakan', 'Kode Kategori sudah digunakan');
		} else {
			if($this->validate()){
				$post = $this->input->post();
				$dataInsert = array(
					
					'id_user' =>$this->session->userdata('idapp'),
					'kode_kategori'=>$post['kode'],
					'nama_kategori'=>$post['nama']
				);
				if($this->rtcmodel->insertData('rtc_aset_kategori',$dataInsert)){
					$result = returnResult('success','Kategori Aset Berhasil Dibuat', 1,1);
				}else{
					$result = returnResult('error','Kategori Aset Gagal Dibuat', 1);
				}
			}
		}
		echo $result;
	}
	
	function validate(){
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('kode', '<strong>Kode Kategori</strong>', 'required');
		$this->form_validation->set_rules('nama', '<strong>Nama Kategori</strong>', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$result = returnValidate('error','Aset gagal dibuat', validation_errors());
			echo $result;
			return false;
		}else{
			return true;
		}
	}

	public function edit($id)
	{

		$data['page_name'] = 'List Kategori';
		$data['page_active'] = 'master_kategori';
		$data['page_icon'] = 'fa fa-th-list';
		$data['rtc'] = $this->rtcmodel->selectDataone('rtc_aset_kategori',array('id'=>$id));
		$this->load->view('master/aset_kategori/edit',$data);
		
	}

	public function update()
	{
		$post = $this->input->post();
		$getKode = $this->rtcmodel->selectDataOne('rtc_aset_kategori',['id_user' =>$this->session->userdata('idapp'), 'kode_kategori'=>$post['kode']]);
		if($getKode){
			$result = returnValidate('error','Kode Kategori sudah digunakan', 'Kode Kategori sudah digunakan');
		} else {
			if($this->validate()){
				$post = $this->input->post();
				$id = $post['id'];
				$dataInsert = array(
					'kode_kategori'=>$post['kode'],
					'nama_kategori'=>$post['nama']
				);
				if($this->rtcmodel->updateData('rtc_aset_kategori',$dataInsert,['id'=>$id])){
					$result = returnResult('success','Kategori Aset Berhasil Diperbarui',1,1);
				}else{
					$result = returnResult('error','Gagal diperbarui',1,1);
				}
			}
		}
		echo $result;
	}

	public function delete($id)
	{
		$this->rtcmodel->deleteData('rtc_aset_kategori',['id'=>$id]);
		$result = returnResult('success','Data deleted',1);
		echo $result;
	}

}

/* End of file Aset_kategori.php */
/* Location: ./application/controllers/master/Aset_kategori.php */