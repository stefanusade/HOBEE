<?php 
$page='Permintaan';
include "header.php"; 
$userid = $me['id_supplier'];
$list = mysqli_query($conn,"SELECT p.*, s.status_permintaan AS status FROM permintaan_stok p, status_permintaan s WHERE id_supplier='$userid' AND s.id_status_permintaan = p.id_status_permintaan")
?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
        	<div class="page-header">
				<h4 class="page-title">Rekap Permintaan</h4>
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
					    <a href="permintaan.php">Permintaan</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
					    <a href="#">Rekapitulasi</a>
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
											<th>Tanggal Permintaan</th>
											<th>Rincian</th>
											<th>Status</th>
											<th>Qty</th>
											<th>Harga</th>
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

<?php include "footer.php"; ?>