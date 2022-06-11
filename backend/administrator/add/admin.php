<?php
include "verify.php";

if(isset($_POST['submit'])){
    if(!empty($_POST['nama'])&&!empty($_POST['username'])
    &&!empty($_POST['no_hp'])&&!empty($_POST['email'])
    &&!empty($_POST['norek'])&&!empty($_POST['bank'])
    &&!empty($_POST['jenis_kelamin'])&&!empty($_POST['alamat'])
    &&!empty($_POST['no_rumah'])&&!empty($_POST['kota'])
    &&!empty($_POST['pass'])
    ){
        $username   = $_POST['username'];
        $email      = $_POST['email'];
        $hp         = $_POST['no_hp'];
        include "../../../config/db.php";
        $check = mysqli_query($conn,"SELECT * FROM admin WHERE username = '$username' OR email='$email' OR no_hp='$hp'");
        if(mysqli_num_rows($check)==0){
            $nama       = $_POST['nama'];
            $norek      = $_POST['norek'];
            $bank       = $_POST['bank'];
            $jk         = $_POST['jenis_kelamin'];
            $alamat     = $_POST['alamat'];
            $normh      = $_POST['no_rumah'];
            $kota       = $_POST['kota'];
            $options    = ['cost' => 10,];
            $pass       = password_hash($_POST['pass'], PASSWORD_BCRYPT, $options);
            $insert     = mysqli_query($conn,
            "INSERT INTO admin (nama_admin,id_jenis_kelamin,no_jalan,nama_jalan,
            id_kota,no_hp,no_rekening,id_bank,email,username,password)
            VALUES ('$nama','$jk','$normh','$alamat','$kota','$hp','$norek','$bank','$email','$username','$pass')
            ");
            if($insert){
                header('Location:../admin.php?alert=success');
            }else{
                header('Location:../admin.php?alert=server-error');
            }
        }else{
            header('Location:../admin.php?alert=duplicate');
        }  
    }else{
        header('Location:../admin.php?alert=incomplete');
    }
}else{
    header('Location:../admin.php');
}