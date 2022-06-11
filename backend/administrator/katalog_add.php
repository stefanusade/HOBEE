<?php
$page = 'Katalog';
include "header.php";

?>

<script type="text/javascript" src="../../assets/ckeditor/ckeditor.js"></script>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
				<h4 class="page-title">Tambah Produk</h4>
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
					    <a href="#">Tambah Produk</a>
					</li>
				</ul>
			</div>
            <div class="row">
    			<div class="col-md-12">
    				<div class="card">
    					<div class="card-body py-3">
    					    <a href="katalog.php?alert=cancel" class="btn btn-danger">BATALKAN</a> 
    					    <form action="./add/katalog.php" method="post" enctype="multipart/form-data">
    					        <div class="row mt-3">
    					            <div class="col-6">
    					                <label for="produk">Nama Produk</label>
        					            <input class="form-control" type="text" name="produk" id="produk" required>
    					            </div>
    					            <div class="col-6">
    					                <label for="tgl">Nomor Seri</label>
        					            <input class="form-control" type="number" name="seri" id="seri" required>
    					            </div>
    					        </div>
    					        <div class="mt-3">
        					        <label for="foto">Foto Produk (maks. 5MB)</label>
                                    <input class="form-control" type="file" name="foto" id="foto"  required>
        					    </div> 
    					        <div class="row mt-3">
    					            <div class="col-6">
    					                <label for="produk">Harga</label>
        					            <input class="form-control" type="text" name="harga" id="harga" required>
    					            </div>
    					            <div class="col-6">
    					                <label for="tgl">Berat (kg)</label>
        					            <input class="form-control" type="number" name="berat" id="berat" required>
    					            </div>
    					        </div>
    					        <div class="row mt-3">
    					            <div class="col-6">
    					                <label for="produk">Tanggal Produksi</label>
        					            <input class="form-control" type="date" name="tgl_prod" id="tgl_prod" required>
    					            </div>
    					            <div class="col-6">
    					                <label for="tgl">Tanggal Kadaluarsa</label>
        					            <input class="form-control" type="date" name="tgl_exp" id="tgl_exp" required>
    					            </div>
    					        </div>
        					    <div class="mt-3">
        					        <label for="content">Keterangan</label>
                                    <textarea class="ckeditor" id="desc" name="desc" required></textarea>
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