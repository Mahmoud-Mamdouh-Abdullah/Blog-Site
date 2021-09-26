<?php
require_once('./config.php');

ob_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require BASE_PATH . '/mail/Exception.php';
require BASE_PATH . '/mail/PHPMailer.php';
require BASE_PATH . '/mail/SMTP.php';

if (session_status() != PHP_SESSION_ACTIVE || session_status() == PHP_SESSION_DISABLED) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('Location:' . BASE_URL . 'login.php');
    die();
}


if (
    validate($_REQUEST['txtName'])
    && validate($_REQUEST['txtEmail'])
    && validate($_REQUEST['txtSubject'])
    && validate($_REQUEST['txtMsg'])
) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 1;                   //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'yourmail@gmail.com';                     //SMTP username
        $mail->Password   = 'your password';                               //SMTP password
        $mail->SMTPSecure = 'tls';           //Enable implicit TLS encryption
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('yourmail@gmail.com', 'MMA for Softwate Solutions');
        $mail->addAddress($_REQUEST['txtEmail'], $_REQUEST['txtName']);     //Add a recipient


        //Content
        $mail->Subject = $_REQUEST['txtSubject'];
        $mail->Body    = $_REQUEST['txtMsg'];

        $mail->send();
        echo 'Message has been sent';
        header('Location:' . BASE_URL . 'contact.php');
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    header('Location:' . BASE_URL . 'contact.php');
}

function validate($req)
{
    if (isset($req) && strlen($req) > 0) {
        return true;
    }
    return false;
}
