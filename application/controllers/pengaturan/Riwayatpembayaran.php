<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayatpembayaran extends RDC_Controller {

	public function index()
	{

		$data['page_name'] = 'Riwayat Pembayaran';
		$data['page_active'] = 'pembayaran';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-paypal';
        $data['rtc'] = $this->rtcmodel->selectWhere('v_riwayat_pembayaran',['id_user'=>$this->session->userdata('idapp'),'status'=>'Terverifikasi']);
        $data['ada_riwayat'] = $this->rtcmodel->selectjumlahWhere('v_riwayat_pembayaran',['id_user'=>$this->session->userdata('id'),'status'=>'Terverifikasi']);
      
		$this->template->view('pengaturan/riwayat_pembayaran/list',$data);
		
	}

}

/* End of file Riwayatpembayaran.php */
/* Location: ./application/controllers/Riwayatpembayaran.php */