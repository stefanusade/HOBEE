<?php
var_dump($_POST);
    include "verify.php";
    if(isset($_POST['submit'])){
        include "../../../config/db.php";
        $id = $_POST['id'];
        $stok = $_POST['stok'];
        $harga = $_POST['harga'];
        $ket = $_POST['ket'];
        if(!empty($id)||!empty($stok)||!empty($harga)){
            
            $update = mysqli_query($conn,"UPDATE stok_supplier SET kuantitas='$stok',harga='$harga',keterangan='$ket'
            WHERE id_supplier = '$id'");
            if($update){
                header('Location:../stok.php?alert=success');
            }else{
                header('Location:../stok.php?alert=server-error');
            }
        }else{
            header('Location:../stok.php?alert=incomplete');
        }
    }else{
        header('Location:../stok.php');
    }
    