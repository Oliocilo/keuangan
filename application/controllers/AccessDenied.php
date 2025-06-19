<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccessDenied extends CI_Controller {

	public function index() {
		$data['page_name'] = 'Access Denied';
		$data['page_active'] = 'access_denied';
		$this->template->view('access_denied',$data); 
	}

}

/* End of file AccessDenied.php */
/* Location: ./application/controllers/AccessDenied.php */