<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PHPMailer_Library
{
    public function __construct()
    {
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load()
    {
        require_once(APPPATH."libraries/phpmailer/PHPMailerAutoload.php");
        $objMail = new PHPMailer(true);
        return $objMail;
    }
}