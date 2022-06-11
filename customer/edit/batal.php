<?php
include "../add/verify.php";
if(isset($_POST['submit'])){
    if(!empty($_POST['id'])||!empty($_POST['batal'])){
        include "../../config/db.php";
        include "../../config/mail.php";
        $id = $_POST['id'];
        $batal = $_POST['batal'];
        $update = mysqli_query($conn,"UPDATE pesanan 
        SET id_status_pembatalan='$batal',id_status_pesanan=5,vis='0' WHERE id_pesanan='$id'");
        if($update){
            $subject = "Pembatalan Pesanan HOBEE #$ref";
                $body = "
                    <h1>Konfirmasi Pesanan HOBEE</h1>
                    <hr>
                    <p>Notifikasi Pembatalan Pesanan oleh pelanggan</p>
                    <p>Alasan: $batal</p>
                        ";
            mail($cust_email,$subject,$body,$headers);
            header("Location:../index.php?alert=success-cancel");
        }else{
            header("Location:../index.php?alert=server-error");
        }
    }else{
        header("Location:../index.php#order");
    }
}else{
    header("Location:../index.php#order");
}