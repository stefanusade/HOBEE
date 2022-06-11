<?php
include "verify.php";
    if(isset($_POST['submit'])){
        include "../../../config/db.php";
			$old = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM admin WHERE username='$username'"));
			$foto = '../../../assets/uploads/profile/'.$old['foto_profil'];
			$ekstensi = array('png','jpg','jpeg');
			$nama = crc32(date('Y-m-d H:i:s')).$_FILES['profpic']['name'];
			$x = explode('.', $nama);
			$eks = strtolower(end($x));
			$ukuran	= $_FILES['profpic']['size'];
			$file_tmp = $_FILES['profpic']['tmp_name'];	
 
			if(in_array($eks, $ekstensi) === true){
				if($ukuran < 1044070){			
					move_uploaded_file($file_tmp, '../../../assets/uploads/profile/'.$nama);
					$query = mysqli_query($conn,"UPDATE admin SET foto_profil='$nama' WHERE username='$username'");
					if($query){
					    unlink($foto);
						header('location:../akun_edit.php?alert=photo-success');
					}else{
						header('location:../akun_edit.php?alert=server-error');
					}
				}else{
					header('location:../akun_profpic.php?alert=file-too-big');
				}
			}else{
				header('location:../akun_profpic.php?alert=forbidden-extension');
			}
    }else{
        header('Location:../akun_profpic.php');
    }