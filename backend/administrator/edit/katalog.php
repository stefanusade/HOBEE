<?php 
include "verify.php";

if(isset($_POST['submit'])){
    if(!empty($_POST['produk'])||!empty($_POST['harga'])||!empty($_POST['berat'])
    ||!empty($_POST['harga'])||!empty($_POST['tgl_prod'])||!empty($_POST['tgl_exp'])
    ||!empty($_POST['desc'])){
        include "../../../config/db.php";
        $id = $_POST['id'];
        $produk = $_POST['produk'];
        $berat = $_POST['berat'];
        $harga = $_POST['harga'];
        $tgl_prod = $_POST['tgl_prod'];
        $tgl_exp = $_POST['tgl_exp'];
        $desc = $_POST['desc'];
        if(!empty($_FILE['foto']['name'])){
            $search = mysqli_query($conn,"SELECT * FROM produk WHERE id_produk='$id'");
            $d = mysqli_fetch_assoc($search);
            $unlink = '../../../assets/uploads/produk/'.$d['foto_produk'];
            $ukuran	= $_FILES['foto']['size'];
            $file_tmp = $_FILES['foto']['tmp_name'];
            $filename = md5($judul).$_FILES['foto']['name'];
            $ekstensi = array('png','jpg','jpeg');
        	$x = explode('.', $filename);
        	$eks = strtolower(end($x));
        	if(in_array($eks, $ekstensi) === true){
        	    if($ukuran < 5124070){	
        		    unlink($unlink);
        			move_uploaded_file($file_tmp, '../../../assets/uploads/produk/'.$filename);
        			$update = mysqli_query($conn,"UPDATE produk SET keterangan='$desc',foto_produk='$filename', nama_produk='$produk', 
        			harga='$harga', berat='$berat', tanggal_produksi='$tgl_prod', tanggal_kadaluarsa='$tgl_exp' WHERE id_produk = '$id'");
        			if($update){
                		header('location:../katalog.php?alert=success-edit');
                	}else{
                		header('location:../katalog.php?alert=server-error');
                	}
        	    }else{
        		    header("location:../katalog_edit.php?alert=file-too-big&id=$id");
        	    }
            }else{
                header("location:../katalog_edit.php?alert=forbidden-extension&id=$id");
            }
        }else{
            $update = mysqli_query($conn,"UPDATE produk SET keterangan='$desc',nama_produk='$produk', harga='$harga', berat='$berat', 
        			tanggal_produksi='$tgl_prod', tanggal_kadaluarsa='$tgl_exp' WHERE id_produk = '$id'");
        	header('location:../katalog.php?alert=success-edit');
        }
    }else{
        header('Location:../katalog.php?alert=incomplete');
    }
}else{
    header('Location:../katalog.php');
}