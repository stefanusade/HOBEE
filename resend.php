<?php
session_start();
if(isset($_SESSION['verify'])){
    include "./config/db.php";
    include "./config/mail.php";
    $kode = rand(100000,999999);
    $email = $_SESSION['verify'];
    $mail->addAddress($email);
    $mail->isHTML(true);                                  
    $mail->Subject = "Kode Verifikasi HOBEE";
    $mail->Body    = "
                        <h1>Kode Verifikasi HOBEE</h1>
                        <hr>
                        Berikut ini kode verifikasi akun Anda:
                        <h2><b>$kode</b></h2>
                        <hr>
                        Segera masukkan kode ke dalam form verifikasi. Kode hanya berlaku untuk 3 menit.
                    ";
    $mail->send();
    $plus3m = date('Y-m-d H:i:s',strtotime('+3mins'));
    $verify = mysqli_query($conn,"INSERT INTO verifikasi_user 
    (email,kode,waktu) VALUES ('$email','$kode','$plus3m')");
    if($verify){
        header("Location:verify.php");
    }else{
         header("Location:verify.php?alert=server-error");
    } 
}else{
    header("Location:login.php");
}