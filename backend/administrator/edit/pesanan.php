<?php
include "verify.php";
if(isset($_POST['action'])){
    include "../../../config/db.php";
    $id     = $_POST['id'];
    $action = $_POST['action'];
    if($action=='kemas'){
        $admin  = mysqli_query($conn,"SELECT * FROM admin WHERE username='$username'");
        $a      = mysqli_fetch_assoc($admin);
        $aid    = $a['id_admin'];
        $tgl    = $_POST['tgl'];
        $ket    = $_POST['ket'];
        $nom    = $_POST['nom'];
        $update = mysqli_query($conn, "UPDATE pesanan SET id_status_pesanan='2' WHERE id_pesanan='$id'");
        $insert = mysqli_query($conn, "INSERT INTO pemasukan (id_admin,tanggal_pemasukan,rincian_pemasukan,
        nominal_pemasukan,keterangan) VALUES('$aid','$tgl','$ket','$nom','Penjualan dari website')");
        if($update&&$insert){
            header("Location:../pesanan.php?alert=success");
        }else{
            header("Location:../pesanan.php?alert=server-error");
        }
    }elseif($action=='kirim'){
        $update = mysqli_query($conn, "UPDATE pesanan SET id_status_pesanan='3' WHERE id_pesanan='$id'");
        if($update){
            header("Location:../pesanan.php?alert=success");
        }else{
            header("Location:../pesanan.php?alert=server-error");
        }
    }
}else{
    header("Location:../pesanan.php");
}
