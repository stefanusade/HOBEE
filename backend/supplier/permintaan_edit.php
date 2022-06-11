<?php
$page = 'Permintaan';
include "header.php";
if(!isset($_GET['id'])){
    header('Location:permintaan.php');
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
    					    <a href="permintaan.php" class="btn btn-danger">BATAL</a> 
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
                                        <p class="m-2"><?= $s['rincian_permintaan']; ?></p>
            					    </div> 
            					    <div class="col-6 mt-3">
            					        <label for="qty">Kuantitas</label>
                                        <p class="m-2"><?= $s['kuantitas']; ?></p>
            					    </div>
            					    <div class="col-6 mt-3">
    					                <label for="tgl">Tanggal Permintaan</label>
        					            <p class="m-2"><strong><?= date('d/m/Y',strtotime($s['tanggal_permintaan'])); ?></strong></p>
    					            </div>
            					    <div class="col-6 mt-3">
    					                <label for="tglk">Tanggal Dikirim</label>
                                        <input class="form-control" type="date" name="tgl" id="tgl" value="<?= $s['tanggal_kirim']; ?>"  required>
    					            </div>
    					            <div class="col-6 mt-3">
    					                <label for="tglt">Tanggal Diterima</label>
                                        <p class="m-2"><strong><?php
                                        if(!empty($s['tanggal_diterima'])){
                                            echo date('d/m/Y',strtotime($s['tanggal_diterima'])); 
                                        } ?></strong></p>
    					            </div>
    					        </div>
        					    <div class="mt-3">
    					            <label for="link">Keterangan</label>
    					            <p class="m-2"><?= $s['keterangan']; ?></p>
    					        </div>
    					        <input class="btn btn-primary btn-block my-3" type="submit" name="submit" id="submit" value="UBAH PERMINTAAN">
                            </form>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

<script>
    $("#submit").click(function(){
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