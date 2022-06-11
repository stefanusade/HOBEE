<?php
$page = 'Stok';
include "header.php";
$id_sup = $me['id_supplier'];
$stok = mysqli_query($conn, "SELECT * FROM stok_supplier WHERE id_supplier='$id_sup'");
$s = mysqli_fetch_assoc($stok);
if(!empty($_GET['alert'])){
    $alert = $_GET['alert'];
    if($alert=='success'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil mengubah data stok',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='cancel-edit'){
        echo "<script>Swal.fire({title: 'Batal',text: 'Batal mengubah data edukasi',icon: 'warning',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='delete-success'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil menghapus data edukasi',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='success-edit'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil mengubah data edukasi',icon: 'success',confirmButtonText: 'OK'})</script>";
    }
}
?>

<script type="text/javascript" src="../../assets/ckeditor/ckeditor.js"></script>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
				<h4 class="page-title">Kelola Stok</h4>
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
					    <a href="#">Ubah Stok</a>
					</li>
				</ul>
			</div>
            <div class="row">
    			<div class="col-md-12">
    				<div class="card">
    					<div class="card-body py-3">
    					    <form action="./edit/stok.php" method="post">
    					        <div class="row mt-3">
    					            <div class="col-6">
    					                <label for="stok">Stok (dalam Liter)</label>
    					                <input type="hidden" name="id" value="<?=$me['id_supplier'];?>">
        					            <input class="form-control" type="number" name="stok" id="stok" value="<?= $s['kuantitas']; ?>" required>
    					            </div>
    					            <div class="col-6">
    					                <label for="harga">Harga Satuan (dalam Rupiah/Liter)</label>
        					            <input class="form-control" type="number" name="harga" id="harga" value="<?= $s['harga']; ?>" required>
    					            </div>
    					        </div>
        					    <div class="mt-3">
        					        <label for="ket">Keterangan</label>
                                    <textarea class="ckeditor" id="ket" name="ket" required><?= $s['keterangan']; ?></textarea>
        					    </div>
    					        <input class="btn btn-primary btn-block my-3" type="submit" name="submit" id="submit" value="SIMPAN">
                            </form>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    
<script>
    $("#submit").click(function(){
        var stok = $("#stok").val();
        var harga = $("#harga").val();
        if(stok==''||harga==''){
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