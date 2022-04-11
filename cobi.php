<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("config/phpmailer/src/Exception.php"); 
include("config/phpmailer/src/PHPMailer.php");
include("config/phpmailer/src/SMTP.php");

$mail = new PHPMailer;

$mail->isSMTP();                                   
$mail->Host = "mail.stefanusade.web.id";
$mail->SMTPAuth = true;                            
$mail->Username = "kuliah@stefanusade.web.id";                 
$mail->Password = "89TeaterJKT48";                           
$mail->SMTPSecure = "ssl";                           
$mail->Port = 465;                                   
$mail->From = "info@hobee.com";
$mail->FromName = "HOBEE";
$mail->addAddress('stefanus.adesetiawan@gmail.com', 'Aku');
$mail->isHTML(true);                                  
$mail->Subject = "Kode Verifikasi HOBEE aku";
$mail->Body    = "
                    <h1>Kode Verifikasi HOBEE</h1>
                    <hr>
                    Berikut ini kode verifikasi akun Anda:
                    <h2><b>123456</b></h2>
                    <hr>
                    Segera masukkan kode ke dalam form verifikasi. Kode hanya berlaku untuk 3 menit.
";
$mail->send();