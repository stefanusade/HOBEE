<?php
$page = 'Pesanan';
include "header.php"; 
if(!isset($_GET['id'])){
    header("Location:index.php#order");
}
$id = $_GET['id'];
$uid = $u['id_customer'];
$pesanan = mysqli_query($conn,"SELECT * FROM pesanan WHERE id_pesanan='$id' AND id_status_pesanan='4' AND id_customer='$uid'");
$d = mysqli_fetch_assoc($pesanan);
if(mysqli_num_rows($pesanan)==0){
    header("Location:index.php#order");
}
$ulasan = mysqli_query($conn,"SELECT * FROM ulasan WHERE id_pesanan='$id'");
if(mysqli_num_rows($ulasan)>0){
    header("Location:index.php#order");
}
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-9 col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body p-4">
                    <a href="index.php#order" class="btn btn-danger">KEMBALI</a>
                    <h2>Beri Ulasan Untuk Pesanan #<?= $id; ?></h2>
                    <form enctype="multipart/form-data" method="POST" action="./add/ulasan.php">
                        <div class="form-group my-2">
                            <label for="komentar">Komentar <span class="text-danger">*</span></label>
                            <input type="hidden" name="cust" value="<?= $uid; ?>">
                            <input type="hidden" name="order" value="<?= $id; ?>">
                            <textarea class="form-control" id="komentar" name="komentar" required></textarea>
                        </div>
                        <div class="form-group my-2">
                            <label for="foto">Foto Ulasan (maks. 1MB, jpeg,jpg,png)</label>
                            <input type="file" class="form-control" name="foto" id="foto">
                        </div>
                        <div class="form-group my-2">
                            <label for="video">Video Ulasan (maks. 5MB, mp4)</label>
                            <input type="file" class="form-control" name="video" id="video">
                        </div>
                        <div class="form-group my-2">
                            <p class="m-0">Rating <span class="text-danger">*</span></p>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="rating" id="inlineRadio1" value="1">
                              <label class="form-check-label" for="inlineRadio1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="rating" id="inlineRadio2" value="2">
                              <label class="form-check-label" for="inlineRadio2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="rating" id="inlineRadio3" value="3">
                              <label class="form-check-label" for="inlineRadio3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="rating" id="inlineRadio4" value="4">
                              <label class="form-check-label" for="inlineRadio4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="rating" id="inlineRadio5" value="5">
                              <label class="form-check-label" for="inlineRadio5">5</label>
                            </div>
                        </div>
                        <input type="submit" class="form-control btn btn-primary mt-3" name="submit" value="SIMPAN">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>