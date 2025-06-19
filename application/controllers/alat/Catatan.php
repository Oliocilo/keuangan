<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catatan extends RDC_Controller {

	public function index()
	{

		$data['page_name'] = 'Catatan';
		$data['page_active'] = 'catatan';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-home';
		$data['catatan'] = $this->rtcmodel->selectWhere('rtc_alat_catatan',['id_user'=>$this->session->userdata('idapp')]);
		$data['dataload'] = 'catatan.js';
		$this->template->view('alat/catatan/index',$data);
		
	}
	
	public function add()
	{

		$data['page_name'] = 'Tambah Catatan';
		$data['page_active'] = 'catatan';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-th-list';
		$data['dataloadmodal'] = 'catatan.js';
		$this->load->view('alat/catatan/add',$data);
		
	}

	public function store()
	{

		$post = $this->input->post();

		$dataInsert = array(
			'id_user'=>$this->session->userdata('idapp'),
			'tanggal'=> date("Y-m-d H:i:s"),
			'catatan'=> $post['deskripsi'],
			'warna_latar'=> $post['warna_latar'],
			'warna_teks'=> $post['warna_teks']
		);
		
		if($post['deskripsi']!=""){
			if($this->rtcmodel->insertData('rtc_alat_catatan',$dataInsert)) 
				$result = returnResult('success','Catatan Berhasil Dibuat', 1,1);
			else $result = returnResult('error','Catatan Tidak Valid', 1);
		}else{
			$result = returnResult('error','Catatan Tidak Valid', 1);
		}
		echo $result;
	}

	public function edit($id)
	{

		$data['page_name'] = 'Ubah Catatan';
		$data['page_active'] = 'catatan';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-th-list';
		$data['rtc'] = $this->rtcmodel->selectDataone('rtc_alat_catatan',array('id'=>$id));
		$this->load->view('alat/catatan/edit',$data);
		
	}

	public function update($id)
	{

		$post = $this->input->post();

		$dataUpdate = array(
			'tanggal'=> date("Y-m-d H:i:s"),
			'catatan'=> $post['deskripsi'],
			'warna_latar'=> $post['warna_latar'],
			'warna_teks'=> $post['warna_teks']
		);
		
		if($post['deskripsi']!=""){
			if($this->rtcmodel->updateData('rtc_alat_catatan',$dataUpdate,['id'=>$id]))
				$result = returnResult('success','Catatan Berhasil Dibuat', 1,1);
			else $result = returnResult('error','Catatan Tidak Valid', 1);
		}else{
			$result = returnResult('error','Catatan Tidak Valid', 1);
		}
		echo $result;

	}

	public function delete($id)
	{
		$this->rtcmodel->deleteData('rtc_alat_catatan',['id'=>$id]);
		$result = returnResult('success','Data deleted',1);
		echo $result;
	}


}

/* End of file Catatan.php */
/* Location: ./application/controllers/alat/Catatan.php */