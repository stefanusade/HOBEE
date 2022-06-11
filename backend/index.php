<?php 
session_start();
if(isset($_SESSION['login'])){
    if($_SESSION['role']==1){
        header('Location:./administrator');
    }elseif($_SESSION['role']==2){
        header('Location:./supplier');
    }
}
if(isset($_POST['admin'])){
    if(isset($_POST['admin-email'])&&isset($_POST['admin-pass'])){
        require_once('../config/db.php');
        $email = $_POST['admin-email'];
        $pass = $_POST['admin-pass'];
        $search = mysqli_query($conn,"SELECT * FROM admin WHERE email = '$email'");
        if(mysqli_num_rows($search)>0){
            $a = mysqli_fetch_assoc($search);
            $username = $a['username'];
            $dbpass = $a['password'];
            if(password_verify($pass,$dbpass)){
                $_SESSION['login'] = TRUE;
                $_SESSION['username'] = $username;
                $_SESSION['pass'] = $pass;
                $_SESSION['role'] = 1;
                $_SESSION['success'] = true;
                header('Location:./administrator');
            }else{
                header('Location:index.php?alert=invalidpass');
            }
        }else{
            header('Location:index.php?alert=nouser');
        }
    }else{
        header('Location:index.php?alert=incomplete');
    }
}elseif(isset($_POST['supplier'])){
    if(isset($_POST['supplier-email'])&&isset($_POST['supplier-pass'])){
        require_once('../config/db.php');
        $email = $_POST['supplier-email'];
        $pass = $_POST['supplier-pass'];
        $search = mysqli_query($conn,"SELECT * FROM supplier WHERE email = '$email'");
        if(mysqli_num_rows($search)>0){
            $s = mysqli_fetch_assoc($search);
            $username = $s['username'];
            $dbpass = $s['password'];
            if(password_verify($pass,$dbpass)){
                $_SESSION['login'] = TRUE;
                $_SESSION['username'] = $username;
                $_SESSION['pass'] = $pass;
                $_SESSION['role'] = 2;
                header('Location:./supplier');
            }else{
                header('Location:index.php?alert=invalidpass');
            }
        }else{
            header('Location:index.php?alert=nouser');
        }
    }else{
        header('Location:index.php?alert=incomplete');
    }
}
?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title><?= "HOBEE - Login Admin dan Supplier"; ?></title>
    <!-- stylesheet -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css?v=<?= date('Y-m-d H:i'); ?>" rel="stylesheet">
    <link href="../assets/css/headers.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet" />
    <!-- javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  </head>
 	
  <body class="bg-primary">
    <?php
    	if(!empty($_GET['alert'])){
    		$alert = $_GET['alert'];
        	if($alert=='invalidpass'){
            	echo "<script>Swal.fire({title: 'Gagal',text: 'Password yang anda masukkan salah',icon: 'error',confirmButtonText: 'OK'})</script>";
        	}elseif($alert=='nouser'){
            	echo "<script>Swal.fire({title: 'Gagal',text: 'Akun pengguna tidak ditemukan',icon: 'error',confirmButtonText: 'OK'})</script>";
        	}elseif($alert=='incomplete'){
            	echo "<script>Swal.fire({title: 'Gagal',text: 'Form belum terisi lengkap',icon: 'error',confirmButtonText: 'OK'})</script>";
        	}
		}
    ?>
        <div class="container my-5">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills nav-fill rounded" style="background-color:#91929a">
                              <li class="nav-item col-link" id="btn-admin">
                                <a class="nav-link text-white" id="link-admin">Administrator</a>
                              </li>
                              <li class="nav-item col-link" id="btn-supplier">
                                <a class="nav-link text-white" id="link-supplier">Supplier</a>
                              </li>
                            </ul>
                            <div class="my-3 pt-3" id="admin">
                                <center><h2>Login Administrator</h2></center>
                                <form method="POST" action="">
                                    <div class="form-floating my-3">
                                        <input type="email" class="form-control" name="admin-email" id="floatingInput" placeholder="name@example.com">
                                        <label for="floatingInput">Email</label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="form-floating form-floating-group flex-grow-1">
                                            <input type="password" class="form-control" name="admin-pass" id="password" placeholder="Password">
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                    <input class="form-control btn btn-lg btn-primary" type="submit" name="admin" value="Masuk"/>
                                </form>
                            </div>
                            <div class="my-3 pt-3" id="supplier">
                                <center><h2>Login Supplier</h2></center>
                                <form method="POST" action="">
                                    <div class="form-floating my-3">
                                        <input type="email" class="form-control" name="supplier-email" id="floatingInput" placeholder="name@example.com">
                                        <label for="floatingInput">Email</label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="form-floating form-floating-group flex-grow-1">
                                            <input type="password" class="form-control" name="supplier-pass" id="password" placeholder="Password">
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                    <input class="form-control btn btn-lg btn-primary" type="submit" name="supplier" value="Masuk"/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </body>
</html>