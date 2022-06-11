<?php include "header.php"; 
$daftar_kota = mysqli_query($conn,"SELECT * FROM kota");
if(!empty($_GET['alert'])){
    $alert = $_GET['alert'];
    if($alert=='file-too-big'){
        echo "<script>Swal.fire({title: 'Gagal',text: 'Ukuran file melebihi batas maksimum',icon: 'danger',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='photo-success'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil mengubah foto profil',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='forbidden-extension'){
        echo "<script>Swal.fire({title: 'Gaal',text: 'Ekstensi file tidak diperbolehkan',icon: 'warning',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='delete-success'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil menghapus data edukasi',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='success-edit'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil mengubah data edukasi',icon: 'success',confirmButtonText: 'OK'})</script>";
    }
}
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
    			<div class="d-flex justify-content-center mt--3" >
    				<a href="akun_profpic.php" class="btn btn-xs btn-round btn-secondary" style="z-index:100"><i class='fas fa-pen'></i></a>
    			</div>
    		</div>
    	</div>
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
                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $me['nama_supplier']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="username">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username" id="username" value="<?= $me['username']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= $me['email']; ?>" readonly required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="no_hp">Nomor Handphone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control numeric" name="no_hp" id="no_hp" value="<?= $me['no_hp']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="norek">Nomor Rekening <span class="text-danger">*</span></label>
                        <input type="text" class="form-control numeric" name="norek" id="norek" value="<?= $me['no_rekening']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="nik">NIK <span class="text-danger">*</span></label>
                        <input type="text" class="form-control numeric" name="nik" id="nik" value="<?= $me['no_ktp']; ?>" required>
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
                <div class="row mb-5">
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
                <h4>Password</h4>
                <div class="row">
                    <div class="col-md-6">
                        <label class="mt-3" for="pass">Password (Kosongkan jika tidak ingin mengubah password)</span></label>
                        <input type="password" class="form-control" name="pass" id="pass">
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="pass">Konfirmasi Password (Kosongkan jika tidak ingin mengubah password)</span></label>
                        <input type="password" class="form-control" name="kpass" id="kpass">
                    </div>
                </div>
                <input type="submit" class="form-control btn btn-primary mt-3" name="submit" value="UBAH PROFIL">
                <a href="akun.php" class="form-control btn btn-danger mt-3">BATAL</a>
        </form>
        		    
		        </div>
		    </div>   
	    </div>
	</div>

<script>
    $("#submit").click(function(){
        var nama = $("#nama").val();
        var username = $("#username").val();
        var email = $("#email").val();
        var no_hp = $("#no_hp").val();
        var nik = $("#nik").val();
        var norek = $("#norek").val();
        var jk = $("#jk").val();
        var tl = $("#tl").val();
        var alamat = $("#alamat").val();
        var no_rumah = $("#no_rumah").val();
        var kota = $("#kota").val();
        
        if(nama==''||username==''||email==''||no_hp==''||nik==''){
            Swal.fire({
                title:'Form Belum Lengkap',
                text:'Mohon periksa kembali bidang yang belum terisi',
                icon:'warning',
                button:'OK',
            });
        }
    })
    $(".numeric").keyup(function(){
        var numonly = $(this).val();
        var key = event.keyCode || event.charCode;
        if( key != 8 || key != 46 ){
            if(numonly != ''){
                if(!$.isNumeric(numonly)){
                    Swal.fire({
                        title: 'Input Tidak Sesuai',
                        text:'Input hanya boleh terdiri atas angka 0-9',
                        icon:'warning',
                        button:'OK',
                    });
                }
            }   
        }
    })
</script>
<?php include "footer.php"; ?>