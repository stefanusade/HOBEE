<?php 
$page = 'Edit Akun';
include "header.php"; 
$daftar_kota = mysqli_query($conn,"SELECT * FROM kota");
?>
<div class="container-fluid bg-success text-white text-center p-5">
      <a href="profpic.php"><img src="../assets/uploads/profile/<?=$foto;?>" class="profpic"></a><br>
    <a class="btn btn-warning my-3" href="profpic.php">Edit Foto Profil</a>
</div>
<div class="container my-5">
    <a class="btn btn-danger mb-5" href="index.php">Batal</a>
    <form method="POST" action="./edit/akun.php">
                <h4>Identitas Pribadi</h4>
                <div class="row mb-5">
                    <div class="col-md-6">
                        <label class="mt-3" for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $u['nama_customer']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="username">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username" id="username" maxlength="10" value="<?= $u['username']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= $u['email']; ?>" disabled required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="no_hp">Nomor Handphone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control numeric" name="no_hp" id="no_hp" maxlength="13" value="<?= $u['no_hp']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="nik">Nomor Induk Kependudukan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control numeric" name="nik" id="nik" maxlength="16" value="<?= $u['no_ktp']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="norek">Nomor Rekening <span class="text-danger">*</span></label>
                        <input type="text" class="form-control numeric" name="norek" id="norek" maxlength="13" value="<?= $u['no_rekening']; ?>" required>
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
                <input type="submit" class="form-control btn btn-primary mt-3" name="submit" id="submit" value="SIMPAN">
        </form>
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