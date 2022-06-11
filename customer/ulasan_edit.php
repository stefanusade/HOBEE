<?php 
$page = 'Pesanan';
include "header.php"; 
if(!isset($_GET['id'])){
    header("Location:index.php#order");
}
$id = $_GET['id'];
$uid = $u['id_customer'];
$ulasan = mysqli_query($conn,"SELECT * FROM ulasan WHERE id_ulasan='$id' AND id_customer='$uid'");
if(mysqli_num_rows($ulasan)==0){
    header("Location:index.php#order");
}
$r = mysqli_fetch_assoc($ulasan);
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-9 mx-auto">
            <div class="card rounded shadow bg-white p-3">
                <div class="card-body">
                    <a href="index.php#order" class="btn btn-danger mb-2">Batal</a>
                    <h2>Edit Ulasan</h2>
                    <form enctype="multipart/form-data" method="POST" action="./edit/ulasan.php">
                        <div class="form-group my-2">
                            <label for="komentar">Komentar <span class="text-danger">*</span></label>
                            <input type="hidden" name="cust" value="<?= $uid; ?>">
                            <input type="hidden" name="order" value="<?= $r['id_pesanan']; ?>">
                            <input type="hidden" name="id" value="<?= $id; ?>">
                            <textarea class="form-control" id="komentar" name="komentar" required><?= $r['komentar']; ?></textarea>
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
                              <input class="form-check-input" type="radio" name="rating" id="inlineRadio1" value="1" <?php if($r['bintang']==1){echo "checked";} ?>>
                              <label class="form-check-label" for="inlineRadio1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="rating" id="inlineRadio2" value="2" <?php if($r['bintang']==2){echo "checked";} ?>>
                              <label class="form-check-label" for="inlineRadio2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="rating" id="inlineRadio3" value="3" <?php if($r['bintang']==3){echo "checked";} ?>>
                              <label class="form-check-label" for="inlineRadio3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="rating" id="inlineRadio4" value="4" <?php if($r['bintang']==4){echo "checked";} ?>>
                              <label class="form-check-label" for="inlineRadio4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="rating" id="inlineRadio5" value="5" <?php if($r['bintang']==5){echo "checked";} ?>>
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