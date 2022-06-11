<?php
include "verify.php"; 
if(isset($_POST['submit'])){
    if(!empty($_POST['id'])&&!empty($_POST['tgl'])){
        include "../../../config/db.php";
        $id = $_POST['id'];
        $tgl = $_POST['tgl'];
        $update = mysqli_query($conn,"UPDATE permintaan_stok SET tanggal_kirim='$tgl' WHERE id_permintaan='$id'");
        if($update){
            header('Location:../permintaan.php?alert=success-edit');
        }else{
            header('Location:../permintaan.php?alert=server-error');
        }
    }else{
        header('Location:../permintaan.php?alert=incomplete');
    }
}else{
    header('Location:../permintaan.php');
}