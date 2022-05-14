<?php include "header.php"; 
$daftar_kota = mysqli_query($conn,"SELECT * FROM kota");
?>

<div class="main-panel">
	<div class="content">
	    <div class="panel-header">
    		<div class="page-inner py-5 bg-warning-gradient">
    			<div class="d-flex justify-content-center" >
    				<div class="avatar avatar-xl">
    					<img src="../../assets/uploads/profile/<?=$profpic;?>" alt="..." class="avatar-img rounded-circle" style="z-index:1">
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="page-inner">
		    <div class="card">
		        <div class="card-body">
		        <form method="POST" action="./edit/profpic.php" enctype="multipart/form-data">
                <h4>Ubah Foto Profil</h4>
                <div class="row mb-3">
                    <div class="col-12">
                        <label class="mt-3" for="profpic">Foto Profil <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="profpic" id="profpic" required>
                    </div>
                </div>
                <input type="submit" class="form-control btn btn-primary mt-3" name="submit" value="UBAH FOTO">
        </form>
        		    <a class="btn btn-block btn-danger mt-2" href="akun_edit.php">BATALKAN</a>
		        </div>
		    </div>   
	    </div>
	</div>
</div>
<script>
    $("#profpic").change(function(){
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