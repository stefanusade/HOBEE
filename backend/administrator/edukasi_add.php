<?php include "footer.php"; ?><?php
$page = 'Edukasi';
include "header.php";

?>

<script type="text/javascript" src="../../assets/ckeditor/ckeditor.js"></script>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
				<h4 class="page-title">Tambah Edukasi</h4>
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
						<a href="edukasi.php">Edukasi</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
					    <a href="#">Tambah Edukasi</a>
					</li>
				</ul>
			</div>
            <div class="row">
    			<div class="col-md-12">
    				<div class="card">
    					<div class="card-body py-3">
    					    <a href="edukasi.php?alert=cancel" class="btn btn-danger">BATALKAN</a> 
    					    <form action="./add/edukasi.php" method="post" enctype="multipart/form-data">
    					        <div class="mt-3">
    					            <label for="judul">Judul Konten</label>
        					        <input class="form-control" type="text" name="judul" id="judul" required>
    					        </div>
    					        <div class="row mt-3">
    					            <div class="col-6">
    					                <label for="author">Author</label>
        					            <input class="form-control" type="text" name="author" id="author" value="<?= $username; ?>" readonly required>
    					            </div>
    					            <div class="col-6">
    					                <label for="tgl">Tanggal</label>
        					            <input class="form-control" type="datetime-local" name="tgl" id="tgl" required>
    					            </div>
    					        </div>
    					        <div class="mt-3">
        					        <label for="sampul">Gambar Sampul (maks. 5MB)</label>
                                    <input class="form-control" type="file" name="sampul" id="sampul"  required>
        					    </div> 
        					    <div class="mt-3">
        					        <label for="content">Isi Konten</label>
                                    <textarea class="ckeditor" id="content" name="content" required></textarea>
        					    </div>  
        					    <div class="mt-3">
    					            <label for="link">Link Video Youtube (contoh: https://www.youtube.com/watch?v=aBcDeF)</label>
        					        <input class="form-control" type="url" name="link" id="link" required>
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
        var judul = $("#judul").val();
        var author = $("#author").val();
        var tgl = $("#tgl").val();
        var content = CKEDITOR.instances['DSC'].getData();
        var link = $("#link").val();
        if(judul==''||tgl==''||content==''||link==''){
            Swal.fire({
                title:'Form Belum Lengkap',
                text:'Mohon periksa kembali bidang yang belum terisi',
                icon:'warning',
                confirmButtonText:'OK',
            });
        }
    });
    
    $("#sampul").change(function(){
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
<?php include "footer.php"; ?>