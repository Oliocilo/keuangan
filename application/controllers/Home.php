<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends RDC_Controller {

	public function index()
	{

		$data['page_name'] = 'Dashboard';
		$data['page_active'] = 'dashboard';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-home';
		$data['dataload'] = 'dashboard.js';
		if($this->session->userdata('id') !== null){
			$data['totalPemasukan'] = $this->getTotalKeluarMasuk("Pemasukan");
			$data['totalPengeluaran'] = $this->getTotalKeluarMasuk("Pengeluaran")*(-1);
			$data['totalKas'] = $this->getTotalSaldo();
			$data['totalPengguna'] = $this->rtcmodel->selectjumlahWhere('rtc_user',['parent_id'=> $this->session->userdata('idapp')]);
			$data['utang'] = $this->rtcmodel->selectWhere('v_utang',['id_user'=>$this->session->userdata('idapp'),'tipe'=> "Utang", 'view'=> null, 'tanggal_tempo !='=> null]);
		}
		$this->template->view('dashboard',$data);
		
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */