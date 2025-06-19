<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_dev extends RDC_Controller {

	public function index()
	{

		$data['page_name'] = 'Dashboard';
		$data['page_active'] = 'dashboard';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-home';
		$data['dataloaddev'] = 'confdev.js';
		$this->template->matdev('sysconf/dashboard',$data);
		
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */