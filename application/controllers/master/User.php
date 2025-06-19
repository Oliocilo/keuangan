<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends RDC_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['page_name'] = 'Daftar Pengguna';
		$data['page_active'] = 'master_user';
		$data['page_icon'] = 'fa fa-users';
		$data['dataload'] = 'user.js';
		$this->template->view('master/user/list',$data);
	}

	public function jsonData()
	{
		header('Content-Type: application/json');
		$this->datatables->select('id,username,nama,role_name');
		$this->datatables->where('parent_id',$this->session->userdata('id'));
		$this->datatables->from('rtc_user');
		$this->datatables->add_column('view', '
			<button data-toggle="tooltip" data-placement="top" title="Edit" data-id="$1" class="btn btn-secondary btn-xs edit">
				<i class="fa fa-edit"></i>
			</button>
			<button class="btn btn-danger btn-xs btndelete" data-id="$1" data-url="'.base_url('master/user/delete/$1').'">
				<i class="fa fa-trash"></i>
			</button>', 'id');
		echo $this->datatables->generate();
	}

	public function add()
	{

		$data['page_name'] = 'Daftar Pengguna';
		$data['page_active'] = 'master_user';
		$data['page_icon'] = 'fa fa-users';
		$this->db->where('id >',1);
		$data['roles'] = $this->rtcmodel->selectData('rtc_role');
		$this->load->view('master/user/add',$data);
		
	}

	function validate($add = true){
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('email', '<strong>Email</strong>', 'required');
		$this->form_validation->set_rules('nama', '<strong>Nama</strong>', 'required');
		if($add) $this->form_validation->set_rules('password', '<strong>Password</strong>', 'required');
		$this->form_validation->set_rules('role', '<strong>Role</strong>', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$result = returnValidate('error','Pengguna Gagal Ditambahkan', validation_errors());
			echo $result;
			return false;
		}else{
			return true;
		}
	}

	public function store()
	{
		if($this->validate()){
			$post = $this->input->post();
			$role = $this->rtcmodel->selectDataone('rtc_role',['id'=>$post['role']]);
			$dataInsert = array(
				'parent_id' => $this->session->userdata('id'),
				'username'=>$post['email'],
				'nama'=>$post['nama'],
				'password'=> $this->template->matEnc($post['password']),
				'role_id'=>$post['role'],
				'role_name'=>$role['role_name'],
				'type'=>1,
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'created_by'=> $this->session->userdata('id')
			);
			if($this->rtcmodel->insertData('rtc_user',$dataInsert)){
				$result = returnResult('success','Pengguna Berhasil Dibuat', 1,1);
			}else{
				$result = returnResult('error','Pengguna Gagal Dibuat', 1);
			}
			echo $result;
		}
	}

	public function edit($id)
	{

		$data['page_name'] = 'Daftar Pengguna';
		$data['page_active'] = 'master_user';
		$data['page_icon'] = 'fa fa-users';
		$this->db->where('id >',1);
		$data['roles'] = $this->rtcmodel->selectData('rtc_role');
		$data['v_user'] = $this->rtcmodel->selectDataone('v_user',['id'=>$id]);
		$this->load->view('master/user/edit',$data);
		
	}

	public function update($id)
	{
		if($this->validate(false)){
			$post = $this->input->post();
			$role = $this->rtcmodel->selectDataone('rtc_role',['id'=>$post['role']]);
			$dataUpdate = array(
				'parent_id' => $this->session->userdata('id'),
				'username'=>$post['email'],
				'nama'=>$post['nama'],
				'role_id'=>$post['role'],
				'role_name'=>$role['role_name'],
				'updated_at'=>date('Y-m-d H:i:s'),
				'updated_by'=> $this->session->userdata('id')
			);
			if($post['password'] != ""){
				$dataUpdate['password'] = $this->template->matEnc($post['password']);
			}
			if($this->rtcmodel->updateData('rtc_user',$dataUpdate,['id'=>$id])){
				$result = returnResult('success','Pengguna Berhasil Diperbarui', 1,1);
			}else{
				$result = returnResult('error','Pengguna Gagal Diperbarui', 1);
			}
			echo $result;
		}
	}

	public function delete($id)
	{
		$this->rtcmodel->deleteData('rtc_user',['id'=>$id]);
		$result = returnResult('success','Data deleted',1);
		echo $result;
	}

}

/* End of file User.php */
/* Location: ./application/controllers/master/User.php */