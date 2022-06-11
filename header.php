<?php 

session_start();

include "./config/db.php";

if(isset($_SESSION['login'])){

  $username = $_SESSION['username'];

  $password = $_SESSION['pass'];

  $user = mysqli_query($conn,"SELECT * FROM customer WHERE username='$username'");

  $u = mysqli_fetch_assoc($user);

  $foto = $u['foto_profil'];

  if(empty($foto)){

      $foto = 'sample.jpg';

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

    <link rel="icon" href="./assets/img/Logo.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="./assets/css/style.css?v=<?= date('Y-m-d H:i'); ?>" rel="stylesheet">

    <link rel="stylesheet" href="./assets/css/headers.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet" />

    <!-- javascript -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>

    <script src="./assets/js/bootstrap.bundle.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="./assets/js/main.js"></script>
    
    <style>

      .bg-cust{
        background-image: url('./assets/img/BGCustomer.png');
        background-attachment: fixed;
        background-size: cover;
      }

    </style>

  </head>

  <body class="bg-cust">

    <div class="container-fluid px-lg-4 navbar-guest">

      <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">

        <a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">

          <img src="./assets/img/Logo.png" height="40"/>

        </a>

  

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">

          <li><a href="index.php" class="nav-link px-2 link-dark">Beranda</a></li>

          <li><a href="edukasi.php" class="nav-link px-2 link-dark">Edukasi</a></li>

          <li><a href="katalog.php" class="nav-link px-2 link-dark">Katalog</a></li>

          <li><a href="tentang.php" class="nav-link px-2 link-dark">Tentang</a></li>

        </ul>

  

        <div class="col-md-3 text-end">

          <?php if(isset($_SESSION['login']) && $_SESSION['role'] == 3):?>

            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">

                <img src="./assets/uploads/profile/<?=$foto;?>" class="profpic-sm">

            </button>

            <ul class="dropdown-menu">

                <li><a class="dropdown-item" href="./customer"><?= $username; ?></a></li>

                <li><a class="dropdown-item" href="./customer/index.php#profile">Profil</a></li>

                <li><a class="dropdown-item" href="./customer/index.php#order">Pesanan</a></li>

                <li><hr class="dropdown-divider"></li>

                <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>

            </ul>

            

          <?php else: ?>

            <a  class="btn-navbar me-2" href="login.php">Masuk</a>

            <a class="btn-navbar" href="register.php">Daftar</a>

          <?php endif; ?>

        </div>

      </header>

    </div>