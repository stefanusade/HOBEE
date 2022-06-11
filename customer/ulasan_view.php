<?php 
$page = 'Pesanan';
include "header.php"; 
if(!isset($_GET['id'])){
    header("Location:index.php#order");
}
$id = $_GET['id'];
$uid = $u['id_customer'];
$pesanan = mysqli_query($conn,"SELECT p.*, k.nama_produk AS produk, k.keterangan AS ket, k.foto_produk AS foto FROM pesanan p, produk k WHERE p.id_pesanan='$id' AND k.id_produk=p.id_produk AND p.id_customer='$uid'");
$d = mysqli_fetch_assoc($pesanan);
$ulasan = mysqli_query($conn,"SELECT * FROM ulasan WHERE id_pesanan='$id'");
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
                    <a href="index.php#order" class="btn btn-danger mb-2">KEMBALI</a>
                    <h2>Ulasan</h2>
                    <div class="card bg-light p-3">
                        <div class="card-body">
                            <?php if(!empty($r['video_ulasan'])): ?>
                                <video class="mb-2" width="320" height="240" controls>
                                    <source src="../assets/uploads/video/<?= $r['video_ulasan']; ?>" type="video/mp4">
                                </video>
                            <?php endif; ?>
                            <div class="alert alert-success m-0">
                                <p><strong><?= substr($username,0,3); ?>***</strong></p>
                                <p class="m-0"><?= $r['komentar'];?></p>
                            </div>
                            <?php if(!empty($r['foto_ulasan'])): ?>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <a href="../assets/uploads/ulasan/<?= $r['foto_ulasan']; ?>" target="_blank">
                                        <div class="card mt-2">
                                            <img class="card-img" src="../assets/uploads/ulasan/<?= $r['foto_ulasan']; ?>">
                                        </div>
                                    </a>
                                </div>
                            </div> 
                            <?php endif; ?>
                        </div>
                    </div>
                    <a class="btn btn-primary mt-3" href="ulasan_edit.php?id=<?= $r['id_ulasan']; ?>">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>