<?php
include "verify.php";

if(isset($_POST['submit'])){
    if(!empty($_POST['tgl'])&&!empty($_POST['produk'])&&!empty($_POST['berat'])){
        include "../../../config/db.php";
        $id     = $_POST['id'];
        $tgl    = $_POST['tgl'];
        $produk = $_POST['produk'];
        $berat  = $_POST['berat'];
        $insert = mysqli_query($conn,"INSERT INTO produksi (id_admin,tanggal_produksi,id_produk,berat) 
        VALUES ('$id','$tgl','$produk','$berat')");
        if($insert){
            header('Location:../produksi.php?alert=success');
        }else{
            header('Location:../produksi.php?alert=server-error');
        }
    }else{
        header('Location:../produksi.php?alert=incomplete');
    }
}else{
    header('Location:../produksi.php');
}