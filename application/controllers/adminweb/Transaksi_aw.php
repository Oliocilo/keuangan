<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_aw extends RDC_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['page_name'] = 'Transaksi';
		$data['page_active'] = 'transaksi';
		$data['page_sub_active'] = 'transaksi';
		$data['dataloadweb'] = 'transaksi.js';
		$this->template->admin('adminweb/transaksi/list',$data);
	}

	public function jsonData()
	{
		$post = $this->input->post();
		header('Content-Type: application/json');
		$this->datatables->select('id,id_user,tipe,nama,username,tanggal_daftar,harga,kode_unik,status,konfirmasi_pembayaran');
		if($post['status'] != ''){
			
			if($post['status'] == 'Pending'){
			$this->datatables->where_in('status',['Pending','Verifikasi Pembayaran']);
			}else{
			$this->datatables->where('status',$post['status']);	
			}
			
		}

		if($post['pembayaran'] != ''){
			$this->datatables->where('status',$post['pembayaran']);
		}

		$this->datatables->from('v_riwayat_pembayaran');
		$this->datatables->add_column('view', '<button data-toggle="tooltip" data-placement="top" title="Edit" data-id="$1" data-name="Paket Premium" class="btn btn-secondary btn-xs konfPemBtn" data-route="premium" > Proses <i class="fa fa-arrow-right"></i></button>', 'id');
		echo $this->datatables->generate();
	}

	public function konf_pembayaran($id)
	{
		$data['rtcdata'] = $this->rtcmodel->selectDataone('v_riwayat_pembayaran',['id'=>$id]);
		$this->load->view('adminweb/transaksi/konf_pembayaran',$data);
	}

	public function prosesPremium()
	{
		$post = $this->input->post();
		$dataUpdate = array(
			'status' => 'Terverifikasi',
			'tanggal_tempo' => date('Y-m-d', strtotime($post['tgl_exp']))
		);
		$this->db->update('rtc_pembayaran',$dataUpdate,['id'=>$post['id']]);
		$detail = $this->rtcmodel->selectDataone('rtc_pembayaran',['id'=>$post['id']]);
		$this->db->update('rtc_user',['type'=>1],['id'=>$detail['id_user']]);
		$result = returnResultAw('success','Pengguna Berhasil Diupgrade',1,1);
		echo $result;
	}

}

/* End of file Transaksi_aw.php */
/* Location: ./application/controllers/adminweb/Transaksi_aw.php */