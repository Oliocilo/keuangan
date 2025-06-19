<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Premium_aw extends RDC_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['page_name'] = 'Paket Premium';
		$data['page_active'] = 'premium';
		$data['page_sub_active'] = 'premium';
		$data['dataloadweb'] = 'premium.js';
		$this->template->admin('adminweb/premium/list',$data);
	}

	public function jsonData()
	{
		header('Content-Type: application/json');
		$this->datatables->select('id,value,satuan,harga');
		$this->datatables->from('rtc_web_paket_premium');
		$this->datatables->add_column('view', '<button data-toggle="tooltip" data-placement="top" title="Edit" data-id="$1" data-name="Paket Premium" class="btn btn-secondary btn-xs editBtnaw" data-route="premium" > <i class="fa fa-edit"></i></button> <button class="btn btn-danger btn-xs btndeleteaw" data-id="$1" data-url="'.base_url('conf/premium/delete').'"> <i class="fa fa-trash"></i></button>', 'id');
		echo $this->datatables->generate();
	}

	public function add()
	{
		$data['page_name'] = 'Paket Premium';
		$this->load->view('adminweb/premium/add',$data);
	}

	public function store()
	{
		$post = $this->input->post();
		$post['harga'] = preg_replace('/[^\d]+/', '', $post['harga']);
		$dataInsert = array(
			'value' => $post['durasi'],
			'satuan'=>$post['satuan'],
			'harga' => $post['harga']
		);
		$this->db->insert('rtc_web_paket_premium',$dataInsert);
		$result = returnResultAw('success','Paket Premium Berhasil Ditambahkan',1,1);
		echo $result;
	}


	public function edit($id)
	{
		$data['page_name'] = 'Paket Premium';
		$data['rtcdata'] = $this->rtcmodel->selectDataOne('rtc_web_paket_premium',['id'=>$id]);
		$this->load->view('adminweb/premium/edit',$data);
	}


	public function update()
	{
		$post = $this->input->post();
		$post['harga'] = preg_replace('/[^\d]+/', '', $post['harga']);
		$dataInsert = array(
			'value' => $post['durasi'],
			'satuan'=>$post['satuan'],
			'harga' => $post['harga']
		);
		$this->rtcmodel->updateData('rtc_web_paket_premium',$dataInsert,['id'=>$post['id']]);
		$result = returnResultAw('success','Paket Premium Berhasil Diupdate',1,1);
		echo $result;
	}

		public function delete()
	{
		$post = $this->input->post();
		$id = $post['id'];
		$this->db->delete('rtc_web_paket_premium',['id'=>$id]);
		$result = returnResultAw('success','Data deleted',1,0);
		echo $result;
	}

}

/* End of file Premium_aw.php */
/* Location: ./application/controllers/adminweb/Premium_aw.php */