<?php 
$page = '';
include "header.php"; 
$i = $me['id_kota'];
$daftar_kota = mysqli_query($conn,"SELECT * FROM kota WHERE id_kota='$i'");
$k = mysqli_fetch_assoc($daftar_kota);
?>

<div class="main-panel">
	<div class="content">
		<div class="page-inner">
        	<div class="page-header">
        	    
        	            <h4 class="page-title">Akun Saya</h4>
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
        					    <a href="admin.php">Akun Saya</a>
        					</li>
        				</ul>
        	        
        	            <a class="btn btn-warning" href="akun_edit.php">EDIT</a>
        	        
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
                        <td><?= $me['nama_supplier']; ?></td>
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
	    

<?php include "footer.php"; ?>