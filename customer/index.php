<?php 
$page = 'Halaman Customer';
include "header.php"; 
$daftar_kota = mysqli_query($conn,"SELECT * FROM kota");
?>

<div class="container-fluid bg-success text-white text-center p-5">
    <img src="../assets/uploads/profile/<?=$foto;?>" style="height:100px; border-radius:60px; border:3px solid white">
    <h3 class="mt-3"><?= $u['nama_customer']; ?>
</div>
<div class="container">
    <div class="row bg-warning text-center rounded shadow p-3" style="margin-top:-25px">
        <div class="col-3 col-link" id="btn-profile">
            <h3><i class="fa-solid fa-user"></i></h3>
            <small>Akun</small>
        </div>
        <div class="col-3 col-link" id="btn-history">
            <h3><i class="fa-solid fa-clock-rotate-left"></i></h3>
            <small>Riwayat</small>
        </div>
        <div class="col-3 col-link" id="btn-profile">
            <h3><i class="fa-solid fa-clock-rotate-left"></i></h3>
            <small>Riwayat</small>
        </div>
        <div class="col-3 col-link" id="btn-profile">
            <h3><i class="fa-solid fa-clock-rotate-left"></i></h3>
            <small>Riwayat</small>
        </div>
    </div>
    <div class="my-5" id="profile">
        <h2 class="mb-5">Akun</h2>
            <form method="POST" action="./edit/akun.php">
                <h4>Identitas Pribadi</h4>
                <div class="row mb-5">
                    <div class="col-md-6">
                        <label class="mt-3" for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $u['nama_customer']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="username">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username" id="username" value="<?= $u['username']; ?>" disabled required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= $u['email']; ?>" disabled required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="no_hp">Nomor Handphone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="no_hp" id="no_hp" value="<?= $u['no_hp']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="nik">Nomor Induk Kependudukan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nik" id="nik" value="<?= $u['no_ktp']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="norek">Nomor Rekening <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="norek" id="norek" value="<?= $u['no_rekening']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="jk">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select type="text" class="form-select" name="jenis_kelamin" id="jk" placeholder="Nomor Handphone" required>
                            <option value="1" <?php if($u['id_jenis_kelamin']==1){ echo "selected";} ?>>Laki-Laki</option>
                            <option value="2" <?php if($u['id_jenis_kelamin']==2){ echo "selected";} ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="tl">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="tgl_lahir" id="tl" value="<?= $u['tanggal_lahir']; ?>" required>
                    </div>
                </div>
                <h4>Alamat</h4>
                <div class="row">
                    <div class="col-md-6">
                        <label class="mt-3" for="alamat">Alamat Lengkap <span class="text-danger">*</span></label>
                        <div class="row g-2">
                            <div class="col-8">
                                <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $u['nama_jalan']; ?>" required>
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control" name="no_rumah" id="no_rumah" value="<?= $u['no_jalan']; ?>" required>
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="select-data">Kota <span class="text-danger">*</span></label>
                        <select class="form-select" name="kota" id="select-data">
                            <option selected>Pilih Kota</option>
                            <?php while($k = mysqli_fetch_assoc($daftar_kota)):?>
                            <option value="<?= $k['id_kota'];?>" <?php if($u['id_kota']==$k['id_kota']){ echo "selected";} ?>><?= $k['nama_kota'];?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <input type="submit" class="form-control btn btn-primary mt-3" name="submit" value="UBAH PROFIL">
        </form>
    </div>
    <div class="my-5" id="history">
        <h2>Riwayat Transaksi</h2>
    </div>
</div>

<?php include "footer.php"; ?>