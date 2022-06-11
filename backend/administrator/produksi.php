<?php 
$page='Produksi';
include "header.php"; 
if(!empty($_GET['alert'])){
    $alert = $_GET['alert'];
    if($alert=='cancel'){
        echo "<script>Swal.fire({title: 'Batal',text: 'Batal menambahkan data produksi',icon: 'warning',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='success'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil menambahkan data produksi',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='cancel-edit'){
        echo "<script>Swal.fire({title: 'Batal',text: 'Batal mengubah data produksi',icon: 'warning',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='delete-success'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil menghapus data produksi',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='success-edit'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil mengubah data produksi',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='incomplete'){
        echo "<script>Swal.fire({title: 'Gagal',text: 'Form belum lengkap',icon: 'error',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='server-error'){
        echo "<script>Swal.fire({title: 'Gagal',text: 'Terjadi gangguan pada server',icon: 'error',confirmButtonText: 'OK'})</script>";
    }
}
?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
        	<div class="page-header">
				<h4 class="page-title">Produksi</h4>
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
						<a href="produksi.php">Produksi</a>
					</li>
				</ul>
			</div>
            <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body py-3">
						    <a class="btn btn-primary mb-3" href="produksi_add.php">+ TAMBAH</a>
							<div class="table-responsive">
								<table id="basic-datatables" class="display table table-striped table-hover" >
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Produk</th>
											<th>Tanggal</th>
											<th>Berat</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										    $i = 1;
										    while($d=mysqli_fetch_assoc($produksi)){
										        echo "
										            <tr>
										                <td>$i</td>
										                <td>$d[produk]</td>
										                <td>$d[tgl]</td>
										                <td>$d[berat]</td>
										                <td class='p-0'>
    										                <a href='produksi_edit.php?id=$d[id]' class='btn btn-sm btn-warning mr-2 mb-2'><i class='fas fa-pen' data-toggle='tooltip' data-placement='bottom' title='Edit'></i></a>    										                </div>
										                </td>
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