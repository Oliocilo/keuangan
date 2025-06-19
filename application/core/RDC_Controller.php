<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
abstract class RDC_Controller extends CI_Controller{
	public function __construct() {
		parent::__construct();
        $this->core = & get_instance();
        date_default_timezone_set("Asia/Jakarta");
        $this->check_access();
        $this->cekUserPremium();
    }

    public function cekUserPremium()
    {
       $user = $this->core->rtcmodel->selectDataone('rtc_user',['id'=>$this->session->userdata('idapp')]);
       if(!empty($user) && $user['type'] == 1){
        define('AKUN_PREMIUM', $user['type']);
       }
    }

    function check_access()
    {
        $controller = $this->router->class;
        $method = $this->router->method;
        $params = $this->uri->segment_array();
        $funcWithAccess = $this->core->rtcmodel->selectDataone('sys_function',['controller'=>$controller,'method'=>$method]);
        if(isset($funcWithAccess)){
            if($funcWithAccess['uri_segment'] != 'F'){
                $funcUri = explode(',', $funcWithAccess['uri_segment']);
                $funcUriMat = array_combine(range(1, count($funcUri)), $funcUri);
            }else{
                $params = [];
                $funcUriMat = [];
            }
            if($this->template->checkAccessed($funcWithAccess['kode']) == 0){
                if ($controller == $funcWithAccess['controller'] &&    $params == $funcUriMat) {
                    redirect('accessdenied');
                }
            }
        }
    }

	function getSaldoPeriode($idbuku=0, $periode, $bulan = 0, $tahun = 0)
    {
		$bulan = $bulan == 0 ? date('m') : $bulan;
		$tahun = $tahun == 0 ? date('Y') : $tahun;
		$this->core->db->select('SUM(nominal_ori) as total_saldo');
		if($idbuku===0) $this->core->db->where('id_user', $this->core->session->userdata('idapp')); 
        else $this->core->db->where('id_buku', $idbuku);
		
        if(strlen($bulan) <= 2){
            if($periode == "Awal"){
                $this->core->db->where('tanggal <', $tahun."-".$bulan."-1");
            }else if($periode == "Akhir"){
                $this->core->db->where('tanggal <=', date_format(date_create($tahun."-".$bulan."-1"), 'Y-m-t'));
            }
        } else {
            if($periode == "Awal") $this->core->db->where('tanggal <', date_format(date_create($bulan), 'Y-m-d'));
            else if($periode == "Akhir") $this->core->db->where('tanggal <=', date_format(date_create($tahun), 'Y-m-d'));
        }
		$data =  $this->core->rtcmodel->selectData('v_buku_transaksi')[0];
		return $data['total_saldo'];
	}

    function getSaldoAkhir($idbuku)
    {
        $data = [];
        $transaksiBuku = $this->core->rtcmodel->selectWhere('rtc_buku_transaksi',['id_buku'=>$idbuku]);
        foreach ($transaksiBuku as $key => $val) {
            $saldoAkhir = $this->core->db->query("SELECT calculate_previous_sum('".$val['tanggal']."',".$val['id_buku'].") as saldo_akhir")->row_array();
            $data[$val['id']] = "Rp. ".number_format($saldoAkhir['saldo_akhir'] + $val['nominal'], 0, ',', '.');
        }
        return json_encode($data);
    }

    function getTotalSaldo($bulan = 0, $tahun = 0)
    {
		$bulan = $bulan == 0 ? 13 : $bulan;
		$tahun = $tahun == 0 ? 13 : $tahun;
        $saldoAkhir = $this->core->db->query("SELECT totalsaldokas(".$this->core->session->userdata('id').",".$bulan.",'".$tahun."') as total_saldo")->row_array();
        return $saldoAkhir['total_saldo'];
    }

    function getAsetBulanan($id_aset, $masa, $tipe)
    {
        $saldoAkhir = $this->core->db->query("SELECT aset_per_bulan(".$id_aset.",".$masa.",'".$tipe."') as nilai")->row_array();
        return $saldoAkhir['nilai'];
    }

    function getTotalKeluarMasuk($tipe)
    {
        $saldoAkhir = $this->core->db->query("SELECT totalkas_keluar_masuk(".$this->core->session->userdata('id').",'".$tipe."') as total_saldo")->row_array();
        return $saldoAkhir['total_saldo'];
    }

    function getTotalUtangPiutang($val, $bulan = 0, $tahun = 0)
    {
		$bulan = $bulan == 0 ? 13 : $bulan;
		$tahun = $tahun == 0 ? 13 : $tahun;
        $saldoAkhir = $this->core->db->query("SELECT totalsaldo_utangpiutang(".$this->core->session->userdata('id').",'".$val."',".$bulan.",'".$tahun."') as total_saldo")->row_array();
        return $saldoAkhir['total_saldo'];
    }

