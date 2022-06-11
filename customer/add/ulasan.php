<?php
include "verify.php";
if(isset($_POST['submit'])){
    if(!empty($_POST['komentar'])&&!empty($_POST['rating'])){
        include "../../config/db.php";
        $cust       = $_POST['cust'];
        $order      = $_POST['order'];
        $komentar   = $_POST['komentar'];
        $rating     = $_POST['rating'];
        if(!empty($_FILES['foto']['name'])){
            $gambar = array('png','jpg','jpeg');
            $foto=$_FILES['foto']['name'];
            $x = explode('.', $foto);
            $last = end($x);
            $ekstensi=strtolower($last);
            $ukuran=$_FILES['foto']['size'];
            $new_file=crc32($order)."-".str_replace(" ","_",$foto);
            $temp=$_FILES['foto']['tmp_name'];
            $dir="../../assets/uploads/ulasan/";
            $new=$dir.$new_file;
            if(in_array($ekstensi,$gambar)&&$ukuran<1044070){
                move_uploaded_file($temp,$new);
                if(!empty($_FILES['video']['name'])){
                    $name=$_FILES['video']['name'];
                    $type=$_FILES['video']['type'];
                    $size=$_FILES['video']['size'];
                    $nama_file=crc32($order)."-".str_replace(" ","_",$name);
                    $tmp_name=$_FILES['video']['tmp_name'];
                    $nama_folder="../../assets/uploads/video/";
                    $file_baru=$nama_folder.$nama_file;
                    if($type == "video/mp4" && $size < 5500000){
                        move_uploaded_file($tmp_name,$file_baru);
                        $insert     = mysqli_query($conn, "INSERT INTO ulasan 
        (id_customer,id_pesanan,komentar,foto_ulasan,video_ulasan,bintang,visibilitas) VALUES ('$cust','$order','$komentar','$new_file','$nama_file','$rating','privat')");
                        if($insert){
                            header("Location:../index.php?alert=success-rating");
                        }else{
                            header("Location:../index.php?alert=server-error");
                        }
                    }else{
                        header("Location:../index.php?alert=forbidden");
                    }
                }else{
                    $insert     = mysqli_query($conn, "INSERT INTO ulasan 
        (id_customer,id_pesanan,komentar,foto_ulasan,bintang,visibilitas) VALUES ('$cust','$order','$komentar','$new_file','$rating','privat')");
                    if($insert){
                        header("Location:../index.php?alert=success-rating");
                    }
                }    
            }else{
                header("Location:../index.php?alert=forbidden");
            }
        }else{
            if(!empty($_FILES['video']['name'])){
                $name=$_FILES['video']['name'];
                $type=$_FILES['video']['type'];
                $size=$_FILES['video']['size'];
                $nama_file=crc32($order)."-".str_replace(" ","_",$name);
                $tmp_name=$_FILES['video']['tmp_name'];
                $nama_folder="../../assets/uploads/video/";
                $file_baru=$nama_folder.$nama_file;
                if($type == "video/mp4" && $size < 5500000){
                    move_uploaded_file($tmp_name,$file_baru);
                    $insert     = mysqli_query($conn, "INSERT INTO ulasan 
        (id_customer,id_pesanan,komentar,video_ulasan,bintang,visibilitas) VALUES ('$cust','$order','$komentar','$nama_file','$rating','privat')");
                    if($insert){
                        header("Location:../index.php?alert=success-rating");
                    }else{
                        header("Location:../index.php?alert=server-error");
                    }
                }else{
                    header("Location:../index.php?alert=forbidden");
                }
            }else{
                header("Location:../index.php?alert=success-rating");
            }
        }
    }else{
        header("Location:../index.php?alert=incomplete");
    }
}else{
    header("Location:../index.php");
}