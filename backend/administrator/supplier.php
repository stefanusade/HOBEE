<?php 
$page='Akun';
include "header.php"; 
if(!empty($_GET['alert'])){
    $alert = $_GET['alert'];
    if($alert=='cancel'){
        echo "<script>Swal.fire({title: 'Batal',text: 'Batal menambahkan data admin',icon: 'warning',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='success'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil menambahkan data admin',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='server-error'){
        echo "<script>Swal.fire({title: 'Gagal',text: 'Terjadi gangguan pada server',icon: 'error',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='incomplete'){
        echo "<script>Swal.fire({title: 'Gagal',text: 'Form belum terisi lengkap',icon: 'error',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='duplicate'){
        echo "<script>Swal.fire({title: 'Gagal',text: 'Akun sudah ada',icon: 'error',confirmButtonText: 'OK'})</script>";
    }
}

?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
        	<div class="page-header">
				<h4 class="page-title">Supplier</h4>
				<ul class="breadcrumbs">
					<li class="nav-home">
				    	<a href="#">
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
					    <a href="#">Supplier</a>
					</li>
				</ul>
			</div>
            <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body py-3">
                            <a class="btn btn-primary mb-3" href="supplier_add.php">+ TAMBAH</a>
							<div class="table-responsive">
								<table id="basic-datatables" class="display table table-striped table-hover" >
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Email</th>
											<th>Alamat</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										    $i = 1;
										    while($d=mysqli_fetch_assoc($supp)){
										        $alamat = $d['jalan']." ".$d['no'].", ".ucwords(strtolower($d['kota']));
										        echo "
										            <tr>
										                <td>$i</td>
										                <td>$d[nama]</td>
										                <td>$d[email]</td>
										                <td>$alamat</td>
										                <td>
										                <form action='details.php' method='POST'>
										                <input type='hidden' name='role' value='supplier'/>
										                <button class='btn btn-sm btn-primary' type='submit' name='lihat' value='$d[id]' data-toggle='tooltip' data-placement='bottom' title='Lihat'><i class='fas fa-eye'></i></button>
										                </form></td>
										            </tr>
										        ";
										        $i++;
										    }
										?>
									</tbody>
								</table>
			    			</div>
					    </div>
				    </div>
			    </div>
			</div>
		</div>
	</div>
</div>
<?php include "footer.php"; ?>