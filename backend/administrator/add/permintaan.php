<?php
include "verify.php";
if(isset($_POST['submit'])){
    if(!empty($_POST['rincian'])&&!empty($_POST['qty'])&&!empty($_POST['tgl'])){
        include "../../../config/db.php";
        include "../../../config/mail.php";
        $search = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
        $s = mysqli_fetch_assoc($search);
        $uid = $s['id_admin'];
        $id = $_POST['id'];
        $harga = $_POST['harga'];
        $rincian = $_POST['rincian'];
        $qty = $_POST['qty'];
        $tgl = date('Y-m-d', strtotime($_POST['tgl']));
        $ket = $_POST['ket'];
        $supp = mysqli_query($conn,"SELECT * FROM supplier WHERE id_supplier='$id'");
        $d = mysqli_fetch_assoc($supp);
        $su = $d['nama_supplier'];
        $email = $d['email'];
        $add = mysqli_query($conn, "INSERT INTO permintaan_stok 
        (id_supplier,tanggal_permintaan,rincian_permintaan,kuantitas,harga,id_status_permintaan,keterangan) 
        VALUES ('$id','$tgl','$rincian','$qty','$harga','1','$ket')");
        if($add){
            $total = $harga * $qty;
            $insert     = mysqli_query($conn,"INSERT INTO pengeluaran 
            (id_admin,tanggal_pengeluaran,rincian_pengeluaran,nominal_pengeluaran,keterangan) 
            VALUES ('$uid','$tgl','$rincian','$total','Permintaan stok ke supplier')");
            $subject = "Notifikasi Permintaan Stok";
            $body = "
                        <h1>Notifikasi Permintaan Stok</h1>
                        <hr>
                        Halo, $su
                        <p>Kami baru saja melakukan permintaan stok.</p>
                        <h3>$rincian</h3>
                        <h3>Sebanyak        : $qty</h3>
                        <h3>Harga supplier  : $harga</h3>
                        <p>Mohon segera cek dashboard Anda untuk memproses permintaan kami.</p>
                        <hr>
            ";
            
            if(mail($email,$subject,$body,$headers)){
                header('Location:../permintaan.php?alert=success');
            }
            
        }else{
            header('Location:../permintaan.php?alert=server-error');
        }
    }else{
        header('Location:../stok.php');
    }
}else{
    header('Location:../stok.php');
}