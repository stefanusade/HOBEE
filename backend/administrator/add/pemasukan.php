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
        $insert     = mysqli_query($conn,"INSERT INTO pemasukan 
        (id_admin,tanggal_pemasukan,rincian_pemasukan,nominal_pemasukan,keterangan) 
        VALUES ('$id','$tgl','$rincian','$nominal','$keterangan')");
        if($insert){
            header('Location:../pemasukan.php?alert=success');
        }else{
            header('Location:../pemasukan.php?alert=server-error');
        }
    }else{
        header('Location:../pemasukan.php?alert=incomplete');
    }
}else{
    header('Location:../pemasukan.php');
}