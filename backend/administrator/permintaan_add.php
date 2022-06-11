<?php
$page = 'Permintaan';
include "header.php";
if(!isset($_GET['id'])){
    header('Location:stok.php');
}
$id = $_GET['id'];
$s = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ss.*, s.nama_supplier FROM stok_supplier ss, supplier s 
WHERE ss.id_supplier=s.id_supplier AND ss.id_supplier='$id'"));
?>

<script type="text/javascript" src="../../assets/ckeditor/ckeditor.js"></script>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
				<h4 class="page-title">Tambah Permintaan</h4>
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
						<a href="stok.php">Stok</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
					    <a href="#">Tambah Permintaan</a>
					</li>
				</ul>
			</div>
            <div class="row">
    			<div class="col-md-12">
    				<div class="card">
    					<div class="card-body py-3">
    					    <a href="stok.php" class="btn btn-danger">BATAL</a> 
    					    <form action="./add/permintaan.php" method="post">
    					        <div class="row mt-3">
    					            <div class="col-6">
    					                <label for="supplier">Supplier</label>
        					            <p class="my-2"><strong><?= $s['nama_supplier']; ?></strong></p>
        					            <input type="hidden" name="id" value="<?= $id; ?>">
    					            </div>
    					            <div class="col-6">
    					                <label for="supplier">Harga</label>
        					            <p class="my-2"><strong><?= $s['harga']; ?></strong></p>
        					            <input type="hidden" name="harga" value="<?= $s['harga']; ?>">
    					            </div>
    					            <div class="col-12 mt-3">
            					        <label for="rincian">Rincian</label>
                                        <input class="form-control" type="text" name="rincian" id="rincian"  required>
            					    </div> 
            					    <div class="col-6 mt-3">
    					                <label for="tgl">Tanggal Permintaan</label>
        					            <input class="form-control" type="date" name="tgl" id="tgl" required>
    					            </div>
            					    <div class="col-6 mt-3">
            					        <label for="qty">Kuantitas</label>
                                        <input class="form-control" type="number" name="qty" id="qty" max="<?= $s['kuantitas']; ?>" required>
            					    </div>
    					        </div>
        					    <div class="mt-3">
    					            <label for="link">Keterangan</label>
        					        <textarea class="ckeditor" id="ket" name="ket" required></textarea>
    					        </div>
    					        <input class="btn btn-primary btn-block my-3" type="submit" name="submit" id="submit" value="SIMPAN">
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
        var qty = $("#qty").val();
        if(rincian==''||tgl==''){
            Swal.fire({
                title:'Form Belum Lengkap',
                text:'Mohon periksa kembali bidang yang belum terisi',
                icon:'warning',
                confirmButtonText:'OK',
            });
        }
    });
    $("#qty").keyup(function(){
        if($(this).val()>parseInt(<?= $s['kuantitas']; ?>)){
            Swal.fire({
                title:'Stok Kurang',
                text:'Maksimal permintaan stok <?= $s['kuantitas']; ?>',
                icon:'warning',
                confirmButtonText:'OK',
            });
            $(this).val('');
        }
    });
</script>

<?php include "footer.php"; ?>