<?php 
$page='Akun';
include "header.php"; ?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
        	<div class="page-header">
				<h4 class="page-title">Customer</h4>
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
					    <a href="#">Customer</a>
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
											<th>Nama</th>
											<th>Email</th>
											<th>Alamat</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										    $i = 1;
										    while($d=mysqli_fetch_assoc($cust)){
										        $alamat = $d['jalan']." ".$d['no'].", ".ucwords(strtolower($d['kota']));
										        echo "
										            <tr>
										                <td>$i</td>
										                <td>$d[nama]</td>
										                <td>$d[email]</td>
										                <td>$alamat</td>
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