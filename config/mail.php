<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("phpmailer/src/Exception.php"); 
include("phpmailer/src/PHPMailer.php");
include("phpmailer/src/SMTP.php");

$mail = new PHPMailer;

$mail->isSMTP();                                   
$mail->Host = "mail.example.com"; // mail host
$mail->SMTPAuth = true;                            
$mail->Username = "user@example.com"; // mail username auth                 
$mail->Password = "pass";                           
$mail->SMTPSecure = "ssl";                           
$mail->Port = 465;                                   
$mail->From = "info@hobee.com";
$mail->FromName = "HOBEE";