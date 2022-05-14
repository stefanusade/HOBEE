<?php 
$page = 'Akun';
include "header.php";
if(!isset($_POST['lihat'])){
    header('Location:admin.php');
}
$id = $_POST['lihat'];
?>
<?php if(!isset($_POST['permintaan'])): ?>
<?php 
$ro = $_POST['role'];
$u = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM $ro WHERE id_$ro='$id'"));
$kota = $u['id_kota'];
$x = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM kota WHERE id_kota='$kota'"));
?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
		            	<div class="page-header">
				<h4 class="page-title">Detail Akun <?= $u["nama_$ro"]; ?></h4>
				<ul class="breadcrumbs">
					<li class="nav-home">
				    	<a href="index.php">
			    	    	<i class="flaticon-home"></i>
		    			</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Data Akun</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
					    <a href="<?= $ro; ?>.php"><?= $ro; ?></a>
					</li>
				</ul>
			</div>
		    <div class="card">
		        <div class="card-body">
		            <h3>Informasi Pribadi</h3>
        <div class="table-responsive mb-5">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Nama</th>
                        <td><?= $u["nama_$ro"]; ?></td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td><?= $u['username']; ?></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td><?php if($u['id_jenis_kelamin']==1){echo "Laki-Laki";}else{echo "Perempuan";} ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= $u['email']; ?></td>
                    </tr>
                    <tr>
                        <th>No. Handphone</th>
                        <td><?= $u['no_hp']; ?></td>
                    </tr>
                    <tr>
                        <th>Nomor Rekening</th>
                        <td><?= $u['no_rekening']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h3>Alamat</h3>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Jalan</th>
                        <td><?= $u['nama_jalan']; ?></td>
                    </tr>
                    <tr>
                        <th>No. Jalan</th>
                        <td><?= $u['no_jalan']; ?></td>
                    </tr>
                    <tr>
                        <th>Kota/Kab.</th>
                        <td><?= $x['nama_kota']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
		        </div>
		    </div>   
	    </div>
	</div>
</div>
<?php else: ?>
<?php 
$u = mysqli_fetch_assoc(mysqli_query($conn,"SELECT ss.*, s.nama_supplier AS supplier FROM stok_supplier ss, supplier s WHERE ss.id_supplier='$id' AND s.id_supplier=ss.id_supplier"));
?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
		            	<div class="page-header">
				<h4 class="page-title">Stok Madu <?= $u['supplier']; ?></h4>
				<ul class="breadcrumbs">
					<li class="nav-home">
				    	<a href="index.php">
			    	    	<i class="flaticon-home"></i>
		    			</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Data Stok</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
					    <a href="#">Stok Madu <?= $u['supplier']; ?></a>
					</li>
				</ul>
			</div>
		    <div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-6">
		                    <p><strong>Harga</strong></p>
		                    <p><?= $u['harga']; ?></p>
		                </div>
		                <div class="col-6">
		                    <p><strong>Kuantitas</strong></p>
		                    <p><?= $u['kuantitas']; ?></p>
		                </div>
		            </div>
		            <div class="row">
		                <div class="col-12">
		                    <p><strong>Keterangan</strong></p>
		                    <p><?= $u['keterangan']; ?></p>
		                </div>
		            </div>
		            <div class="row">
		                <a href="permintaan_add.php?id=<?= $id; ?>" class="btn btn-primary mt-3 ml-3">BUAT PERMINTAAN</a>
		                <a href="stok.php" class="btn btn-danger mt-3 ml-3">KEMBALI</a>
		            </div>
		        </div>
		    </div>   
	    </div>
	</div>
</div>
<?php endif; ?>
<?php include "footer.php"; ?>