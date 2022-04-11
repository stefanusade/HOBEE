<?php
    include "verify.php";
    if(isset($_POST['submit'])){
        include "../../../config/db.php";
        if(!empty($_POST['nama']) && !empty($_POST['no_hp'])
        && !empty($_POST['jenis_kelamin']) && !empty($_POST['alamat'])){
            $nama = $_POST['nama'];
            $no_hp = $_POST['no_hp'];
            $norek = $_POST['norek'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $alamat = $_POST['alamat'];
            $no_rumah = $_POST['no_rumah'];
            $kota = $_POST['kota'];
            $update = mysqli_query($conn,"UPDATE supplier SET nama_supplier = '$nama', no_hp = '$no_hp', no_rekening = '$norek', 
            id_jenis_kelamin = '$jenis_kelamin', nama_jalan = '$alamat', no_jalan = '$no_rumah', id_kota='$kota' WHERE username = '$username'");
            if($update){
                header('Location:../akun.php?alert=success');
            }else{
                header('Location:../akun.php?alert=server-error');
            }
        }else{
            header('Location:../akun.php?alert=incomplete');
        }
    }else{
        header('Location:../akun.php');
    }
    