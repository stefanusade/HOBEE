<?php 
$page='Akun';
include "header.php"; ?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
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
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										    $i = 1;
										    while($d=mysqli_fetch_assoc($adm)){
										        $alamat = $d['jalan']." ".$d['no'].", ".ucwords(strtolower($d['kota']));
										        echo "
										            <tr>
										                <td>$i</td>
										                <td>$d[nama]</td>
										                <td>$d[email]</td>
										                <td>$alamat</td>
										                <td>
										                <form action='details.php' method='POST'>
										                <input type='hidden' name='role' value='admin'/>
										                <button class='btn btn-sm btn-primary' type='submit' name='lihat' value='$d[id]'><i class='fas fa-eye'></i></button>
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