    public function mat_ekspor($judul,$alldata,$header,$isival)
    {
   
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()
        ->setCreator('Rahmat Hidayat')
        ->setLastModifiedBy('Rahmat Hidayat')
        ->setTitle($judul)
        ->setSubject($judul)
        ->setDescription($judul)
        ->setKeywords($judul);
        $style_col = array(
            'font' => array('bold' => true), 
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER 
            ),
            'borders' => array(
                'top' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), 
                'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  
                'bottom' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), 
                'left' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) 
            ),
            'fill' => array(
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => array('argb' => 'DDDDDD')
            ),
        );
        $style_row = array(
            'alignment' => array(
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER 
            ),
            'borders' => array(
                'top' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), 
                'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  
                'bottom' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), 
                'left' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) 
            )
        );
        $style_row2 = array(
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER 
            ),
            'borders' => array(
                'top' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), 
                'right' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  
                'bottom' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), 
                'left' => array('borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) 
            )
        );

        $urut = 0;
        foreach ($header as $stt) {
            $abjad = $this->template->getNameFromNumber($urut);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue($abjad.'1', $stt); 
            $urut++;
        }
        $urut = 0;
        foreach ($header as $stt) {
            $abjad = $this->template->getNameFromNumber($urut);
            $spreadsheet->getActiveSheet()->getStyle($abjad.'1')->applyFromArray($style_col);
            $urut++;
        }
        $no = 1; 
        $numrow = 2; 
        foreach($alldata as $dt){

            $urut = 0;
            foreach ($isival as $stt) {
                $abjad = $this->template->getNameFromNumber($urut);
                $spreadsheet->setActiveSheetIndex(0)->setCellValueExplicit($abjad.$numrow,  $dt[$stt],(is_numeric($dt[$stt]) ? \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING : \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING ) );
                $urut++;
            }
            $urut = 0;
            foreach ($header as $stt) {
                $abjad = $this->template->getNameFromNumber($urut);
                $spreadsheet->getActiveSheet()->getStyle($abjad.$numrow)->applyFromArray($style_row);
                $urut++;
            }
            $no++; 
            $numrow++; 
        }

        $urut = 0;
        foreach ($header as $stt) {
            $abjad = $this->template->getNameFromNumber($urut);
            $spreadsheet->getActiveSheet()->getColumnDimension($abjad)->setAutoSize(TRUE); 
            $urut++;
        }
        
        $spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        $spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $spreadsheet->getActiveSheet(0)->setTitle($judul);
        $spreadsheet->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$judul.'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        ob_end_clean();
        $writer->save('php://output');
        exit();
    }

    public function upload_file($files)
    {
        $dir  = "uploads/";
        $config['upload_path']          = $dir;
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']           = md5('rekayasatechsolutions').rand(1000,100000);
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload($files)){
            $msg['response'] = false;
            $msg['message'] = $this->upload->display_errors();
        }else{
            $file = $this->upload->data();
            $data = array(
                'name'=> $file['file_name'],
                'mime'=> $file['file_type'],                                
                'dir'=> $dir.$file['file_name'],
            );
            $msg['response'] = true;
            $msg['message'] = $data;
        }
        return $msg;
    }

	public function rtcKirimEmail($from,$to,$subject,$message,$post=null)
    {
    	// $smtpconfig = json_decode(smtp_config,true);
    	$mail = $this->phpmailer_library->load();
    	$mail->SMTPDebug = 0;                             
    	$mail->isSMTP();                                    
    	$mail->Host = 'smtp.gmail.com';  
    	$mail->SMTPAuth = true;
    	$mail->SMTPAutoTLS = false;       
    	$mail->Username = 'rekayasatechs@gmail.com';               
    	$mail->Password = '081rekayasa752';                         
    	$mail->SMTPSecure = 'ssl';                    
    	$mail->Port = '465';
    	$mail->CharSet = 'utf-8';
    	$mail->isHTML(true);
    	$mail->setFrom($post['name']);
    	$mail->AddAddress($post['name']);   
    	$mail->ClearReplyTos();
    	if($post != null){
    	$mail->addReplyTo($from, $post['name']);
    	}
    	$mail->Subject = $subject;
    	$mail->Body    = $message;
    	// $mail->addCustomHeader('In-Reply-To', '<62f8a06a3fb7b0afcddf8d411fd65c4e@localhost>');
    	// $mail->addCustomHeader('References', '<62f8a06a3fb7b0afcddf8d411fd65c4e@localhost>');
    	if($mail->send())
    	{
    		return $mail;
    	}
    	else
    	{
    		return false;
    	}
    }










}