<?php 
$page = '';
include "header.php"; 
$i = $me['id_kota'];
$daftar_kota = mysqli_query($conn,"SELECT * FROM kota WHERE id_kota='$i'");
$k = mysqli_fetch_assoc($daftar_kota);
if(!empty($_GET['alert'])){
    $alert = $_GET['alert'];
    if($alert=='cancel'){
        echo "<script>Swal.fire({title: 'Batal',text: 'Batal menambahkan data edukasi',icon: 'warning',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='success'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil mengubah data profil',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='cancel-edit'){
        echo "<script>Swal.fire({title: 'Batal',text: 'Batal mengubah data edukasi',icon: 'warning',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='delete-success'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil menghapus data edukasi',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='success-edit'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil mengubah data edukasi',icon: 'success',confirmButtonText: 'OK'})</script>";
    }
}
?>

<div class="main-panel">
	<div class="content">
		<div class="page-inner">
        	    <div class="d-flex bd-highlight">
        	        <div class="p-2 w-100 bd-highlight">
        	            <div class="page-header">
            	            <h4 class="page-title">Admin</h4>
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
            					    <a href="admin.php">Admin</a>
            					</li>
            				</ul>
        				</div>
        	        </div>
        	        <div class="p-2 bd-highlight">
        	            <a class="btn btn-warning" href="akun_edit.php">EDIT</a>
        	        </div>
        	    </div>
			</div>
		    <div class="card">
		        <div class="card-body">
		            <h3>Informasi Pribadi</h3>
        <div class="table-responsive mb-5">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Nama</th>
                        <td><?= $me['nama_admin']; ?></td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td><?= $me['username']; ?></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td><?php if($me['id_jenis_kelamin']==1){echo "Laki-Laki";}else{echo "Perempuan";} ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= $me['email']; ?></td>
                    </tr>
                    <tr>
                        <th>No. Handphone</th>
                        <td><?= $me['no_hp']; ?></td>
                    </tr>
                    <tr>
                        <th>Nomor Rekening</th>
                        <td><?= $me['no_rekening']; ?></td>
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
                        <td><?= $me['nama_jalan']; ?></td>
                    </tr>
                    <tr>
                        <th>No. Jalan</th>
                        <td><?= $me['no_jalan']; ?></td>
                    </tr>
                    <tr>
                        <th>Kota/Kab.</th>
                        <td><?= $k['nama_kota']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
		        </div>
		    </div>   
	    </div>
	</div>
</div>

<?php include "footer.php"; ?>