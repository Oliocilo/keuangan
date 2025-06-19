<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Premium extends RDC_Controller {

	public function index()
	{

		$data['page_name'] = 'Premium';
		$data['page_active'] = 'premium';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-star';
		$data['premium'] = AKUN_PREMIUM;
		if(AKUN_PREMIUM == 1){
			$CEK = $this->rtcmodel->selectDataone('v_riwayat_pembayaran',['id_user'=>$this->session->userdata('id'),'status !='=>'Batal','tipe'=>'Perpanjangan']);
		}else{
			$CEK = $this->rtcmodel->selectDataone('v_riwayat_pembayaran',['id_user'=>$this->session->userdata('id'),'status !='=>'Batal','tipe'=>'Upgrade']);
		}

		if(isset($CEK) && $CEK['status'] == 'Pending'){
			$data['rtc'] = $CEK;
			$data['bank'] = $this->rtcmodel->selectData('rtc_web_rekening');
			$data['dataload'] = 'pembayaran.js';
			$this->template->view('pengaturan/premium/pembayaran',$data);
		}else if(isset($CEK) && $CEK['status'] == 'Verifikasi Pembayaran'){
			$data['rtc'] = $CEK;
			$this->template->view('pengaturan/premium/konfirmasi',$data);
		}else{
			$data['rtc'] = $this->rtcmodel->selectData('rtc_web_paket_premium');
			$this->template->view('pengaturan/premium/list',$data);
		}

		
		
	}

	public function buy($id)
	{
		$id = $this->template->matDec($id);
		$data['page_name'] = 'Premium';
		$data['page_active'] = 'premium';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-star';
		$data['rtc'] = $this->rtcmodel->selectDataone('rtc_web_paket_premium',['id'=>$id]);
        $data['premium'] = $this->session->userdata('tipe');
		$this->template->view('pengaturan/premium/buy',$data);
		
	}

	public function pembayaran()
	{
		$post = $this->input->post();
		if(AKUN_PREMIUM == 1){
			$tipe = 'Perpanjangan';
		}else{
			$tipe = 'Upgrade';
		}

		$digits = 2;
		$kodeunik =  rand(pow(10, $digits-1), pow(10, $digits)-1);

		$dataArray = array(
			'id_user' => $this->session->userdata('id'),
			'tanggal_daftar' => date('Y-m-d H:i:s'),
			'id_premium' => $post['id_premium'],
			'tipe' => $tipe,
			'status' => 'Pending',
			'kode_unik' =>$kodeunik
		);
		$this->rtcmodel->insertData('rtc_pembayaran',$dataArray);
		redirect('premium','refresh');
		
	}

	public function batal()
	{
		$post = $this->input->post();
		$id = $this->template->matDec($post['id']);
		$CEK = $this->rtcmodel->selectDataone('v_riwayat_pembayaran',['id'=>$id,'id_user'=>$this->session->userdata('id'),'status'=>'Pending']);
		if($CEK){
			$this->rtcmodel->updateData('rtc_pembayaran',['status'=>'Batal'],['id'=>$id]);
			$result = returnResult('success','Pembelian Dibatalkan',1);
			
		}else{
			$result = returnResult('error','Anomali Ditemukan',1);
		
		}

		echo $result;
	}


	function validate(){
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('tanggal_transfer', '<strong>Tanggal Transfer</strong>', 'required');
		$this->form_validation->set_rules('nominal', '<strong>Nominal Transfer</strong>', 'required');
		$this->form_validation->set_rules('nama_bank', '<strong>Nama Bank</strong>', 'required');
		$this->form_validation->set_rules('nama_rekening', '<strong>Nama Pemilik Rekening</strong>', 'required');
		$this->form_validation->set_rules('rekening_tujuan', '<strong>Rekening Duitqu</strong>', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$result = returnValidate('error','Konfirmasi Pembayaran Gagal', validation_errors());
			echo $result;
			return false;
		}else{
			return true;
		}
	}

	public function konfirmPayment()
	{
		if($this->validate()){
		$post = $this->input->post();
		$id = $this->template->matDec($post['id']);
		$dataUpdate = array(
			'tanggal_bayar' => $post['tanggal_transfer'],
			'tf_nominal'=> $post['nominal'],
			'tf_dari_bank' => $post['nama_bank'],
			'tf_dari_nama' => $post['nama_rekening'],
			'id_akun_bayar' =>$post['rekening_tujuan'],
			'status' => 'Verifikasi Pembayaran'
		);
		$this->rtcmodel->updateData('rtc_pembayaran',$dataUpdate,['id'=>$id]);
		$result = returnResult('success','Pembayaran Sedang Diverifikasi',1);
		echo $result;
		}
	}

}

/* End of file Premium.php */
/* Location: ./application/controllers/Premium.php */