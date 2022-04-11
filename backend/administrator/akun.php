<?php include "header.php"; 
$daftar_kota = mysqli_query($conn,"SELECT * FROM kota");
?>

<div class="main-panel">
	<div class="content">
		<div class="page-inner">
		    <div class="page-header">
		        <h4 class="page-title">Akun Saya</h4>
		    </div>
		    <div class="card">
		        <div class="card-body">
		            
        		        <form method="POST" action="./edit/akun.php">
                <h4>Identitas Pribadi</h4>
                <div class="row mb-5">
                    <div class="col-md-6">
                        <label class="mt-3" for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $me['nama_admin']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="username">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username" id="username" value="<?= $me['username']; ?>" disabled required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= $me['email']; ?>" disabled required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="no_hp">Nomor Handphone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="no_hp" id="no_hp" value="<?= $me['no_hp']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="norek">Nomor Rekening <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="norek" id="norek" value="<?= $me['no_rekening']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="jk">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select type="text" class="form-control" name="jenis_kelamin" id="jk" placeholder="Nomor Handphone" required>
                            <option value="1" <?php if($me['id_jenis_kelamin']==1){ echo "selected";} ?>>Laki-Laki</option>
                            <option value="2" <?php if($me['id_jenis_kelamin']==2){ echo "selected";} ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <h4>Alamat</h4>
                <div class="row">
                    <div class="col-md-6">
                        <label class="mt-3" for="alamat">Alamat Lengkap <span class="text-danger">*</span></label>
                        <div class="row g-2">
                            <div class="col-8">
                                <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $me['nama_jalan']; ?>" required>
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control" name="no_rumah" id="no_rumah" value="<?= $me['no_jalan']; ?>" required>
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="select-data">Kota <span class="text-danger">*</span></label>
                        <select class="form-control" name="kota" id="select-data">
                            <option selected>Pilih Kota</option>
                            <?php while($k = mysqli_fetch_assoc($daftar_kota)):?>
                            <option value="<?= $k['id_kota'];?>" <?php if($me['id_kota']==$k['id_kota']){ echo "selected";} ?>><?= $k['nama_kota'];?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <input type="submit" class="form-control btn btn-primary mt-3" name="submit" value="UBAH PROFIL">
        </form>
        		    
		        </div>
		    </div>   
	    </div>
	</div>
</div>

<?php include "footer.php"; ?>