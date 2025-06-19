<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bukukas extends RDC_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['page_name'] = 'List Buku Kas';
		$data['page_active'] = 'bukukas';
		$data['page_icon'] = 'fa fa-th-list';
		$data['dataload'] = 'bukukas.js';
		$data['bukukasMaster'] = $this->rtcmodel->selectWhere('v_master_buku',['id_user'=>$this->session->userdata('idapp')]);
		$this->template->view('master/bukukas/list',$data);
	}

	public function add($type)
	{

		$data['page_name'] = 'List Buku Kas';
		$data['page_active'] = 'master_bukukas';
		$data['page_icon'] = 'fa fa-th-list';
		$data['type'] = $type;
		$this->load->view('master/bukukas/add',$data);
		
	}

	function validate($normal){
		if($normal){
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('nama', '<strong>Nama Buku Kas</strong>', 'required');
			$this->form_validation->set_rules('saldo_awal', '<strong>Saldo Awal</strong>', 'required');
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

	public function store()
	{
		$postBook = $this->session->flashdata('postBook');
		$normal =  $postBook != "" ? false : true;
		if($this->validate($normal)){
			$post = $postBook != "" ? $postBook : $this->input->post();
			$is_default = $postBook != "" ? 1 : 0;

			$nominal = floatval(preg_replace('/\D/', '', $post['saldo_awal']));

			$dataInsert = array(
				'id_user' =>$this->session->userdata('idapp'),
				'nama'=>$post['nama'],
				'saldo_awal'=>$nominal,
				'deskripsi' =>$post['deskripsi'],
				'created_at'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('id'),
				'created_by_name'=>$this->session->userdata('nama'),
				'is_default'=> $is_default,
			);
			$this->rtcmodel->insertData('rtc_buku',$dataInsert);
			$last_id = $this->db->insert_id();

			$dataInsertTransaksi = array(
				'id_buku' =>$last_id,
				'id_kategori'=>4,
				'tipe' =>'Pemasukan',
				'tanggal'=>'0000-00-00 00:00:00',
				'nominal'=>$nominal,
				'deskripsi'=>'Saldo Awal',
				'is_hidden'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'created_by_id'=>$this->session->userdata('id'),
				'created_by_name'=>$this->session->userdata('nama')
			);

			$this->rtcmodel->insertData('rtc_buku_transaksi',$dataInsertTransaksi);

			$result = returnResult('success','Buku Kas Berhasil Dibuat',1,$postBook != "" ? 0 : 1);
		} else $result = returnResult('error','Buku Kas Gagal Dibuat',1,$postBook != "" ? 0 : 1);
		echo $result;

	}

	public function default($id)
	{
		$default_lama = $this->rtcmodel->selectDataone('rtc_buku',['id_user'=>$this->session->userdata('idapp'), 'is_default'=>1])['id_buku'];
		$query = $this->rtcmodel->updateData('rtc_buku',['is_default'=>0],['id_buku'=>$default_lama]);
		$query2 = $this->rtcmodel->updateData('rtc_buku',['is_default'=>1],['id_buku'=>$id]);
		
		if($query && $query2){
			$result = returnResult('success','Buku Kas Berhasil Diperbarui',1,1);
		}else{
			$result = returnResult('error','Gagal diperbarui',1,1);
			
		}
		echo $result;

	}

	public function edit($id)
	{

		$data['page_name'] = 'List Buku Kas';
		$data['page_active'] = 'master_bukukas';
		$data['page_icon'] = 'fa fa-th-list';
		$data['rtc'] = $this->rtcmodel->selectDataone('rtc_buku',array('id_buku'=>$id));
		$this->load->view('master/bukukas/edit',$data);
		
	}

	public function update($id)
	{
		$post = $this->input->post();

		$nominal = floatval(preg_replace('/\D/', '', $post['saldo_awal']));

		$dataUpdate = array(
			'nama'=>$post['nama'],
			'saldo_awal'=>$nominal,
			'deskripsi' =>$post['deskripsi']
		);

		$dataInsertTransaksi = array(
			'nominal'=>$nominal,
		);
		$query = $this->rtcmodel->updateData('rtc_buku',$dataUpdate,['id_buku'=>$id]);
		$query2 = $this->rtcmodel->updateData('rtc_buku_transaksi',$dataInsertTransaksi,['id_buku'=>$id, 'id_kategori' => 4]);
		
		if($query && $query2){
			$result = returnResult('success','Buku Kas Berhasil Diperbarui',1,1);
		}else{
			$result = returnResult('error','Gagal diperbarui',1,1);
			
		}
		echo $result;

	}

	public function delete($id)
	{
		$this->rtcmodel->deleteData('rtc_buku',['id_buku'=>$id]);
		$this->rtcmodel->deleteData('rtc_buku_transaksi',['id_buku'=>$id]);
		$result = returnResult('success','Data deleted',1);
		echo $result;
	}

}

/* End of file Bukukas.php */
/* Location: ./application/controllers/master/Bukukas.php */