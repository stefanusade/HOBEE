<?php
include "verify.php";
if(isset($_POST['submit'])){
    if(!empty($_POST['tgl'])&&!empty($_POST['rincian'])&&!empty($_POST['nominal'])){
        include "../../../config/db.php";
        $id         = $_POST['id'];
        $tgl        = $_POST['tgl'];
        $rincian    = $_POST['rincian'];
        $nominal    = $_POST['nominal'];
        $keterangan = trim($_POST['keterangan']);
        $update     = mysqli_query($conn,"UPDATE pemasukan SET tanggal_pemasukan='$tgl'
        ,rincian_pemasukan='$rincian',nominal_pemasukan='$nominal' WHERE id_pemasukan='$id'");
        if($update){
            header('Location:../pemasukan.php?alert=success-edit');
        }else{
            header('Location:../pemasukan.php?alert=server-error');
        }
    }else{
        header('Location:../pemasukan.php?alert=incomplete');
    }
}else{
    header('Location:../pemasukan.php');
}