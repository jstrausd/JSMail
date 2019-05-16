<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

header("Access-Control-Allow-Origin: *");

$recipient = $_POST["recipient"];
$recipient_name = $_POST["recipient_name"];
$sender_mail = $_POST["sender_mail"];
$sender_name = $_POST["sender_name"];
$sender_password = $_POST["sender_password"];
$sender_smtp = $_POST["sender_smtp"];
$sender_smtp_port = $_POST["sender_smtp_port"];
$message = $_POST["message"];
$subject = $_POST["subject"];

try{
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $sender_smtp;                           // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $sender_mail;                       // SMTP username
        $mail->Password = $sender_password;                   // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $sender_smtp_port;                      // TCP port to connect to
    
        $mail->setFrom($sender_mail, $sender_name);
    
        //Content
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->addAddress($recipient,$recipient_name);   
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}catch(Exception $e){
    echo "error";
}


?>