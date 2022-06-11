<?php 
$page	= 'Produksi';
include "header.php"; 
if(!isset($_GET['id'])){
    header('Location:produksi.php');
}
$id     = $_GET['id'];
$data   = mysqli_query($conn, "SELECT * FROM produksi WHERE id_produksi='$id'");
$d      = mysqli_fetch_assoc($data);
?>

<div class="main-panel">
	<div class="content">
		<div class="page-inner">
        	<div class="page-header">
				<h4 class="page-title">Ubah Data Produksi</h4>
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
						<a href="produksi.php">Produksi</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
					    <a href="#">Ubah Data Produksi</a>
					</li>
				</ul>
			</div>
            <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body py-3">
						    <form method="POST" action="./edit/produksi.php" autocomplete="off">
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="mt-3" for="tgl">Tanggal Produksi <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="tgl" id="tgl" value="<?= $d['tanggal_produksi']; ?>" required>
                                      	<input type="hidden" name="id" value="<?= $d['id_produksi']; ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-3" for="select-data">Produk <span class="text-danger">*</span></label>
                                        <select class="form-control" name="produk" id="produk">
                                            <option selected>Pilih Produk</option>
                                            <?php while($p = mysqli_fetch_assoc($prod)):?>
                                            <option value="<?= $p['id_produk'];?>" <?php if($d['id_produk']==$p['id_produk']){echo"selected";}?>><?= $p['nama_produk'];?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-3" for="berat">Berat (kg) <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" name="berat" id="berat" value="<?= $d['berat']; ?>" placeholder="Berat Hasil Produksi">
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
        var produk = $("#produk").val();
        var berat = $("#berat").val();
        if(tgl==''||produk==''||berat==''){
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