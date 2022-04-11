<?php 
$page = 'Dashboard';
include "header.php"; ?>
    <div class="main-panel">
			<div class="content">
				<div class="panel-header">
					<div class="page-inner py-5 bg-warning-gradient">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row ">
							<div>
								<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
							</div>
							
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row mt-2">
						
						<div class="col-sm-6 col-lg-3">
							<div class="card p-3">
								<div class="d-flex align-items-center">
									<span class="stamp stamp-md bg-danger mr-3">
										<i class="fa fa-users"></i>
									</span>
									<div>
										<h5 class="mb-1"><b><a href="supplier.php"><?= mysqli_num_rows($supp); ?> <small>Supplier</small></a></b></h5>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php include "footer.php"; ?>