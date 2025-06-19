<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends RDC_Controller {

	public function index()
	{
		$lastAct = date_create($this->rtcmodel->selectWithQueryOne('select MAX(created_at) as tanggal from rtc_buku_transaksi where created_by_id = "'.$this->session->userdata('id').'"')['tanggal']);
		$data['page_name'] = 'Akun Saya';
		$data['page_active'] = 'akun';
		$data['page_sub_active'] = '';
		$data['page_icon'] = 'fa fa-user';
		$data['dataload'] = 'akun.js';
		$data['user'] = $this->rtcmodel->selectDataone('rtc_user',['id'=>$this->session->userdata('id')]);
		$data['lastAct'] = date_format($lastAct, 'd F Y, H:i:s');
		$lastPremium = $this->rtcmodel->selectDataone('rtc_pembayaran',['id_user'=>$this->session->userdata('id')]);
        $data['lastPremium'] = isset($lastPremium) ? $lastPremium['tanggal_tempo'] : null;
        $data['premium'] = $this->session->userdata('tipe');
		$this->template->view('pengaturan/akun/list',$data);
		
	}

	public function update()
	{
		$post = $this->input->post();
		$password = $this->template->matEnc($post['password']);
		$confirm_p = $this->template->matEnc($post['confirm']);
		$getuser = $this->rtcmodel->selectDataone('rtc_user',['username'=>$post['email']]);
		$username = empty($getuser) ? false : $getuser['username'] == $post['email'];
		if( $username && $post['email'] !== $this->session->userdata('username')){
			$result = returnResult('error','E-Mail sudah digunakan', 1);
		}else if( strlen($post['email']) <= 8){
			$result = returnResult('error','E-Mail harus lebih dari 8 digit', 1);
		}else{
			if($post['password'] != "" && $password !== $confirm_p) $result = returnResult('error','Confirm Password berbeda', 1);
			else {
				$this->session->set_userdata('nama', $post['nama']);
				$this->session->set_userdata('username', $post['email']);
				$dataUpdate = array(
					'nama'=>$post['nama'],
					'username'=>$post['email'],
					'telepon'=>$post['telepon'],
					'organisasi'=>$post['organisasi'],
					'alamat_1'=>$post['alamat_1'],
					'alamat_2'=>$post['alamat_2'],
					'alamat_3'=>$post['alamat_3'],
					'provinsi'=>$post['provinsi'],
					'kota'=>$post['kota'],
					'pekerjaan'=>$post['pekerjaan'],
					'penggunaan'=>$post['penggunaan']
				);
	
				if($post['password'] != ""){
					$dataUpdate['password'] = $password;
				}
	
				if($this->rtcmodel->updateData('rtc_user',$dataUpdate,['id'=>$this->session->userdata('id')])){
					$result = returnResult('success','Akun Berhasil Diperbarui', 1,1);
				}else{
					$result = returnResult('error','Akun Gagal Diperbarui', 1,1);
				}
			}
		}
		echo $result;
		
	}

}

/* End of file Akun.php */
/* Location: ./application/controllers/Akun.php */