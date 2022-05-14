<?php
$page = 'Edukasi';
include "header.php";

if(!isset($_GET['id'])){
    header('location:edukasi.php?alert=choose');
}

$edu_id = $_GET['id'];
$fetch = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM edukasi WHERE id_edukasi='$edu_id'"));
?>

<script type="text/javascript" src="../../assets/ckeditor/ckeditor.js"></script>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
				<h4 class="page-title">Edit Edukasi</h4>
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
					    <a href="#">Edit Edukasi</a>
					</li>
				</ul>
			</div>
            <div class="row">
    			<div class="col-md-12">
    				<div class="card">
    					<div class="card-body py-3">
    					    <a href="edukasi.php?alert=cancel-edit" class="btn btn-danger">BATALKAN</a> 
    					    <form action="./edit/edukasi.php" method="post" enctype="multipart/form-data">
    					        <div class="mt-3">
    					            <label for="judul">Judul Konten</label>
    					            <input class="form-control" type="hidden" name="id" id="id" value="<?= $_GET['id'];?>" readonly required>
        					        <input class="form-control" type="text" name="judul" id="judul" value="<?= $fetch['judul'];?>" readonly required>
    					        </div>
    					        <div class="row mt-3">
    					            <div class="col-6">
    					                <label for="author">Author</label>
        					            <input class="form-control" type="text" name="author" id="author" value="<?= $username; ?>" readonly required>
    					            </div>
    					            <div class="col-6">
    					                <label for="tgl">Tanggal</label>
        					            <input class="form-control" type="datetime-local" name="tgl" id="tgl" value="<?= date('Y-m-d',strtotime($fetch['tgl_post'])).'T'.date('H:i',strtotime($fetch['tgl_post']));?>" readonly required>
    					            </div>
    					        </div>
    					        <div class="mt-3">
        					        <label for="sampul">Gambar Sampul (maks. 5MB)</label>
                                    <input class="form-control" type="file" name="sampul" id="sampul" >
        					    </div> 
        					    <div class="mt-3">
        					        <label for="content">Isi Konten</label>
                                    <textarea class="ckeditor" id="content" name="content" required><?= $fetch['konten'];?></textarea>
        					    </div>  
        					    <div class="mt-3">
    					            <label for="link">Link Video Youtube (contoh: https://www.youtube.com/watch?v=aBcDeF)</label>
        					        <input class="form-control" type="url" name="link" id="link" value="https://www.youtube.com/watch?v=<?= $fetch['link_video'];?>" required>
    					        </div>
    					        <input class="btn btn-primary form-control my-3" type="submit" name="submit" id="submit" value="PERBARUI">
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
        var content = CKEDITOR.instances['DSC'].getData();
        var link = $("#link").val();
        if(content==''||link==''){
            Swal.fire({
                title:'Form Belum Lengkap',
                text:'Mohon periksa kembali bidang yang belum terisi',
                icon:'warning',
                confirmButtonText:'OK',
            });
        }
    })
    
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