<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template {

    protected $CI;

    public function __construct()
    {	
        $this->CI =& get_instance();
    }


  public function view($content, $data = NULL)
  {   
    $data['bukuKasList'] = $this->CI->db->get_where('rtc_buku',['id_user'=>$this->CI->session->userdata('idapp')])->result_array();
    $menuList = [];
    $menuAll = $this->CI->db->get_where('rtc_menu',[])->result_array();
    foreach ($menuAll as $key => $val) {
        $ceked = true;
        if($val['related_function'] != ''){
            $ceked = $this->checkAccessed($val['related_function']);
        }

        if($ceked == true){
            if($val['type'] == 'parent'){
                $menuList[$val['separator_id']]['parent'][$val['id']] = $val;

                if($val['slug'] == 'book'){
                    foreach ($data['bukuKasList'] as $key => $bklmn) {
                     $menuList[$val['separator_id']]['parent'][$val['id']]['sub'][$bklmn['id_buku']]['menu'] = $bklmn['nama'];
                     $menuList[$val['separator_id']]['parent'][$val['id']]['sub'][$bklmn['id_buku']]['slug'] = $bklmn['id_buku']; 
                     $menuList[$val['separator_id']]['parent'][$val['id']]['sub'][$bklmn['id_buku']]['link'] = 'book/id/'.$this->matEnc($bklmn['id_buku']); 
                 }

             }
         }
         if($val['type'] == 'sub'){
            $menuList[$val['separator_id']]['parent'][$val['parent_id']]['sub'][$val['id']] = $val;
        }
        if($val['type'] == 'separator'){
            $menuList[$val['id']] = $val;
        }
        }
    }

    $data['menuList'] = $menuList;

    $data['headpanel'] = $this->CI->load->view('template/head_panel', $data, TRUE);
    $data['sidemenu'] = $this->CI->load->view('template/side_menu', $data, TRUE);
    $data['content'] = $this->CI->load->view($content, $data, TRUE);
    $this->CI->load->view('template/template', $data);
}

public function nologin($content, $data = NULL)
{   
    
    $data['content'] = $this->CI->load->view($content, $data, TRUE);
    $this->CI->load->view('template/template_nologin', $data);
}


public function print($content, $data = NULL)
{   
    
    $data['content'] = $this->CI->load->view($content, $data, TRUE);
    $this->CI->load->view('template/template_print', $data);
}


function matEnc( $string) {
    $secret_key = "mamat";
    $secret_iv = "mamatgans";
    
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
    
    $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    
    return preg_replace('/[^A-Za-z0-9() -]/', '', $output);
}

function matDec( $string) {
        // you may change these values to your own
    $secret_key = "mamat";
    $secret_iv = "mamatgans";
    
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
    
    $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    
    
    return $output;
}

public function namaBulanIndo()
{
    $arrNamaBulan = array("01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember");
    return $arrNamaBulan;
}

function getNameFromNumber($num) {
    $numeric = $num % 26;
    $letter = chr(65 + $numeric);
    $num2 = intval($num / 26);
    if ($num2 > 0) {
        return $this->getNameFromNumber($num2 - 1) . $letter;
    } else {
        return $letter;
    }
}

    public function matdev($content, $data = NULL)
    {   
        $data['headpanel'] = $this->CI->load->view('template/head_panel', $data, TRUE);
        $data['sidemenu'] = $this->CI->load->view('template/side_menu_dev', $data, TRUE);
        $data['content'] = $this->CI->load->view($content, $data, TRUE);
        $this->CI->load->view('template/template', $data);
    }

    public function checkAccessed($kode,$role='')
    {
        if($role == ''){
            $role = $this->CI->session->userdata('role_id');
        }
        if($this->CI->session->userdata('id')){
            $getAccess = $this->CI->rtcmodel->selectWhere('sys_access',['kode_function'=>$kode,'role_id'=>$role]);
            if(!empty($getAccess)){
                return true;
            }else{
                return false;
            }

        }else{
            return false;
        }
    }

    public function admin($content, $data = NULL)
    {   
        $data['headpanel'] = $this->CI->load->view('template/head_panel_web', $data, TRUE);
        $data['sidemenu'] = $this->CI->load->view('template/side_menu_web', $data, TRUE);
        $data['content'] = $this->CI->load->view($content, $data, TRUE);
        $this->CI->load->view('template/template_web', $data);
    }






}