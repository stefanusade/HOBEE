<?php
include "verify.php";
if(isset($_POST['submit'])){
    if(!empty($_POST['rincian'])&&!empty($_POST['qty'])){
        include "../../../config/db.php";
        $id = $_POST['id'];
        $rincian = $_POST['rincian'];
        $qty = $_POST['qty'];
        $ket = $_POST['ket'];
        if(!empty($_POST['tgl'])){
            $tgl = date('Y-m-d', strtotime($_POST['tgl']));
            $update = mysqli_query($conn, "UPDATE permintaan_stok SET
            rincian_permintaan='$rincian',kuantitas='$qty',tanggal_diterima='$tgl',keterangan='$ket',id_status_permintaan=2
            WHERE id_permintaan='$id'
            ");
            $getsup = mysqli_query($conn, "SELECT * FROM permintaan_stok WHERE id_permintaan='$id'");
            $s = mysqli_fetch_assoc($getsup);
            $sup = $s['id_supplier'];
            $getqty = mysqli_query($conn, "SELECT * FROM stok_supplier WHERE id_supplier='$sup'");
            $q = mysqli_fetch_assoc($getqty);
            $kuan = $q['kuantitas'];
            $sisa = $kuan-$qty;
            $update2 = mysqli_query($conn, "UPDATE stok_supplier SET kuantitas='$sisa' WHERE id_supplier='$sup'");
            if($update&&$update2){
                header('Location:../permintaan.php?alert=edit-success');
            }else{
                header('Location:../permintaan.php?alert=server-error');
            }
        }else{
            $update = mysqli_query($conn, "UPDATE permintaan_stok SET
            rincian_permintaan='$rincian',kuantitas='$qty',keterangan='$ket'
            WHERE id_permintaan='$id'
            ");
            if($update){
                header('Location:../permintaan.php?alert=edit-success');
            }else{
                header('Location:../permintaan.php?alert=server-error');
            }
        } 
    }else{
        header('Location:../stok.php');
    }
}else{
    header('Location:../stok.php');
}