<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utangpiutang extends RDC_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('session_rtc') == "") redirect('login');
	}

	public function index($type)
	{
		$idUser = $this->session->userdata('id');
		//$detail = $this->rtcmodel->selectDataone('v_utang',['id_user'=>$idUser, 'tipe'=>$type]);
		$data['page_name'] = 'Buku '.$type;
		$data['page_active'] = 'UtangPiutang';
		$data['page_sub_active'] = $type;
		$data['page_icon'] = 'fa fa-th-list';
		$data['dataload'] = 'utangPiutang.js';
		$data['namaBulan'] = $this->template->namaBulanIndo();
		$data['tipe']  = $type;
		$data['total_saldo'] = $this->getTotalUtangPiutang($type,13);
		$this->template->view('utangPiutang/index',$data);
	}

	public function jsonData($type, $id_buku_transaksi = 0)
	{
		if($type == "Utang") $url = "debt";
		else $url = "credit";
		header('Content-Type: application/json');
		$this->datatables->select('status,tipe_saldo,id_utang,id_buku_transaksi,tanggal_awal,tanggal_akhir,tanggal_tempo,klien,saldo_awal,saldo,saldo_akhir,deskripsi,tanggal_perbarui');
		$this->datatables->where('tipe',$type);
		$this->datatables->where('view',null);
		if($this->input->post('bulan') !== "Semua Bulan"){
			$this->datatables->where('MONTH(tanggal_awal)',$this->input->post('bulan'));
		}
		$this->datatables->where('YEAR(tanggal_awal)',$this->input->post('tahun'));
		$this->datatables->where('id_user',$this->session->userdata('idapp'));
		$this->datatables->from('v_utang');
		$this->datatables->add_column('view', '
			<button type="button" onclick="location.href=\''.base_url($url.'/id/$1').'\'" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Informasi Detail">
				<i class="fa fa-info-circle fa-1x"></i>
			</button>
			<button type="button" class="btn btn-secondary btn-xs" onclick="editForm(\''.$type.'\',$1)" data-toggle="tooltip" data-placement="top" title="Ubah '.$type.'">
				<i class="fa fa-edit fa-1x"></i>
			</button>
			<button type="button" class="btn btn-danger btn-xs" onclick="deleteAlert(\''.base_url($url.'/delete/$1/$2').'\')" data-toggle="tooltip" data-placement="top" title="Hapus '.$type.'">
				<i class="fa fa-trash fa-1x"></i>
			</button>', 'id_utang,id_buku_transaksi');
			$this->datatables->add_column('view_berisi', '
				<button type="button" onclick="location.href=\''.base_url($url.'/id/$1').'\'" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Informasi Detail">
					<i class="fa fa-info-circle fa-1x"></i>
				</button>
				<button type="button" class="btn btn-danger btn-xs" onclick="deleteAlert(\''.base_url($url.'/delete/$1/$2').'\')" data-toggle="tooltip" data-placement="top" title="Hapus '.$type.'">
					<i class="fa fa-trash fa-1x"></i>
				</button>', 'id_utang,id_buku_transaksi');
		echo $this->datatables->generate();
	}

	public function add($type)
	{
		$data['page_name'] = 'List '.$type;
		$data['page_active'] = 'UtangPiutang';
		$data['page_sub_active'] = $type;
		$data['page_icon'] = 'fa fa-th-list';
		$data['type'] = $type;
		$data['jenis'] = $type == 'Utang' ? 'Pemasukan' : 'Pengeluaran';
		$data['buku'] = $this->rtcmodel->selectWhere('rtc_buku', ['id_user'=>$this->session->userdata('idapp')]);
		$data['kategori'] = $this->rtcmodel->selectWhere('rtc_kategori',['id_user'=>$this->session->userdata('idapp'), 'id_tipe_transaksi'=> $type == "Utang" ? 1 : 2]);
		$this->load->view('utangPiutang/add',$data);
	}

	public function store($type)
	{
		if($this->validate(true)){
			$post = $this->input->post();
			$tanggal_tempo = isset($post['jatuh_tempo']) ? date('Y-m-d',strtotime($post['tanggal_tempo'])).' '.$post['jam_tempo'].':00' : null;
			$tipe_nominal = $type == 'Utang' ? 1 : (-1);

			$dataInsert = array(
				'id_user'=> $this->session->userdata('idapp'),
				'status'=> $type,
				'tipe'=> $type,
				'tanggal_tempo'=> $tanggal_tempo,
				'klien'=> $post['klien'],
			);
			$query = $this->rtcmodel->insertData('rtc_utang_piutang',$dataInsert);

			$dataInsertDetail = array(
				'id_utang_piutang' => $this->db->insert_id(),
				'id_tipe_transaksi' => $type == "Utang" ? 1 : 2,
				'tanggal'=> date('Y-m-d',strtotime($post['tanggal'])).' '.$post['jam'].':00',
				'nominal'=> floatval(preg_replace('/\D/', '', $post['nominal']))*$tipe_nominal,
				'deskripsi'=> $post['keterangan'],
			);
			$query2 = $this->rtcmodel->insertData('rtc_transaksi_utang_piutang',$dataInsertDetail);
			
			if($query && $query2){
				$result = returnResult('success','Penambahan '.$type.' Berhasil Disimpan', 1,1);
			}else{
				$result = returnResult('error','Penambahan '.$type.' Gagal Disimpan', 1,1);
			}

			if(isset($post['catat'])){
				$pesan_catat = $type == "Utang" ? $type." kepada ".$post['klien'] : $type." untuk ".$post['klien'];
				$pesan_catat = $post['keterangan'] != "" ? $pesan_catat.": ".$post['keterangan'] : $pesan_catat;
				$post['keterangan'] = $pesan_catat;
				$this->session->set_flashdata('postBook',$post);
				$this->session->set_flashdata('id_transaksi_utang',$this->db->insert_id());
				$this->session->set_flashdata('postResult',$result);
				redirect('book/store');
			} else echo $result;
		}
	}

	public function edit($id, $type)
	{
		$dataEdit = $this->rtcmodel->selectDataone('v_utang',['id_utang'=>$id]);
		if($dataEdit['id_buku_transaksi'] != null)
			$dataBT = $this->rtcmodel->selectDataone('rtc_buku_transaksi',['id'=>$dataEdit['id_buku_transaksi']]);
		else $dataBT = ['id_buku'=>'','id_kategori'=>''];
		$data['page_name'] = 'List '.$type;
		$data['page_active'] = 'UtangPiutang';
		$data['page_sub_active'] = $type;
		$data['page_icon'] = 'fa fa-th-list';
		$data['jenis'] = $type == 'Utang' ? 'Pemasukan' : 'Pengeluaran';
		$data['dataEdit'] = $dataEdit;
		$data['id_buku'] = $dataBT['id_buku'];
		$data['id_kategori'] = $dataBT['id_kategori'];
		$data['buku'] = $this->rtcmodel->selectWhere('rtc_buku',['id_user'=>$this->session->userdata('idapp')]);
		$data['kategori'] = $this->rtcmodel->selectWhere('rtc_kategori',['id_user'=>$this->session->userdata('idapp'), 'id_tipe_transaksi'=> $dataEdit['id_tipe_transaksi']]);
		$this->load->view('utangPiutang/edit',$data);
	}

	public function update($id)
	{
		if($this->validate(true)){
			$post = $this->input->post();
			$tanggal_tempo = isset($post['jatuh_tempo']) ? date('Y-m-d',strtotime($post['tanggal_tempo'])).' '.$post['jam_tempo'].':00' : null;
			$tipe_nominal = $post['tipenya'] == 'Utang' ? 1 : (-1);
			$nominal = floatval(preg_replace('/\D/', '', $post['nominal']))*$tipe_nominal;
			$id_buku_transaksi = isset($post['id_buku_transaksi']) ? $post['id_buku_transaksi'] : '';
			$ada_buku = $this->rtcmodel->selectDataone('rtc_buku_transaksi',['id'=>$id_buku_transaksi]) != [];
			$buku_null = (!$ada_buku && isset($post['catat'])) || !(isset($post['catat']));
			
			$dataInsert = array(
				'tanggal_tempo'=> $tanggal_tempo,
				'klien'=> $post['klien'],
			);
			$query = $this->rtcmodel->updateData('rtc_utang_piutang',$dataInsert,['id_utang_piutang'=>$id]);

			$dataInsertDetail = array(
				'id_buku_transaksi'=> $buku_null  ? null : $id_buku_transaksi,
				'tanggal'=> date('Y-m-d',strtotime($post['tanggal'])).' '.$post['jam'].':00',
				'nominal'=> $nominal,
				'deskripsi'=> $post['keterangan'],
			);
			$query2 = $this->rtcmodel->updateData('rtc_transaksi_utang_piutang',$dataInsertDetail,['id'=>$post['id_transaksi']]);
			
			if($query && $query2){
				$result = returnResult('success','Data '.$post['tipenya'].' Berhasil Diperbarui', 1,1);
			}else{
				$result = returnResult('error','Data '.$post['tipenya'].' Gagal Diperbarui', 1,1);
			}

			if(isset($post['catat'])){
				$pesan_catat = $post['tipenya'] == "Utang" ? $post['tipenya']." kepada ".$post['klien'] : $post['tipenya']." untuk ".$post['klien'];
				$pesan_catat = $post['keterangan'] != "" ? $pesan_catat.": ".$post['keterangan'] : $pesan_catat;
				$post['keterangan'] = $pesan_catat;
				if($ada_buku){
					$dataUpdateBuku = array(
						'id_buku' => $this->template->matDec($post['id_buku']),
						'id_kategori'=>$post['kategori'],
						'tanggal'=>date('Y-m-d',strtotime($post['tanggal'])).' '.$post['jam'].':00',
						'nominal'=>$nominal,
						'deskripsi'=>$post['keterangan'],
					);
					$this->rtcmodel->updateData('rtc_buku_transaksi',$dataUpdateBuku,['id'=>$id_buku_transaksi]);
				} else {
					$this->session->set_flashdata('postBook',$post);
					$this->session->set_flashdata('id_transaksi_utang',$post['id_transaksi']);
					$this->session->set_flashdata('postResult',$result);
					redirect('book/store');
				}
			} else $this->rtcmodel->deleteData('rtc_buku_transaksi',['id'=>$id_buku_transaksi]);
			echo $result;
		}
	}
	
	function validate($non_detail = false){
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('tanggal', '<strong>Tanggal</strong>', 'required');
		$this->form_validation->set_rules('jam', '<strong>Jam</strong>', 'required');
		$this->form_validation->set_rules('jatuh_tempo', '<strong> Tanggal Tempo / Jam Tempo </strong>', 'callback_validateTempo[jatuh_tempo]');
		if($non_detail) $this->form_validation->set_rules('klien', '<strong>Klien</strong>', 'required');
		$this->form_validation->set_rules('nominal', '<strong>Nominal</strong>', 'required');
		//$this->form_validation->set_rules('keterangan', '<strong>Keterangan</strong>', 'required');
		$this->form_validation->set_rules('catat', '<strong> Nama Buku / Kategori </strong>', 'callback_validateCatat[catat]');

		if ($this->form_validation->run() == FALSE)
		{
			$result = returnValidate('error','Buku Kas gagal dibuat', validation_errors());
			echo $result;
			return false;
		}else{
			return true;
		}
	}
	
	function validateTempo($jatuh){
		if($jatuh){
			if($this->input->post('tanggal_tempo') == "" && $this->input->post('jam_tempo') == ""){
				$this->form_validation->set_message('validateTempo', 'Bagian <strong>{field}</strong> wajib diisi.');
				return false;
			} else if($this->input->post('tanggal_tempo') == ""){
				$this->form_validation->set_message('validateTempo', 'Bagian <strong>Tanggal Tempo</strong> wajib diisi.');
				return false;
			} else if($this->input->post('jam_tempo') == ""){
				$this->form_validation->set_message('validateTempo', 'Bagian <strong>Jam Tempo</strong> wajib diisi.');
				return false;
			} else return true;
		} else return true;
	}
	
	function validateCatat($catat){
		if($catat){
			if($this->input->post('id_buku') == "" && $this->input->post('kategori') == ""){
				$this->form_validation->set_message('validateCatat', 'Bagian <strong>{field}</strong> wajib diisi.');
				return false;
			} else if($this->input->post('id_buku') == ""){
				$this->form_validation->set_message('validateCatat', 'Bagian <strong>Nama Buku</strong> wajib diisi.');
				return false;
			} else if($this->input->post('kategori') == ""){
				$this->form_validation->set_message('validateCatat', 'Bagian <strong>Kategori</strong> wajib diisi.');
				return false;
			} else return true;
		} else return true;
	}

	public function delete($id, $id_buku_transaksi = "")
	{
		$this->rtcmodel->deleteData('rtc_utang_piutang',['id_utang_piutang'=>$id]);
		$this->rtcmodel->deleteData('rtc_transaksi_utang_piutang',['id_utang_piutang'=>$id]);
		if($id_buku_transaksi != "")
			$this->rtcmodel->deleteData('rtc_buku_transaksi',['id'=>$id_buku_transaksi]);
		$result = returnResult('success','Data deleted',1);
		echo $result;
	}

	public function details($id)
	{
		$details = $this->rtcmodel->selectWhere('v_utang',['id_utang'=>$id]);
		$detail = $details[0];
		$data['dataload'] = 'detailUtangPiutang.js';
		$data['deskripsi'] = $detail['deskripsi'];
		$data['idnya']  = $id;
		$data['idbuku']  = $detail['id_buku_transaksi'];
		$data['namaBulan'] = $this->template->namaBulanIndo();
		$data['page_name'] = $detail['tipe'].' kepada '.$detail['klien'];
		$data['page_active'] = 'UtangPiutang';
		$data['page_sub_active'] = $detail['tipe'];
		$data['page_icon'] = 'fa fa-th-list';
		$data['tipe']  = $detail['tipe'];
		$data['saldo_awal'] = $detail['saldo_awal'];
		$data['saldo_akhir'] = $detail['saldo_akhir'];
		$data['total_saldo'] = $this->getTotalUtangPiutang($detail['tipe'],13);
		$this->template->view('utangPiutang/detail',$data);
	}

	public function jsonDataDetails($id, $type)
	{
		if($type == "Utang") $url = "debt";
		else $url = "credit";
		header('Content-Type: application/json');
		$this->datatables->select('tipe,tipe_saldo,id,id_utang,id_buku_transaksi,id_tipe_transaksi,tanggal_awal,tanggal_perbarui,tanggal_tempo,klien,saldo_awal,nominal,saldo,saldo_akhir,deskripsi');
		$this->datatables->where('id_utang',$id);
		$this->datatables->from('v_utang');
		$this->datatables->add_column('view', '
			<button type="button" class="btn btn-secondary btn-xs" onclick="editForm(\''.$type.'\',$1,$3)" data-toggle="tooltip" data-placement="top" title="Ubah '.$type.'">
				<i class="fa fa-edit fa-1x"></i>
			</button>
			<button type="button" class="btn btn-danger btn-xs" onclick="deleteAlert(\''.base_url($url.'/detail/delete/$1/$2').'\')" data-toggle="tooltip" data-placement="top" title="Hapus '.$type.'">
				<i class="fa fa-trash fa-1x"></i>
			</button>', 'id, id_buku_transaksi,id_tipe_transaksi');
		echo $this->datatables->generate();
	}

	public function addDetail($id, $type, $jenis)
	{
		$kt = ($type == "Utang" && $jenis == "Tambah") || ($type == "Piutang" && $jenis == "Bayar");
		$data['page_name'] = 'List '.$type;
		$data['page_active'] = 'UtangPiutang';
		$data['page_sub_active'] = $type;
		$data['page_icon'] = 'fa fa-th-list';
		$data['idnya']  = $id;
		$v_utang = $this->rtcmodel->selectDataone('v_utang',['id_utang'=>$id]);
		$data['saldo_akhir'] = $jenis == "Bayar" ? $v_utang['saldo_akhir'] : 9999999999999;
		$data['tanggal_awal'] = $v_utang['tanggal_awal'];
		$data['klien'] = $v_utang['klien'];
		$data['type'] = $type;
		$data['jenis'] = $kt ? 'Pemasukan' : 'Pengeluaran';
		$data['jenis_tambah'] = $jenis;
		$data['buku'] = $this->rtcmodel->selectWhere('rtc_buku',['id_user'=>$this->session->userdata('idapp')]);
		$data['kategori'] = $this->rtcmodel->selectWhere('rtc_kategori',['id_user'=>$this->session->userdata('idapp'), 'id_tipe_transaksi'=> $kt ? 1 : 2]);
		$this->load->view('utangPiutang/detail_add',$data);
	}

	public function storeDetail($id)
	{
		if($this->validate()){
			$post = $this->input->post();
			$pesan = $post['jenis'] == "Bayar" ? "Pembayaran ".$post['tipenya'] : "Penambahan  ".$post['tipenya'];
			//$kt = Pemasukan = 1
			$kt = ($post['tipenya'] == "Utang" && $post['jenis'] == "Tambah") || ($post['tipenya'] == "Piutang" && $post['jenis'] == "Bayar");
			$tipe_nominal = $kt ? 1 : (-1);

			$dataInsert = array(
				'id_utang_piutang'=> $id,
				'id_tipe_transaksi' => $kt ? 1 : 2,
				'tanggal'=> date('Y-m-d',strtotime($post['tanggal'])).' '.$post['jam'].':00',
				'nominal'=> floatval(preg_replace('/\D/', '', $post['nominal']))*$tipe_nominal,
				'deskripsi'=> $post['keterangan'],
			);
			
			if($this->rtcmodel->insertData('rtc_transaksi_utang_piutang',$dataInsert)){
				$result = returnResult('success', $pesan.' Berhasil Disimpan', 1,1);
			}else{
				$result = returnResult('error', $pesan.' Gagal Disimpan', 1);
			}

			if(isset($post['catat'])){
				$pesan_catat = $post['tipenya'] == "Utang" ? $post['tipenya']." kepada ".$post['klien'] : $post['tipenya']." untuk ".$post['klien'];
				$pesan_catat = $post['keterangan'] != "" ? $pesan_catat.": ".$post['keterangan'] : $pesan_catat;
				$post['keterangan'] = $pesan_catat;
				$this->session->set_flashdata('postBook',$post);
				$this->session->set_flashdata('id_transaksi_utang',$this->db->insert_id());
				$this->session->set_flashdata('postResult',$result);
				redirect('book/store');
			} else echo $result;
		}
	}

	public function editDetail($id, $type)
	{
		$dataEdit = $this->rtcmodel->selectDataone('v_utang',['id'=>$id]);
		if($dataEdit['id_buku_transaksi'] != null)
			$dataBT = $this->rtcmodel->selectDataone('rtc_buku_transaksi',['id'=>$dataEdit['id_buku_transaksi']]);
		else $dataBT = ['id_buku'=>'','id_kategori'=>'','id_tipe_transaksi'=>''];
		$kt = ($dataEdit['tipe'] == "Utang" && $dataEdit['id_tipe_transaksi'] == 1) || ($dataEdit['tipe'] == "Piutang" && $dataEdit['id_tipe_transaksi'] == 2);
		$data['page_name'] = 'List '.$type;
		$data['page_active'] = 'UtangPiutang';
		$data['page_sub_active'] = $type;
		$data['page_icon'] = 'fa fa-th-list';
		$data['jenis'] = $kt ? 'Pemasukan' : 'Pengeluaran';
		$data['dataEdit'] = $dataEdit;
		$data['id_buku'] = $dataBT['id_buku'];
		$data['id_kategori'] = $dataBT['id_kategori'];
		$data['buku'] = $this->rtcmodel->selectWhere('rtc_buku',['id_user'=>$this->session->userdata('idapp')]);
		$data['kategori'] = $this->rtcmodel->selectWhere('rtc_kategori',['id_user'=>$this->session->userdata('idapp'), 'id_tipe_transaksi'=> $kt ? 1 : 2]);
		$this->load->view('utangPiutang/detail_edit',$data);
	}

	public function updateDetail($id)
	{
		if($this->validate()){
			$post = $this->input->post();
			$kt = ($post['tipenya'] == "Utang" && $post['tipe'] == 2) || ($post['tipenya'] == "Piutang" && $post['tipe'] == 1);
			$tipe_nominal = $kt ? 1 : (-1);
			$nominal = floatval(preg_replace('/\D/', '', $post['nominal']))*$tipe_nominal;
			$id_buku_transaksi = isset($post['id_buku_transaksi']) ? $post['id_buku_transaksi'] : '';
			$ada_buku = $this->rtcmodel->selectDataone('rtc_buku_transaksi',['id'=>$id_buku_transaksi]) != [];
			$buku_null = (!$ada_buku && isset($post['catat'])) || !(isset($post['catat']));

			$dataInsertDetail = array(
				'id_buku_transaksi'=> $buku_null  ? null : $id_buku_transaksi,
				'tanggal'=> date('Y-m-d',strtotime($post['tanggal'])).' '.$post['jam'].':00',
				'nominal'=> $nominal,
				'deskripsi'=> $post['keterangan'],
			);
			
			if($this->rtcmodel->updateData('rtc_transaksi_utang_piutang',$dataInsertDetail,['id'=>$id])){
				$result = returnResult('success','Data '.$post['tipenya'].' Berhasil Diperbarui', 1,1);
			}else{
				$result = returnResult('error','Data '.$post['tipenya'].' Gagal Diperbarui', 1,1);
			}

			if(isset($post['catat'])){
				$pesan_catat = $post['tipenya'] == "Utang" ? $post['tipenya']." kepada ".$post['klien'] : $post['tipenya']." untuk ".$post['klien'];
				$pesan_catat = $post['keterangan'] != "" ? $pesan_catat.": ".$post['keterangan'] : $pesan_catat;
				$post['keterangan'] = $pesan_catat;
				if($ada_buku){
					$dataUpdateBuku = array(
						'id_buku' => $this->template->matDec($post['id_buku']),
						'id_kategori'=>$post['kategori'],
						'tanggal'=>date('Y-m-d',strtotime($post['tanggal'])).' '.$post['jam'].':00',
						'nominal'=>$nominal,
						'deskripsi'=>$post['keterangan'],
					);
					$this->rtcmodel->updateData('rtc_buku_transaksi',$dataUpdateBuku,['id'=>$id_buku_transaksi]);
				} else {
					$this->session->set_flashdata('postBook',$post);
					$this->session->set_flashdata('id_transaksi_utang',$post['id_transaksi']);
					$this->session->set_flashdata('postResult',$result);
					redirect('book/store');
				}
			} else $this->rtcmodel->deleteData('rtc_buku_transaksi',['id'=>$id_buku_transaksi]);
			echo $result;
		}
	}

	public function deleteDetail($id, $id_buku_transaksi = "")
	{
		$this->rtcmodel->deleteData('rtc_transaksi_utang_piutang',['id'=>$id]);
		if($id_buku_transaksi != "") 
			$this->rtcmodel->deleteData('rtc_buku_transaksi',['id'=>$id_buku_transaksi]);
		$result = returnResult('success','Detail data deleted ',1);
		echo $result;
	}



	

}

// PROGRAMMER : RAHMAT HIDAYAT
/* End of file voucher.php */
/* Location: ./application/controllers/voucher.php */