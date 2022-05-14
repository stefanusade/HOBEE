<?php 
$page='Permintaan';
include "header.php";
$list = mysqli_query($conn,"SELECT p.*, s.status_permintaan AS status, su.nama_supplier AS supplier
FROM permintaan_stok p, status_permintaan s, supplier su
WHERE s.id_status_permintaan = p.id_status_permintaan AND su.id_supplier = p.id_supplier");
if(!empty($_GET['alert'])){
    $alert = $_GET['alert'];
    if($alert=='cancel'){
        echo "<script>Swal.fire({title: 'Batal',text: 'Batal menambahkan data permintaan',icon: 'warning',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='success'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil menambahkan data permintaan',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='cancel-edit'){
        echo "<script>Swal.fire({title: 'Batal',text: 'Batal mengubah data permintaan',icon: 'warning',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='delete-success'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil menghapus data permintaan',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='edit-success'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil mengubah data permintaan',icon: 'success',confirmButtonText: 'OK'})</script>";
    }
}
?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
        	<div class="page-header">
				<h4 class="page-title">Permintaan</h4>
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
					    <a href="#">Permintaan</a>
					</li>
				</ul>
			</div>
            <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body py-3">
							<div class="table-responsive">
								<table id="basic-datatables" class="display table table-striped table-hover" >
									<thead>
										<tr>
											<th>No</th>
											<th>Tanggal</th>
											<th>Rincian</th>
											<th>Status</th>
											<th>Qty</th>
											<th>Harga</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										    $i = 1;
										    while($d=mysqli_fetch_assoc($list)){
										        if($d['status']=='Diproses'){
										            $status="<p class='badge badge-warning m-0'>Diproses</p>";
										        }elseif($d['status']=='Selesai'){
										            $status="<p class='badge badge-success m-0'>Success</p>";
										        }
										        echo "
										            <tr>
										                <td>$i</td>
										                <td>$d[tanggal_permintaan]</td>
										                <td>$d[rincian_permintaan]</td>
										                <td>$status</td>
										                <td>$d[kuantitas]</td>
										                <td>$d[harga]</td>
										                <td>
										                    <a href='permintaan_edit.php?id=$d[id_permintaan]' class='btn btn-sm btn-warning mr-2 mb-2'><i class='fas fa-pen'></i></a>
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