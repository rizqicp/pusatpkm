<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PHPMailer_Lib
{
    public function __construct()
    {
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load()
    {
        require_once APPPATH . 'third_party/PHPMailer/Exception.php';
        require_once APPPATH . 'third_party/PHPMailer/PHPMailer.php';
        require_once APPPATH . 'third_party/PHPMailer/SMTP.php';

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER
        $mail->isSMTP();
        $mail->Host       = 'smtp.googlemail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '1634010056@student.upnjatim.ac.id';
        $mail->Password   = 'alfairuz7294';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;
        return $mail;
    }
}
