<?php
include "verify.php";

if(isset($_POST['submit'])){
    include "../../../config/db.php";
	$ukuran	= $_FILES['foto']['size'];
	$file_tmp = $_FILES['foto']['tmp_name'];	
    $produk = $_POST['produk'];
    $seri = $_POST['seri'];
    $harga = $_POST['harga'];
    $berat = $_POST['berat'];
    $tgl_prod = date('Y-m-d', strtotime($_POST['tgl_prod']));
    $tgl_exp = date('Y-m-d', strtotime($_POST['tgl_exp']));
    $filename = crc32($produk)."-".$_FILES['foto']['name'];
    $desc = $_POST['desc'];
    $ekstensi = array('png','jpg','jpeg');
    $x = explode('.', $filename);
    $eks = strtolower(end($x));
    if(in_array($eks, $ekstensi) === true){
    	if($ukuran < 5124070){			
    		move_uploaded_file($file_tmp, '../../../assets/uploads/produk/'.$filename);
    		$query = mysqli_query($conn,"INSERT INTO produk (nama_produk,nomor_seri,harga,berat,tanggal_produksi,tanggal_kadaluarsa,foto_produk,keterangan) VALUES ('$produk','$seri','$harga','$berat','$tgl_prod','$tgl_exp','$filename','$desc')");
    		if($query){
    			header('location:../katalog.php?alert=success');
    		}else{
    			header('location:../katalog_add.php?alert=server-error');
    		}
    	}else{
    		header('location:../katalog_add.php?alert=file-too-big');
    	}
    }else{
    	header('location:../katalog_add.php?alert=forbidden-extension');
    }  
}else{
    header("Location:../katalog.php");
}