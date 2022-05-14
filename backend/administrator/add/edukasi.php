<?php
include "verify.php";

if(isset($_POST['submit'])){
    include "../../../config/db.php";
	$ukuran	= $_FILES['sampul']['size'];
	$file_tmp = $_FILES['sampul']['tmp_name'];	
    $judul = $_POST['judul'];
    $auth_id = $_POST['author'];
    $search = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM admin WHERE username='$auth_id'"));
    $author = $search['id_admin'];
    $timestamp = date('Y-m-d H:i:s', strtotime($_POST['tgl']));
    $filename = md5($judul).$_FILES['sampul']['name'];
    $konten = $_POST['content'];
    $yt = 'https://www.youtube.com/watch?v=';
    if(strpos($_POST['link'],$yt)!==false){
        $link = str_replace($yt,"",$_POST['link']);
        $ekstensi = array('png','jpg','jpeg');
    	$x = explode('.', $filename);
    	$eks = strtolower(end($x));
    	if(in_array($eks, $ekstensi) === true){
    		if($ukuran < 5124070){			
    			move_uploaded_file($file_tmp, '../../../assets/uploads/edukasi/'.$filename);
    			$query = mysqli_query($conn,"INSERT INTO edukasi (id_admin,judul,tgl_post,gambar_sampul,konten,link_video) VALUES ('$author','$judul','$timestamp','$filename','$konten','$link')");
    			if($query){
    				header('location:../edukasi.php?alert=success');
    			}else{
    				header('location:../edukasi_add.php?alert=server-error');
    			}
    		}else{
    			header('location:../edukasi_add.php?alert=file-too-big');
    		}
    	}else{
    		header('location:../edukasi_add.php?alert=forbidden-extension');
    	}
    }else{
        header('location:../edukasi_add.php?alert=invalid-link');
    }    
}else{
    header('location:../edukasi_add.php');
}