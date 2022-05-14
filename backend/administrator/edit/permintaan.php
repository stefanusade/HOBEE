<?php
include "verify.php";
if(isset($_POST['submit'])){
    if(!empty($_POST['rincian'])&&!empty($_POST['qty'])&&!empty($_POST['tgl'])){
        include "../../../config/db.php";
        $id = $_POST['id'];
        $rincian = $_POST['rincian'];
        $qty = $_POST['qty'];
        $tgl = date('Y-m-d', strtotime($_POST['tgl']));
        $ket = $_POST['ket'];
        $update = mysqli_query($conn, "UPDATE permintaan_stok SET
        rincian_permintaan='$rincian',kuantitas='$qty',tanggal_diterima='$tgl',keterangan='$ket'
        WHERE id_permintaan='$id'
        ");
        if($update){
            header('Location:../permintaan.php?alert=edit-success');
        }else{
            header('Location:../permintaan.php?alert=server-error');
        }
    }else{
        header('Location:../stok.php');
    }
}else{
    header('Location:../stok.php');
}