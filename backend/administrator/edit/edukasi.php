<?php
    include "verify.php";
    if(isset($_POST['submit'])){
        include "../../../config/db.php";
        if(!empty($_POST['content'])&& !empty($_POST['link'])){
            $yt = 'https://www.youtube.com/watch?v=';
            $content = $_POST['content'];
            $id = $_POST['id'];
            $judul = $_POST['judul'];
            if(strpos($_POST['link'],$yt)!==false){
                $link = str_replace($yt,"",$_POST['link']);
                if(!empty($_FILES['sampul']['name'])){
                    $search = mysqli_query($conn,"SELECT * FROM edukasi WHERE id_edukasi='$id'");
                    $d = mysqli_fetch_assoc($search);
                    $unlink = '../../../assets/uploads/edukasi/'.$d['gambar_sampul'];
                    $ukuran	= $_FILES['sampul']['size'];
                    $file_tmp = $_FILES['sampul']['tmp_name'];
                    $filename = md5($judul).$_FILES['sampul']['name'];
                    $ekstensi = array('png','jpg','jpeg');
        	        $x = explode('.', $filename);
        	        $eks = strtolower(end($x));
        	        if(in_array($eks, $ekstensi) === true){
        		        if($ukuran < 5124070){	
        			        unlink($unlink);
        			        move_uploaded_file($file_tmp, '../../../assets/uploads/edukasi/'.$filename);
        			        $update = mysqli_query($conn,"UPDATE edukasi SET konten='$content',link_video='$link',gambar_sampul='$filename' WHERE id_edukasi = '$id'");
        			        if($update){
                				header('location:../edukasi.php?alert=success-edit');
                			}else{
                				header('location:../edukasi.php?alert=server-error');
                			}
        		        }else{
        		            header("location:../edukasi_edit.php?alert=file-too-big&id=$id");
        		        }
        	        }else{
        	            header("location:../edukasi_edit.php?alert=forbidden-extension&id=$id");
        	        }
                }else{
                    $update = mysqli_query($conn,"UPDATE edukasi SET konten = '$content',link_video='$link' WHERE id_edukasi = '$id'");
                    if($update){
                        header('Location:../edukasi.php?alert=success-edit');
                    }else{
                        header('Location:../edukasi.php?alert=server-error');
                    }
                }
            }else{
                header("Location:../edukasi_edit.php?alert=invalid-link&id=$id");
            }    
        }else{
            header("Location:../edukasi_edit.php?alert=incomplete&id=$id");
        }
    }else{
        header('Location:../edukasi.php');
    }
    