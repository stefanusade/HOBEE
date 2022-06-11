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
        $update     = mysqli_query($conn,"UPDATE pengeluaran SET tanggal_pengeluaran='$tgl'
        ,rincian_pengeluaran='$rincian',nominal_pengeluaran='$nominal' WHERE id_pengeluaran='$id'");
        if($update){
            header('Location:../pengeluaran.php?alert=success-edit');
        }else{
            header('Location:../pengeluaran.php?alert=server-error');
        }
    }else{
        header('Location:../pengeluaran.php?alert=incomplete');
    }
}else{
    header('Location:../pengeluaran.php');
}