<?php


function activeMenu($menuName,$slug)
{
    $active = '';
    if($menuName == $slug){
        $active = 'active pcoded-trigger';
    }
    return $active;
}

function activeSubMenu($menuName,$slug)
{
    $active = '';
    if($menuName == $slug){
        $active = 'active';
    }
    return $active;
}



function generateSecret()
{
    $numbers = str_split((string)(int)microtime(true));
    shuffle($numbers);
    $rand = 'nex';
    foreach (array_rand($numbers, 8) as $k) $rand .= $numbers[$k];
    return $rand;
}

function returnResult($status,$text,$reload=0,$modalclose=0,$delete=0,$title="",$icon="")
{
    $result['status'] = $status;
    $result['text'] = $text;
    $result['reload'] = $reload;
    $result['modalclose'] = $modalclose;
    $result['delete'] = $delete;
    $result['title'] = $title;
    $result['icon'] = $icon;

    return json_encode($result);
}

function generateAtribut($profilename,$attr,$op,$value){
    $data = array(
        'groupname' =>cleanStr($profilename),
        'attribute' =>$attr,
        'op'=>$op,
        'value'=>$value
    );

    return $data;
}

function generate_radusergroup($username,$profilename,$priority){
    $data = array(
        'username' =>$username,
        'groupname' =>cleanStr($profilename),
        'priority'=>$priority,
    );

    return $data;
}

function konversikeDetik($val,$satuan){
    if($satuan == 'HARI'){
        $detik = strtotime($val.' day', 0);
    }else if($satuan == 'JAM'){
        $detik = strtotime($val.' hour', 0);
    }else if($satuan == 'MENIT'){
        $detik = strtotime($val.' minute', 0);
    }


    return $detik;
}


function generateRandom($len){
    $len = $len * 2;
    $s = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $len);
    return $s;
}

function cleanStr($str)
{
    $label = str_replace(' ', '_', $str);
    return $label;
}


function returnValidate($status,$text,$html)
{
    $result['status'] = $status;
    $result['text'] = $text;
    $result['html'] = $html;

    return json_encode($result);
}

function cleanInt($str){
    if($str == ''){
        $str = 0;
    }
    $int = floatval(preg_replace('/\D/', '', $str));
    return $int;
}

function tgl_indo($tanggal){
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function returnResultAw($status,$text,$reloadTable=0,$modalclose=0)
{
    $result['status'] = $status;
    $result['text'] = $text;
    $result['reloadTable'] = $reloadTable;
    $result['modalclose'] = $modalclose;

    return json_encode($result);
}











// PROGRAMMER : RAHMAT HIDAYAT
/* End of file RDC_helper.php */
/* Location: ./application/helpers/RDC_helper.php */