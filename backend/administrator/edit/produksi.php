<?php
include "verify.php";

if(isset($_POST['submit'])){
    if(!empty($_POST['tgl'])&&!empty($_POST['produk'])&&!empty($_POST['berat'])){
        include "../../../config/db.php";
        $id     = $_POST['id'];
        $tgl    = $_POST['tgl'];
        $produk = $_POST['produk'];
        $berat  = $_POST['berat'];
        $update = mysqli_query($conn,"UPDATE produksi SET tanggal_produksi='$tgl'
        , id_produk='$produk', berat='$berat' WHERE id_produksi='$id'");
        if($update){
            header('Location:../produksi.php?alert=success-edit');
        }else{
            header('Location:../produksi.php?alert=server-error');
        }
    }else{
        header('Location:../produksi.php?alert=incomplete');
    }
}else{
    header('Location:../produksi.php');
}