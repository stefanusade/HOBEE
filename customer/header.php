<?php 
session_start();
if(!isset($_SESSION['login'])){
    header('Location:../login.php?alert=logout');
    exit;
}else{
    if($_SESSION['role']!=3){
        
    }else{
        $username = $_SESSION['username'];
        $password = $_SESSION['pass'];
        include "../config/db.php";
        $user = mysqli_query($conn,"SELECT * FROM customer WHERE username = '$username'");
        $u = mysqli_fetch_assoc($user);
        $idjk = $u['id_jenis_kelamin'];
        $idk = $u['id_kota'];
        $jk = mysqli_query($conn,"SELECT * FROM jenis_kelamin WHERE id_jenis_kelamin='$idjk'");
        $j = mysqli_fetch_assoc($jk);
        $kota = mysqli_query($conn,"SELECT * FROM kota WHERE id_kota = '$idk'");
        $k = mysqli_fetch_assoc($kota);
        $foto = $u['foto_profil'];
        if(empty($foto)){
            $foto = 'sample.jpg';
        }
    }
}
?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title><?= "HOBEE - ".$page; ?></title>
    <!-- stylesheet -->
    <link rel="icon" href="../assets/img/Logo.png" type="image/png">
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
  <body>
  <div class="container">
      <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">
        <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>
  
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
          <li><a href="../index.php" class="nav-link px-2 link-secondary">Beranda</a></li>
          <li><a href="../edukasi.php" class="nav-link px-2 link-dark">Edukasi</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">Toko</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">Tentang</a></li>
        </ul>
  
        <div class="col-md-3 text-end">
          <a class="text-dark mx-3" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
          <a  class="me-2" href="index.php"><img src="../assets/uploads/profile/<?=$foto;?>" class="profpic-sm"></a>
          <a class="text-danger ml-3" href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a>

        </div>
      </header>
    </div>