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
        $insert     = mysqli_query($conn,"INSERT INTO pengeluaran 
        (id_admin,tanggal_pengeluaran,rincian_pengeluaran,nominal_pengeluaran,keterangan) 
        VALUES ('$id','$tgl','$rincian','$nominal','$keterangan')");
        if($insert){
            header('Location:../pengeluaran.php?alert=success');
        }else{
            header('Location:../pengeluaran.php?alert=server-error');
        }
    }else{
        header('Location:../pengeluaran.php?alert=incomplete');
    }
}else{
    header('Location:../pengeluaran.php');
}