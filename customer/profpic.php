<?php 
$page = 'Edit Foto Profil';
include "header.php"; 
$daftar_kota = mysqli_query($conn,"SELECT * FROM kota");
?>
<div class="container-fluid bg-success text-white text-center p-5">
    <img src="../assets/uploads/profile/<?=$foto;?>" class="profpic">
</div>
<div class="container my-5">
    <a class="btn btn-danger mb-5" href="index.php">Batal</a>
    <form method="POST" action="./edit/profpic.php" enctype="multipart/form-data">
        <h4>Edit Foto Profil</h4>
            <label class="mt-3" for="pp">Unggah Foto Profil <span class="text-danger">*</span></label>
            <input type="file" class="form-control" name="file" id="pp" required>
            <input type="submit" class="form-control btn btn-primary mt-3" name="submit" value="SIMPAN">
    </form>
</div>

<?php include "footer.php"; ?>