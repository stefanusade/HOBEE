<?php
session_start();
if(isset($_SESSION['login'])&&$_SESSION['role']==3){
    $username = $_SESSION['username'];
    if(isset($_POST['submit'])){
        include "../../config/db.php";
			$old = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM customer WHERE username='$username'"));
			$foto = '../../assets/uploads/profile/'.$old['foto_profil'];
			$ekstensi = array('png','jpg','jpeg');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$eks = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];	
 
			if(in_array($eks, $ekstensi) === true){
				if($ukuran < 1044070){			
					move_uploaded_file($file_tmp, '../../assets/uploads/profile/'.$nama);
					$query = mysqli_query($conn,"UPDATE customer SET foto_profil='$nama' WHERE username='$username'");
					if($query){
					    unlink($foto);
						header('location:../index.php?alert=photo-success');
					}else{
						header('location:../profpic.php?alert=server-error');
					}
				}else{
					header('location:../profpic.php?alert=file-too-big');
				}
			}else{
				header('location:../profpic.php?alert=forbidden-extension');
			}
    }else{
        header('Location:../index.php');
    }
}else{
    header('Location:../../logout.php');
}
    