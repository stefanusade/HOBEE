<?php 
$page='Pesanan';
include "header.php"; 
if(!empty($_GET['alert'])){
    $alert = $_GET['alert'];
    if($alert=='cancel-edit'){
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
				<h4 class="page-title">Pesanan</h4>
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
						<a href="pesanan.php">Pesanan</a>
					</li>
				</ul>
			</div>
            <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body py-3">
							<div class="table-responsive">
								<table id="nosort" class="display table table-striped table-hover" >
									<thead>
										<tr>
											<th>ID</th>
											<th>Nama Produk</th>
											<th>Harga</th>
											<th>Qty</th>
											<th>Status</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										    $i = 1;
										    while($d=mysqli_fetch_assoc($order)){
										        $harga = "Rp ".number_format(intval($d['harga']),0,',','.');
										        echo "
										            <tr>
										                <td>$d[id]</td>
										                <td>$d[nama_produk]</td>
										                <td>$harga</td>
										                <td>$d[qty]</td>
										                <td>
										                    <p class='m-0'>Pembayaran: $d[bayar]</p>
										                    <p class='m-0'>Pesanan: $d[status]</p>
										                </td>
										                <td class='p-0'>
										                    <a href='pesanan_view.php?id=$d[id]' class='btn btn-sm btn-primary mr-2 mb-2'><i class='fas fa-eye' data-toggle='tooltip' data-placement='bottom' title='Lihat'></i></a>    	
    										                <a href='pesanan_edit.php?id=$d[id]' class='btn btn-sm btn-warning mr-2 mb-2'><i class='fas fa-pen' data-toggle='tooltip' data-placement='bottom' title='Ubah Status Pesanan'></i></a>    										                </div>
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