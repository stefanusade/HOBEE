<?php
$page = 'Stok';
include "header.php";
if(!isset($_GET['id'])){
    header('Location:stok.php');
}
$id = $_GET['id'];
$s = mysqli_fetch_assoc(mysqli_query($conn, "SELECT p.*, s.nama_supplier FROM permintaan_stok p, supplier s 
WHERE p.id_supplier=s.id_supplier AND p.id_permintaan='$id'"));
?>

<script type="text/javascript" src="../../assets/ckeditor/ckeditor.js"></script>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
				<h4 class="page-title">Ubah Permintaan</h4>
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
						<a href="permintaan.php">Permintaan</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
					    <a href="#">Ubah Permintaan</a>
					</li>
				</ul>
			</div>
            <div class="row">
    			<div class="col-md-12">
    				<div class="card">
    					<div class="card-body py-3">
    					    <a href="stok.php" class="btn btn-danger">BATAL UBAH</a> 
    					    <form action="./edit/permintaan.php" method="post">
    					        <div class="row mt-3">
    					            <div class="col-6">
    					                <label for="supplier">Supplier</label>
        					            <p class="m-2"><strong><?= $s['nama_supplier']; ?></strong></p>
        					            <input type="hidden" name="id" value="<?= $id; ?>">
    					            </div>
    					            <div class="col-6">
    					                <label for="supplier">Harga</label>
        					            <p class="m-2"><strong><?= $s['harga']; ?></strong></p>
    					            </div>
    					            <div class="col-12 mt-3">
            					        <label for="rincian">Rincian</label>
                                        <input class="form-control" type="text" name="rincian" id="rincian" value="<?= $s['rincian_permintaan']; ?>"  required>
            					    </div> 
            					    <div class="col-6 mt-3">
            					        <label for="qty">Kuantitas</label>
                                        <input class="form-control" type="number" name="qty" id="qty" value="<?= $s['kuantitas']; ?>"  required>
            					    </div>
            					    <div class="col-6 mt-3">
    					                <label for="tgl">Tanggal Permintaan</label>
        					            <p class="m-2"><strong><?= $s['tanggal_permintaan']; ?></strong></p>
    					            </div>
            					    <div class="col-6 mt-3">
    					                <label for="tglk">Tanggal Dikirim</label>
        					            <p class="m-2"><strong><?= $s['tanggal_kirim']; ?></strong></p>
    					            </div>
    					            <div class="col-6 mt-3">
    					                <label for="tglt">Tanggal Diterima</label>
                                        <input class="form-control" type="date" name="tgl" id="tgl" value="<?= $s['tanggal_diterima']; ?>"  required>
    					            </div>
    					        </div>
        					    <div class="mt-3">
    					            <label for="link">Keterangan</label>
        					        <textarea class="ckeditor" id="ket" name="ket" required><?= $s['keterangan']; ?></textarea>
    					        </div>
    					        <input class="btn btn-primary form-control my-3" type="submit" name="submit" id="submit" value="UBAH PERMINTAAN">
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
        var rincian = $("#rincian").val();
        var tgl = $("#tgl").val();
        if(rincian==''||tgl==''){
            Swal.fire({
                title:'Form Belum Lengkap',
                text:'Mohon periksa kembali bidang yang belum terisi',
                icon:'warning',
                confirmButtonText:'OK',
            });
        }
    })
</script>

<?php include "footer.php"; ?>