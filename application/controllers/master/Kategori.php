<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends RDC_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['page_name'] = 'List Kategori';
		$data['page_active'] = 'kategori';
		$data['page_icon'] = 'fa fa-th-list';
		$data['dataload'] = 'kategori.js';
		$this->template->view('master/kategori/list',$data);
	}

	public function jsonData($tipe)
	{
		header('Content-Type: application/json');
		$this->datatables->select('id_kategori,id_user,nama_kategori');
		$this->datatables->where('id_tipe_transaksi',$tipe);
		$this->datatables->where('id_kategori !=',4);
		$this->datatables->where_in('id_user',[$this->session->userdata('idapp'), 0]);
		$this->datatables->from('rtc_kategori');
		$this->datatables->add_column('view', '
			<button type="button" class="btn btn-secondary btn-xs" onclick="editForm('.$tipe.',$1)" data-toggle="modal" data-target="#default-Modal" >
				<i class="fa fa-edit fa-1x"></i>
			</button>
			<button type="button" class="btn btn-danger btn-xs" onclick="deleteAlert(\''.base_url('master/kategori/delete/$1').'\')">
				<i class="fa fa-trash fa-1x"></i>
			</button>', 'id_kategori');
		echo $this->datatables->generate();
	}

	public function add($type)
	{

		$data['page_name'] = 'List Kategori';
		$data['page_active'] = 'master_kategori';
		$data['page_icon'] = 'fa fa-th-list';
		$data['type'] = $type;
		$this->load->view('master/kategori/add',$data);
		
	}

	public function store($id)
	{
		$post = $this->input->post();

		$dataInsert = array(
			
			'id_user' =>$this->session->userdata('idapp'),
			'nama_kategori'=>$post['nama'],
			'id_tipe_transaksi'=>$id
		);
		$tipe = $this->rtcmodel->selectDataone('rtc_tipe_transaksi',array('id'=>$id))['tipe'];
		
		if($this->rtcmodel->insertData('rtc_kategori',$dataInsert)){
			$result = returnResult('success','Kategori '.$tipe.' Berhasil Dibuat', 1,1);
		}else{
			$result = returnResult('error','Username atau Password Salah', 1);
		}
		echo $result;

	}

	public function edit($id)
	{

		$data['page_name'] = 'List Kategori';
		$data['page_active'] = 'master_kategori';
		$data['page_icon'] = 'fa fa-th-list';
		$data['rtc'] = $this->rtcmodel->selectDataone('rtc_kategori',array('id_kategori'=>$id));
		$this->load->view('master/kategori/edit',$data);
		
	}

	public function update($id)
	{
		$post = $this->input->post();

		$dataInsert = array(
			'nama_kategori'=>$post['nama']
		);
		$tipe = $this->rtcmodel->selectDataone('rtc_tipe_transaksi',['id'=>2])['tipe'];
		
		if($this->rtcmodel->updateData('rtc_kategori',$dataInsert,['id_kategori'=>$id])){
			$result = returnResult('success','Kategori '.$tipe.' Berhasil Diperbarui',1,1);
		}else{
			$result = returnResult('error','Gagal diperbarui',1,1);
			
		}
		echo $result;

	}

	public function delete($id)
	{
		$this->rtcmodel->deleteData('rtc_kategori',['id_kategori'=>$id]);
		$result = returnResult('success','Data deleted',1);
		echo $result;
	}
	

}

/* End of file Kategori.php */
/* Location: ./application/controllers/master/Kategori.php */