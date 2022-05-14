<?php 
include "verify.php";

if(isset($_GET['id'])){
    include "../../../config/db.php";
    $id = $_GET['id'];
    $delete = mysqli_query($conn,"DELETE FROM edukasi WHERE id_edukasi='$id'");
    if($delete){
        header('location:../edukasi.php?alert=delete-success');
    }else{
        header('location:../edukasi.php?alert=server-error');
    }
}else{
    header('location:edukasi.php');
}