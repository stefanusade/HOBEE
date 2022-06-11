<?php
    include "verify.php";
    if(!empty($_POST['pass'])&&!empty($_POST['kpass'])){
        $pass = $_POST['pass'];
        $kpass = $_POST['kpass'];
        if($pass == $kpass){
            if(isset($_POST['submit'])){
                include "../../../config/db.php";
                if(!empty($_POST['nama']) && !empty($_POST['no_hp'])
                && !empty($_POST['jenis_kelamin']) && !empty($_POST['alamat'])){
                    $options = ['cost' => 10,];
                    $hash = password_hash($pass, PASSWORD_BCRYPT, $options);
                    $nik = $_POST['nik'];
                    $nama = $_POST['nama'];
                    $no_hp = $_POST['no_hp'];
                    $norek = $_POST['norek'];
                    $jenis_kelamin = $_POST['jenis_kelamin'];
                    $alamat = $_POST['alamat'];
                    $no_rumah = $_POST['no_rumah'];
                    $kota = $_POST['kota'];
                    $update = mysqli_query($conn,"UPDATE supplier SET nama_supplier = '$nama', no_hp = '$no_hp', no_rekening = '$norek', 
                    id_jenis_kelamin = '$jenis_kelamin', no_ktp='$nik', nama_jalan = '$alamat', no_jalan = '$no_rumah', id_kota='$kota', password='$hash' WHERE username = '$username'");
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
        }else{
            header('Location:../akun.php?alert=passnomatch');
        }
    }else{
        if(isset($_POST['submit'])){
            include "../../../config/db.php";
            if(!empty($_POST['nama']) && !empty($_POST['no_hp'])
            && !empty($_POST['jenis_kelamin']) && !empty($_POST['alamat'])){
                $nik = $_POST['nik'];
                $nama = $_POST['nama'];
                $no_hp = $_POST['no_hp'];
                $norek = $_POST['norek'];
                $jenis_kelamin = $_POST['jenis_kelamin'];
                $alamat = $_POST['alamat'];
                $no_rumah = $_POST['no_rumah'];
                $kota = $_POST['kota'];
                $update = mysqli_query($conn,"UPDATE supplier SET nama_supplier = '$nama', no_hp = '$no_hp', no_rekening = '$norek', 
                id_jenis_kelamin = '$jenis_kelamin', no_ktp='$nik', nama_jalan = '$alamat', no_jalan = '$no_rumah', id_kota='$kota' WHERE username = '$username'");
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
    }
        
    