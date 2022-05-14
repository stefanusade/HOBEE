<?php
session_start();
if(isset($_SESSION['verify'])){
    include "./config/db.php";
    include "./config/mail.php";
    $kode = rand(100000,999999);
    $email = $_SESSION['verify'];
    $subject = "Kode Verifikasi HOBEE $username";
    $body = "
    <html>
        <h1>Kode Verifikasi HOBEE</h1>
        <hr>
            <p>Berikut ini kode verifikasi akun Anda:</p>
            <h2><b>$kode</b></h2>
        <hr>
        <p>Segera masukkan kode ke dalam form verifikasi. Kode hanya berlaku untuk 3 menit.</p>
    </html>
    ";
    mail($email,$subject,$body,$headers);
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