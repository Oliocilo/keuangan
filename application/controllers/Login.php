<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends RDC_Controller {

	function __construct() {
		parent::__construct();

	}

	public function index()
	{
		if($this->session->userdata('registered')) {
			redirect('register');
		}
		$data['page_name'] = 'Login DuitQu';
		$data['page_active'] = 'Login';
		$this->template->nologin('login/login',$data);
	}

	public function processLogin()
	{
		$post = $this->input->post();
		$username = $post['username'];
		$password = $this->template->matEnc($post['password']);
		$getuser = $this->rtcmodel->selectDataOne('v_user',['username'=>$username,'password'=>$password]);
		if($getuser){
			if($this->rtcmodel->selectDataOne('rtc_buku',['id_user'=>$getuser['idapp']]))
				$this->session->set_userdata('session_rtc', true);
			else $this->session->set_userdata('registered', true);
			$this->session->set_userdata('id', $getuser['id']);
			$this->session->set_userdata('idapp', $getuser['idapp']);
			$this->session->set_userdata('username', $getuser['username']);
			$this->session->set_userdata('nama', $getuser['nama']);
			$this->session->set_userdata('tipe', $getuser['tipe']);
			$this->session->set_userdata('role_id', $getuser['role_id']);
			$this->session->set_userdata('role_name', $getuser['role_name']);
			if($getuser['role_id'] == 9999){
				$this->session->set_userdata('session_rtc', true);
				$this->session->unset_userdata('registered');
			}

			if($getuser['role_id'] == 9998){
				$this->session->set_userdata('session_rtc', true);
				$this->session->set_userdata('session_rtc_web', true);
				$this->session->unset_userdata('registered');
			}

			$result = returnResult('success','Login Sukses , Mengalihkan...', 1);
			
		}else{
			$result = returnResult('error','Username atau Password Salah', 1);
			
		}

		echo $result;
	}

	public function register()
	{
		if($this->session->userdata('registered')) $view = 'bukukas_add';
		else $view = 'register';
		$data['page_name'] = 'Register DuitQu';
		$data['page_active'] = 'Register';
		$this->template->nologin('login/'.$view,$data);
	}

	public function processRegister()
	{
		$post = $this->input->post();
		$username = $post['new_username'];
		$password = $this->template->matEnc($post['new_password']);
		$confirm_p = $this->template->matEnc($post['repeat_password']);
		$getuser = $this->rtcmodel->selectDataOne('rtc_user',['username'=>$username]);
		if($getuser){
			$result = returnValidate('error','E-Mail sudah digunakan', 'E-Mail sudah digunakan');
		}else{
			if($password !== $confirm_p) $result = returnResult('error','Ulangi Password berbeda', 1);
			else if($this->validateRegister()){
				$dataInsert = array(
					'username'=>$post['new_username'],
					'nama'=>$post['nama'],
					'password'=>$this->template->matEnc($post['new_password']),
					'type'=> 0,
					'role_id'=> 1,
					'role_name'=>'Superadmin',
					'status'=> 1,
					'created_at'=>date('Y-m-d H:i:s')
				);
				if($this->rtcmodel->insertData('rtc_user',$dataInsert)){
					$id_insert = $this->db->insert_id();
					$getuser = $this->rtcmodel->selectDataOne('v_user',['id'=>$id_insert]);
					$this->session->set_userdata('registered', true);
					$this->session->set_userdata('id', $getuser['id']);
					$this->session->set_userdata('idapp', $getuser['idapp']);
					$this->session->set_userdata('username', $getuser['username']);
					$this->session->set_userdata('nama', $getuser['nama']);
					$this->session->set_userdata('tipe', $getuser['tipe']);
					$this->session->set_userdata('role_id', $getuser['role_id']);
					$this->session->set_userdata('role_name', $getuser['role_name']);
					$this->rtcmodel->updateData('rtc_user',['created_by'=>$id_insert],['id'=>$id_insert]);
	
					$result = returnResult('success','Akun Berhasil Dibuat', 1,1);
				}else{
					$result = returnResult('error','Data Akun gagal dimasukkan', 1);
				}
			} 
		}

		echo $result;
	}
	
	function validateRegister(){
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('nama', '<strong>Nama</strong>', 'required');
		$this->form_validation->set_rules('new_username', '<strong>E-Mail</strong>', 'required');
		$this->form_validation->set_rules('new_password', '<strong>Password</strong>', 'required');
		$this->form_validation->set_rules('repeat_password', '<strong>Ulangi Password</strong>', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$result = returnValidate('error','Data Akun gagal dimasukkan', validation_errors());
			echo $result;
			return false;
		}else{
			return true;
		}
	}

	public function processBukukas()
	{
		if($this->validateBuku()){
			$this->session->set_userdata('session_rtc', true);
			$post = $this->input->post();
			$id_kt = [1,1,2,2];
			for($i=0; $i<4; $i++){
				if($i===1 || $i===3){
					$dataInsert = array(
						'id_user'=>$this->session->userdata('idapp'),
						'nama_kategori'=>$post['kategori'][$i],
						'id_tipe_transaksi'=>$id_kt[$i]
					);
					$this->rtcmodel->insertData('rtc_kategori',$dataInsert);
				}
			}

			$this->session->set_flashdata('postBook',$post);
			redirect('master/bukukas/store');
		}
	}
	
	function validateBuku(){
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('nama', '<strong>Nama</strong>', 'required');
		$this->form_validation->set_rules('deskripsi', '<strong>Deskripsi</strong>', 'required');
		$this->form_validation->set_rules('saldo_awal', '<strong>Saldo Awal</strong>', 'required');
		// $this->form_validation->set_rules('kategori[0]', '<strong>Kategori Pemasukan 1</strong>', 'required');
		$this->form_validation->set_rules('kategori[1]', '<strong>Kategori Pemasukan 2</strong>', 'required');
		// $this->form_validation->set_rules('kategori[2]', '<strong>Kategori Pengeluaran 1</strong>', 'required');
		$this->form_validation->set_rules('kategori[3]', '<strong>Kategori Pengeluaran 2</strong>', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$result = returnValidate('error','Buku Kas gagal dibuat', validation_errors());
			echo $result;
			return false;
		}else{
			return true;
		}
	}

	public function reset()
	{
		$data['page_name'] = 'Reset DuitQu';
		$data['page_active'] = 'Login';
		$this->template->nologin('login/reset',$data);
	}

	public function processReset()
	{
		$post = $this->input->post();
		$generateToken = md5(rand());
		$username = $post['email'];
		
		if($this->rtcmodel->updateData('rtc_user',['token'=>$generateToken],['username'=>$username])){
			$getuseradmin = $this->rtcmodel->selectDataOne('rtc_user',['token'=>$generateToken]);
			$password = $this->template->matDec($getuseradmin['password']);

			$subjek = 'Password Information For Login Duitqu'; 

			$body = '<table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
			<tr>
			<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
			<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
			<div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

			<span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">This is preheader text. Some clients will show this text as a preview.</span>
			<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">

			<tr>
			<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
			<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
			<tr>
			<td style="font-family: sans-serif; font-size: 14px; vertical-align: middle;">
			<p style="font-family: sans-serif; font-size: 16px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Dear  <b>'.$getuseradmin['nama'].'</b> </p>
			<br>
			Password Anda adalah <b>'.$password.'</b><p>
			<br>
			<br>
			</td>
			</tr>
			</table>
			</td>
			</tr>
			</table> ';

			$emailSend = $this->rtcKirimEmail('rekayasatechs@gmail.com',$username,$subjek,$body,$post);
			$result = returnResult('success','Send Email Successful', 1,1);
			
		}else{
			$result = returnResult('error','Your Email is wrong', 1);
			
		}

		echo $result;
	}

	public function logout()
	{
        $this->session->sess_destroy();
		redirect(base_url());
	}


}

/* End of file Login.php */
/* Location: ./application/controllers/admin/Login.php */