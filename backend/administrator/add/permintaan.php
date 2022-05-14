<?php
include "verify.php";
if(isset($_POST['submit'])){
    if(!empty($_POST['rincian'])&&!empty($_POST['qty'])&&!empty($_POST['tgl'])){
        include "../../../config/db.php";
        $id = $_POST['id'];
        $harga = $_POST['harga'];
        $rincian = $_POST['rincian'];
        $qty = $_POST['qty'];
        $tgl = date('Y-m-d', strtotime($_POST['tgl']));
        $ket = $_POST['ket'];
        $add = mysqli_query($conn, "INSERT INTO permintaan_stok 
        (id_supplier,tanggal_permintaan,rincian_permintaan,kuantitas,harga,id_status_permintaan,keterangan) 
        VALUES ('$id','$tgl','$rincian','$qty','$harga','1','$ket')");
        if($add){
            header('Location:../permintaan.php?alert=success');
        }else{
            header('Location:../permintaan.php?alert=server-error');
        }
    }else{
        header('Location:../stok.php');
    }
}else{
    header('Location:../stok.php');
}