<?php
session_start();
if(isset($_SESSION['login'])&&$_SESSION['role']==3){
    $username = $_SESSION['username'];
    if(isset($_POST['submit'])){
        include "../../config/db.php";
        if(!empty($_POST['nama']) && !empty($_POST['no_hp'])
        && !empty($_POST['jenis_kelamin']) && !empty($_POST['alamat'])){
            $nama = $_POST['nama'];
            $uname = $_POST['username'];
            $no_hp = $_POST['no_hp'];
            $nik = $_POST['nik'];
            $norek = $_POST['norek'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $tgl_lahir = date('Y-m-d',strtotime($_POST['tgl_lahir']));
            $alamat = $_POST['alamat'];
            $no_rumah = $_POST['no_rumah'];
            $kota = $_POST['kota'];
            $update = mysqli_query($conn,"UPDATE customer SET nama_customer = '$nama', username = '$uname', no_hp = '$no_hp', no_ktp = '$nik', no_rekening = '$norek', 
            id_jenis_kelamin = '$jenis_kelamin', tanggal_lahir = '$tgl_lahir', nama_jalan = '$alamat', no_jalan = '$no_rumah', id_kota='$kota' WHERE username = '$username'");
            $_SESSION['username'] = $uname;
            $_SESSION['login'] = TRUE;
            $_SESSION['role'] = 3;
            if($update){
                header('Location:../index.php?alert=success');
            }else{
                header('Location:../index.php?alert=server-error');
            }
        }else{
            header('Location:../index.php?alert=incomplete');
        }
    }else{
        header('Location:../index.php');
    }
}else{
    header('Location:../../logout.php');
}
    