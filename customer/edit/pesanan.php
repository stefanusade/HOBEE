<?php
include "../add/verify.php";
if(!empty($_POST)){
    include "../../config/db.php";
    $id     = $_POST['id'];
    $act    = $_POST['action'];
    if($act=='selesai'){
        $update = mysqli_query($conn,"UPDATE pesanan SET id_status_pesanan='4' WHERE id_pesanan='$id'");
        if($update){
            header("Location:../index.php?alert=success-complete");
        }else{
            header("Location:../index.php?alert=server-error");
        }
    }else{
        header("Location:../index.php");
    }
}else{
    header("Location:../index.php");
}