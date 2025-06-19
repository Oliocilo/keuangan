<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sysfunction extends RDC_Controller {

	public function index()
	{

		$data['page_name'] = 'Sys Functions';
		$data['page_active'] = 'sysfunction';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-home';
		$this->db->select('a.name,b.name as parentname,a.kode');
		$this->db->join('sys_function b','a.parent = b.id','INNER');
		$sysfunctionParent = $this->rtcmodel->selectWhere('sys_function a',['a.parent !='=>0]);
		$data['sysfunction'] = $sysfunctionParent;
		$data['dataloaddev'] = 'confdev.js';
		$data['roles'] = $this->rtcmodel->selectData('rtc_role');
		$this->template->matdev('sysconf/sysfunction/index',$data);
		
	}

	public function setAccess()
	{
		if($this->session->userdata('role_id') == 9999){
			$post = $this->input->post();
			$dataInsert = array(
				'kode_function' => $post['function_id'],
				'role_id'=>$post['role_id']
			);
			$this->db->delete('sys_access',$dataInsert);
			if($post['type'] == 'checked'){
				$res = $this->rtcmodel->insertData('sys_access',$dataInsert);
			}
			$result = returnResult('success','Access Berhasil Dibuat');
		}else{
			$result = returnResult('error','Access Gagal Dibuat', 1);
		}
		echo $result;
	}

}

/* End of file Sysfunction.php */
/* Location: ./application/controllers/sysconf/Sysfunction.php */