<?php 
$page	= 'Keuangan';
include "header.php"; 
$adm	= $me['id_admin'];
?>

<div class="main-panel">
	<div class="content">
		<div class="page-inner">
        	<div class="page-header">
				<h4 class="page-title">Tambah Data Pemasukan</h4>
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
						<a href="#">Pemasukan</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
					    <a href="#">Tambah Data Pemasukan</a>
					</li>
				</ul>
			</div>
            <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body py-3">
						    <form method="POST" action="./add/pemasukan.php" autocomplete="off">
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="mt-3" for="tgl">Tanggal Pemasukan <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="tgl" id="tgl" required>
                                      	<input type="hidden" name="id" value="<?= $adm; ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-3" for="rincian">Rincian Pemasukan <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="rincian" id="rincian" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-3" for="nominal">Nominal Pemasukan <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" name="nominal" id="nominal" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="mt-3" for="keterangan">Keterangan</label>
                                        <div class="input-group mb-3">
                                            <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn-block btn btn-primary mt-3" name="submit" id="submit" value="SIMPAN">
                                
                            </form>
					    </div>
				    </div>
			    </div>
			</div>
		</div>
	</div>
</div>
<script>
    $("#submit").click(function(){
        var tgl = $("#tgl").val();
        var rincian = $("#rincian").val();
        var nominal = $("#nominal").val();
        if(tgl==''||rincian==''||nominal==''){
            Swal.fire({
                title:'Form Belum Lengkap',
                text:'Mohon periksa kembali bidang yang belum terisi',
                icon:'warning',
                button:'OK',
            });
        }
    })
</script>
<?php include "footer.php"; ?>