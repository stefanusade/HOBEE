<?php 
$page = 'Batalkan Pesanan';
include "header.php"; 
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $batal = mysqli_query($conn,"SELECT * FROM status_pembatalan");
}else{
    header("Location:index.php#order");
}
$uid = $u['id_customer'];
$pesanan = mysqli_query($conn,"SELECT p.*, k.nama_produk AS produk, k.keterangan AS ket, k.foto_produk AS foto FROM pesanan p, produk k WHERE p.id_pesanan='$id' AND k.id_produk=p.id_produk AND p.id_customer='$uid' AND p.id_status_pesanan=1");
if(mysqli_num_rows($pesanan)==0){
    header("Location:index.php#order");
}
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card bg-white">
                <div class="card-body">
                    <h1>Pembatalan Pesanan #<?= $id; ?></h1>
                    <form action="./edit/batal.php" method="POST">
                        <label for="batal">Alasan Pembatalan</label>
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <select class="form-select" name="batal" id="batal" required>
                            <option value="">-- Pilih salah satu alasan --</option>
                            <?php while($d=mysqli_fetch_assoc($batal)): ?>
                                <option value="<?= $d['id_status_pembatalan']; ?>"><?= $d['nama_status_pembatalan']; ?></option>
                            <?php endwhile; ?>
                        </select>
                        <div class="alert alert-primary mt-3">
                            <p>Ketentuan Pembatalan:</p>
                            <ul>
                                <li>Pembatalan hanya dapat dilakukan saat status pesanan "Belum Diproses"</li>
                                <li>Pesanan yang dibatalkan tidak bisa dikembalikan/dilanjutkan</li>
                                <li>Pengembalian dana pembayaran dikirimkan melalui rekening yang didaftarkan, disertai potongan biaya admin transfer bank.</li>
                            </ul>
                        </div>
                        <p><small>Dengan melanjutkan pembatalan saya menyetujui ketentuan pembatalan yang berlaku</small></p>
                        <input class="form-control btn btn-primary" type="submit" name="submit" value="BATALKAN PESANAN">
                    </form> 
                </div>
            </div>    
        </div>
    </div>
</div>

<?php include "footer.php"; ?>