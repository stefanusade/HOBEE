<?php 
$page='Permintaan';
include "header.php"; 
$userid = $me['id_supplier'];
$list = mysqli_query($conn,"SELECT p.*, s.status_permintaan AS status FROM permintaan_stok p, status_permintaan s WHERE id_supplier='$userid' AND s.id_status_permintaan = p.id_status_permintaan AND p.id_status_permintaan='1'")
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
				    <a class="btn btn-warning my-3" href="permintaan_rekap.php">REKAPITULASI</a>
							<div class="row">
								
										<?php 
										    $i = 1;
										    while($d=mysqli_fetch_assoc($list)){
										        if($d['status']=='Diproses'){
										            $status="<p class='badge badge-warning m-0'>Diproses</p>";
										        }elseif($d['status']=='Selesai'){
										            $status="<p class='badge badge-success m-0'>Success</p>";
										        }
										        echo "
										            <div class='col-lg-4 col-md-6'>
										                <div class='card'>
										                    <div class='card-body'>
										                        <div class='d-flex bd-highlight'>
										                            <div class='bd-highlight p-2'>
										                                <h3>$d[rincian_permintaan]</h3>
										                            </div>
										                            <div class='bd-highlight p-2'>
										                                $status
										                            </div>
										                        </div>
										                        <div class='p-2'>
										                            <p><strong>Tanggal:</strong> $d[tanggal_permintaan]</p>
    										                        <p><strong>Qty:</strong> $d[kuantitas]</p>
    										                        <p><strong>Harga:</strong> $d[harga]</p>
										                        </div>
										                    </div>
										                </div>
										          `</div>
										        ";
										        $i++;
										    }
										?>
				    </div>
			    </div>
			</div>
		</div>
	</div>

<?php include "footer.php"; ?>