<?php
include "verify.php";

if(isset($_POST['submit'])){
    if(!empty($_POST['nama'])&&!empty($_POST['username'])
    &&!empty($_POST['no_hp'])&&!empty($_POST['email'])
    &&!empty($_POST['norek'])&&!empty($_POST['bank'])
    &&!empty($_POST['nik'])&&!empty($_POST['tgl'])
    &&!empty($_POST['jenis_kelamin'])&&!empty($_POST['alamat'])
    &&!empty($_POST['no_rumah'])&&!empty($_POST['kota'])
    &&!empty($_POST['pass'])
    ){
        $username   = $_POST['username'];
        $email      = $_POST['email'];
        $hp         = $_POST['no_hp'];
        $nik        = $_POST['nik'];
        include "../../../config/db.php";
        $check = mysqli_query($conn,"SELECT * FROM supplier WHERE username = '$username' OR email='$email' OR no_hp='$hp' OR no_ktp='$nik'");
        if(mysqli_num_rows($check)==0){
            $nama       = $_POST['nama'];
            $norek      = $_POST['norek'];
            $bank       = $_POST['bank'];
            $jk         = $_POST['jenis_kelamin'];
            $tgl        = date('Y-m-d',strtotime($_POST['tgl']));
            $alamat     = $_POST['alamat'];
            $normh      = $_POST['no_rumah'];
            $kota       = $_POST['kota'];
            $options    = ['cost' => 10,];
            $pass       = password_hash($_POST['pass'], PASSWORD_BCRYPT, $options);
            $insert     = mysqli_query($conn,
            "INSERT INTO supplier (nama_supplier,id_jenis_kelamin,tanggal_lahir,no_jalan,nama_jalan,
            id_kota,no_ktp,no_hp,no_rekening,id_bank,email,username,password)
            VALUES ('$nama','$jk','$tgl','$normh','$alamat','$kota','$nik','$hp','$norek','$bank','$email','$username','$pass')
            ");
            if($insert){
                $last = mysqli_query($conn,"SELECT * FROM supplier ORDER BY id_supplier DESC LIMIT 1");
                $l = mysqli_fetch_assoc($last);
                $id = $l['id_supplier'];
                $stok       = mysqli_query($conn,"INSERT INTO stok_supplier (id_supplier,kuantitas,harga,keterangan) VALUES ('$id',0,0,'-')");
                if($stok){
                    header('Location:../supplier.php?alert=success');
                }
            }else{
                header('Location:../supplier.php?alert=server-error');
            }
        }else{
            header('Location:../supplier.php?alert=duplicate');
        }  
    }else{
        header('Location:../supplier.php?alert=incomplete');
    }
}else{
    header('Location:../supplier.php');
}