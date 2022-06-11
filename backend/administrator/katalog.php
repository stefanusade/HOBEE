<?php 
$page='Katalog';
include "header.php"; 
if(!empty($_GET['alert'])){
    $alert = $_GET['alert'];
    if($alert=='cancel'){
        echo "<script>Swal.fire({title: 'Batal',text: 'Batal menambahkan data katalog',icon: 'warning',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='success'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil menambahkan data katalog',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='cancel-edit'){
        echo "<script>Swal.fire({title: 'Batal',text: 'Batal mengubah data katalog',icon: 'warning',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='delete-success'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil menghapus data katalog',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='success-edit'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil mengubah data katalog',icon: 'success',confirmButtonText: 'OK'})</script>";
    }
}
?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
        	<div class="page-header">
				<h4 class="page-title">Katalog</h4>
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
						<a href="edukasi.php">Katalog</a>
					</li>
				</ul>
			</div>
            <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body py-3">
						    <a class="btn btn-primary mb-3" href="katalog_add.php">+ TAMBAH</a>
							<div class="table-responsive">
								<table id="nosort" class="display table table-striped table-hover" >
									<thead>
										<tr>
											<th style='max-width:110px'>Foto Produk</th>
											<th>Nama Produk</th>
											<th>Harga</th>
											<th>Berat</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										    $i = 1;
										    while($d=mysqli_fetch_assoc($prod)){
										        $harga = "Rp ".number_format(intval($d['harga']),0,',','.');
										        echo "
										            <tr>
										                <td style='max-width:110px'><img src='../../assets/uploads/produk/$d[foto_produk]' style='max-height:100px'</td>
										                <td>$d[nama_produk]</td>
										                <td>$harga</td>
										                <td>$d[berat]</td>
										                <td class='p-0'>
    										                <div class='row'>
    										                        <a href='../../katalog.php?id=$d[id_produk]' target='_blank' class='btn btn-sm btn-primary mr-2 mb-2' data-toggle='tooltip' data-placement='bottom' title='Lihat'><i class='fas fa-eye'></i></a>
    										                        <a href='katalog_edit.php?id=$d[id_produk]' class='btn btn-sm btn-warning mr-2 mb-2'><i class='fas fa-pen' data-toggle='tooltip' data-placement='bottom' title='Edit'></i></a>    										                </div>
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