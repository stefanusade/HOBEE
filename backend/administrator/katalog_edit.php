<?php
$page = 'Katalog';
include "header.php";
if(!isset($_GET['id'])){
    header('Location:katalog.php?alert=choose');
}
$id = $_GET['id'];
$get = mysqli_query($conn,"SELECT * FROM produk WHERE id_produk='$id'");
$d = mysqli_fetch_assoc($get);
?>

<script type="text/javascript" src="../../assets/ckeditor/ckeditor.js"></script>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
				<h4 class="page-title">Edit Produk</h4>
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
						<a href="katalog.php">Katalog</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
					    <a href="#">Edit Produk</a>
					</li>
				</ul>
			</div>
            <div class="row">
    			<div class="col-md-12">
    				<div class="card">
    					<div class="card-body py-3">
    					    <a href="katalog.php?alert=cancel-edit" class="btn btn-danger">BATALKAN</a> 
    					    <form action="./edit/katalog.php" method="post" enctype="multipart/form-data">
    					        <div class="row mt-3">
    					            <div class="col-6">
    					                <label for="produk">Nama Produk</label>
    					                <input type="hidden" name="id" value="<?= $id; ?>">
        					            <input class="form-control" type="text" name="produk" id="produk" value="<?= $d['nama_produk']; ?>" required>
    					            </div>
    					            <div class="col-6">
    					                <label for="tgl">Nomor Seri</label>
        					            <p class="p-2"><?= $d['nomor_seri']; ?></p>
    					            </div>
    					        </div>
    					        <div class="mt-3">
        					        <label for="foto">Foto Produk (maks. 5MB)</label>
                                    <input class="form-control" type="file" name="foto" id="foto">
        					    </div> 
    					        <div class="row mt-3">
    					            <div class="col-6">
    					                <label for="produk">Harga</label>
        					            <input class="form-control" type="text" name="harga" id="harga" value="<?= $d['harga']; ?>" required>
    					            </div>
    					            <div class="col-6">
    					                <label for="tgl">Berat (kg)</label>
        					            <input class="form-control" type="number" name="berat" id="berat" value="<?= $d['berat']; ?>" required>
    					            </div>
    					        </div>
    					        <div class="row mt-3">
    					            <div class="col-6">
    					                <label for="produk">Tanggal Produksi</label>
        					            <input class="form-control" type="date" name="tgl_prod" id="tgl_prod" value="<?= $d['tanggal_produksi']; ?>" required>
    					            </div>
    					            <div class="col-6">
    					                <label for="tgl">Tanggal Kadaluarsa</label>
        					            <input class="form-control" type="date" name="tgl_exp" id="tgl_exp" value="<?= $d['tanggal_kadaluarsa']; ?>" required>
    					            </div>
    					        </div>
        					    <div class="mt-3">
        					        <label for="content">Keterangan</label>
                                    <textarea class="ckeditor" id="desc" name="desc" required><?= $d['keterangan']; ?></textarea>
        					    </div> 
    					        <input class="btn btn-primary form-control my-3" type="submit" name="submit" id="submit" value="SIMPAN">
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
        var produk = $("#produk").val();
        var seri = $("#seri").val();
        var harga = $("#harga").val();
        var berat = $("#berat").val();
        var tgl_prod = $("#tgl_prod").val();
        var tgl_exp = $("#tgl_exp").val();
        var desc = CKEDITOR.instances['DSC'].getData();
        if(produk==''||seri==''||desc==''||tgl_prod==''||tgl_exp==''||harga==''||berat==''){
            Swal.fire({
                title:'Form Belum Lengkap',
                text:'Mohon periksa kembali bidang yang belum terisi',
                icon:'warning',
                confirmButtonText:'OK',
            });
        }
    });
    
    $("#foto").change(function(){
        var allowed = ['jpg','jpeg','png'];
        if($.inArray($(this).val().split('.').pop().toLowerCase(), allowed)==-1){
            Swal.fire({
                title:'File Tidak Diizinkan',
                text:'Format file yang diperbolehkan (.jpeg, .jpg, .png)',
                icon:'warning',
                confirmButtonText:'OK',
            });
            $(this).val('');
        }
    })
</script>