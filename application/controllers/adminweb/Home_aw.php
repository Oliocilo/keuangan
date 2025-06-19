<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_aw extends RDC_Controller {


	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		$data['page_name'] = 'Dashboard';
		$data['page_active'] = 'dashboard';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-home';
		$this->template->admin('adminweb/dashboard',$data);
		
	}

}

/* End of file Home_aw.php */
/* Location: ./application/controllers/adminweb/Home_aw.php */