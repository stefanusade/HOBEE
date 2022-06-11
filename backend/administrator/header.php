<?php 
session_start();
if(!isset($_SESSION['login'])){
    header('Location:../../logout.php');
}
if($_SESSION['role']!=1){
    header('Location:../../logout.php');
}
include "../../config/db.php";

// Load All Data
$month      = date('m');
$year       = date('Y');
$username   = $_SESSION['username'];
$cust       = mysqli_query($conn,"SELECT c.id_customer AS id, c.nama_customer AS nama, c.email AS email, c.no_jalan AS no, c.nama_jalan AS jalan, k.nama_kota AS kota FROM customer c, kota k WHERE c.id_kota=k.id_kota");
$supp       = mysqli_query($conn,"SELECT s.id_supplier AS id, s.nama_supplier AS nama, s.email AS email, s.no_jalan AS no, s.nama_jalan AS jalan, k.nama_kota AS kota FROM supplier s, kota k WHERE s.id_kota=k.id_kota");
$adm        = mysqli_query($conn,"SELECT a.id_admin AS id, a.nama_admin AS nama, a.email AS email, a.no_jalan AS no, a.nama_jalan AS jalan, k.nama_kota AS kota FROM admin a, kota k WHERE a.id_kota=k.id_kota");
$edu        = mysqli_query($conn,"SELECT e.id_edukasi AS id, a.nama_admin AS author, e.judul AS judul, e.tgl_post AS tgl FROM edukasi e, admin a WHERE a.id_admin=e.id_admin");
$prod       = mysqli_query($conn,"SELECT * FROM produk ORDER BY id_produk DESC");
$order      = mysqli_query($conn,"SELECT p.id_pesanan AS id, pr.nama_produk AS nama_produk, p.kuantitas AS qty, p.harga AS harga, b.nama_status_pembayaran AS bayar, s.nama_status_pesanan AS status
FROM pesanan p, status_pembayaran b, status_pesanan s, produk AS pr 
WHERE p.id_status_pembayaran=b.id_status_pembayaran AND p.id_status_pesanan=s.id_status_pesanan AND pr.id_produk=p.id_produk ORDER BY p.id_pesanan DESC");
$produksi   = mysqli_query($conn,"SELECT p.id_produksi AS id, k.nama_produk AS produk, p.tanggal_produksi AS tgl, p.berat AS berat FROM produksi p, produk k WHERE p.id_produk=k.id_produk ORDER BY p.id_produksi DESC");
$income     = mysqli_query($conn,"SELECT * FROM pemasukan WHERE MONTH(tanggal_pemasukan) = '$month' AND YEAR(tanggal_pemasukan) = '$year' ORDER BY tanggal_pemasukan DESC");
$outcome    = mysqli_query($conn,"SELECT * FROM pengeluaran WHERE MONTH(tanggal_pengeluaran) = '$month' AND YEAR(tanggal_pengeluaran) = '$year' ORDER BY tanggal_pengeluaran DESC");
$me         = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM admin WHERE username = '$username'"));
$profpic    = $me['foto_profil'];
if($profpic==''){
    $profpic = 'sample.jpg';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Admin — <?= $page; ?></title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../../assets/img/Logo.png" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.css?v=<?=date('Y-m-d H:i');?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
	<style>
		.nav-top{

		background: rgba(255, 255, 255, 0.22);
		box-shadow: 0px 4px 37px 5px rgba(0, 0, 0, 0.25);

		}
		.bg-admin{
			background-image: url('../../assets/img/BGAdminSupp.png');
			background-attachment: fixed;
			background-size: cover;
		}

		.nav-side{
		
			background: rgba(0, 0, 0, 0.6);
			box-shadow: 0px 0px 50px 11px rgba(0, 0, 0, 0.25);

		}

		.card{
			background: rgba(0, 0, 0, 0.6);
			box-shadow: 0px 0px 50px 11px rgba(0, 0, 0, 0.25);
		}
		.main-panel{
			color:white;
		}
		
		.form-control:valid {
  			background-color:  rgba(0, 0, 0, 0.25)!important;
			border: 0px;
			border-radius: 10px;
			color:white;
		}
		.form-control {
  			background-color:  rgba(0, 0, 0, 0.25)!important;
			border: 0px;
			border-radius: 10px;
			color:white;
		}
		form, input, label, p {
    		color: white !important;
		}
		.page-title{
			color:white
		}

		.teksp{
			color:white;
		}
		
	</style>
</head>
<body class="bg-admin">
    
    <!--   Core JS Files   -->
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


	<!-- Chart JS -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Datatables -->
	<script src="../assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Bootstrap Notify -->
	<script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

	<!-- jQuery Vector Maps -->
	<script src="../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

	<!-- Sweet Alert -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<!-- Atlantis JS -->
	<script src="../assets/js/atlantis.min.js"></script>
	
	<script src="../../assets/js/main.js"></script>
	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable();
			$('#nosort').DataTable({
			    "order": [ 0, 'desc' ]
			});
		});
	</script>

	<div class="wrapper">
		<div class="main-header bg-admin">
			<!-- Logo Header -->
			<div class="logo-header">
				
				<a href="index.html" class="logo text-light">
					<!-- <img src="../assets/img/logo.svg" alt="navbar brand" class="navbar-brand"> --> HOBEE
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg nav-top">
				
				<div class="container-fluid">
					<div class="collapse" id="search-nav">
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="../../assets/uploads/profile/<?=$profpic;?>" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="../../assets/uploads/profile/<?=$profpic;?>" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4><?= $_SESSION['username']; ?></h4>
												<p class="text-muted"><?= $me['email']; ?></p>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="akun.php">Akun Saya</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item text-danger" href="../../logout.php">Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2 nav-side bg-admin">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="../../assets/uploads/profile/<?=$profpic;?>" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
								<b><?= $_SESSION['username']; ?></b><br>
								<small>Administrator</small>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
									<li>
										<a href="#settings">
											<span class="link-collapse">Settings</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="teks">
						
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item <?php if($page=='Dashboard'){echo 'active'; } ?>" >
							<a href="index.php" >
									<i class="fas fa-home"></i>
									<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item <?php if($page=='Akun'){echo 'active'; } ?>">
							<a data-toggle="collapse" href="#akun" class="collapsed" aria-expanded="false">
								<i class="fas fa-users"></i>
								<p>Data Akun</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="akun">
								<ul class="nav nav-collapse teks">
									<li>
										<a href="admin.php">
											<span class="sub-item">Admin</span>
										</a>
									</li>
									<li>
										<a href="supplier.php">
											<span class="sub-item">Supplier</span>
										</a>
									</li>
									<li>
										<a href="customer.php">
											<span class="sub-item">Customer</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item <?php if($page=='Edukasi'){echo 'active'; } ?>">
							<a href="edukasi.php" >
								<i class="fas fa-graduation-cap"></i>
								<p>Edukasi</p>
							</a>
						</li>
                        <li class="nav-item <?php if($page=='Stok'){echo 'active'; } ?>">
							<a data-toggle="collapse" href="#stok" class="collapsed" aria-expanded="false">
								<i class="fas fa-box-open"></i>
								<p>Stok Supplier</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="stok">
								<ul class="nav nav-collapse">
									<li>
										<a href="stok.php">
											<span class="sub-item">Data Stok</span>
										</a>
									</li>
									<li>
										<a href="permintaan.php">
											<span class="sub-item">Data Permintaan</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item <?php if($page=='Katalog'){echo 'active'; } ?>">
							<a href="katalog.php" >
								<i class="fas fa-shopping-bag"></i>
								<p>Katalog</p>
							</a>
						</li>
						<li class="nav-item <?php if($page=='Pesanan'){echo 'active'; } ?>">
							<a href="pesanan.php" >
								<i class="fas fa-shopping-cart"></i>
								<p>Pesanan</p>
							</a>
						</li>
						<li class="nav-item <?php if($page=='Keuangan'){echo 'active'; } ?>">
							<a data-toggle="collapse" href="#keuangan" class="collapsed" aria-expanded="false">
								<i class="fas fa-wallet"></i>
								<p>Data Keuangan</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="keuangan">
								<ul class="nav nav-collapse teks">
									<li>
										<a href="pemasukan.php">
											<span class="sub-item">Pemasukan</span>
										</a>
									</li>
									<li>
										<a href="pengeluaran.php">
											<span class="sub-item">Pengeluaran</span>
										</a>
									</li>
									<li>
										<a href="laporan.php">
											<span class="sub-item">Laporan Keuangan</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item <?php if($page=='Produksi'){echo 'active'; } ?>">
							<a href="produksi.php" >
								<i class="fas fa-pallet"></i>
								<p>Produksi</p>
							</a>
						</li>
						<li class="nav-item <?php if($page=='Grafik'){echo 'active'; } ?>">
							<a data-toggle="collapse" href="#grafik" class="collapsed" aria-expanded="false">
								<i class="fas fa-project-diagram"></i>
								<p>Grafik</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="grafik">
								<ul class="nav nav-collapse teks">
									<li>
										<a href="hasil_produksi.php">
											<span class="sub-item">Hasil Produksi</span>
										</a>
									</li>
									<li>
										<a href="hasil_penjualan.php">
											<span class="sub-item">Hasil Penjualan</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->
		<?php 
    if(isset($_SESSION['success'])){
        echo "<script>Swal.fire({title: 'Login Berhasil!',text: 'Berhasil melakukan login',icon: 'success',confirmButtonText: 'OK'})</script>";
        unset($_SESSION['success']);
    }
    ?>