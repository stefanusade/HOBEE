<?php
$page = 'Stok';
include "header.php";
$stok = mysqli_query($conn,"SELECT ss.*, s.nama_supplier FROM stok_supplier ss, supplier s WHERE ss.id_supplier=s.id_supplier ORDER BY harga");
?>

<div class="main-panel">
	<div class="content">
		<div class="page-inner">
        	<div class="page-header">
				<h4 class="page-title">Data Stok Supplier</h4>
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
						<a href="#">Data Stok</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
					    <a href="#">Data Stok Supplier</a>
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
											<th>Nama Supplier</th>
											<th>Kuantitas</th>
											<th>Harga</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										    $i = 1;
										    while($d=mysqli_fetch_assoc($stok)){
										        
										        echo "
										            <tr>
										                <td>$i</td>
										                <td>$d[nama_supplier]</td>
										                <td>$d[kuantitas]</td>
										                <td>$d[harga]</td>
										                <td>
										                <form action='details.php' method='POST'>
										                <input type='hidden' name='permintaan' value='1'>
										                <button class='btn btn-sm btn-primary' type='submit' name='lihat' value='$d[id_supplier]' data-toggle='tooltip' data-placement='bottom' title='Lihat'><i class='fas fa-eye'></i></button>
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