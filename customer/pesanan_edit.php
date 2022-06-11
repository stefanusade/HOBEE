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
$customer = mysqli_query($conn,"SELECT c.*,k.nama_kota AS kota FROM customer c, kota k WHERE c.id_customer='$kons'");
$c = mysqli_fetch_assoc($customer);

if(mysqli_num_rows($pesanan)==0){
    header("Location:index.php#order");
}
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-9 mx-auto">
            <div class="card rounded shadow bg-white p-3">
                <div class="card-body">
                    <h1>Pesanan #<?= $id; ?></h1>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Foto Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img class="mt-3" src="../assets/uploads/produk/<?= $d['foto']; ?>" style="width:100px"></td>
                                    <td><?= $d['produk']; ?></td>
                                    <td><?= $d['harga']/$d['kuantitas']; ?></td>
                                    <td><?= $d['kuantitas']; ?></td>
                                    <td><?= $d['harga']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <div class="row my-3">
        <div class="col-md-9 mx-auto">
            <div class="card rounded shadow bg-secondary p-2">
                <div class="card-body">
                    <div class="d-flex">
                        <?php if($d['id_status_pesanan']!=5):?>
                        <div class="p-1 bd-highlight">
                            <form action="./edit/pesanan.php" id="form" method="post">
                                <input type="hidden" name="id" value="<?= $id; ?>">
                                <input type="hidden" name="action" value="selesai">
                                <button class="btn btn-success" id="btn-submit"><i class="fa-solid fa-circle-check"></i> Selesaikan Pesanan</button>
                            </form>
                        </div>
                        <?php endif;?>
                        <?php if($d['id_status_pesanan']==1):?>
                        <div class="p-1 bd-highlight">
                            <a class="btn btn-danger" href="batal.php?id=<?= $id; ?>"><i class="fa-solid fa-circle-xmark"></i> Batalkan</a>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#btn-submit").on('click',function(e){ //also can use on submit
        e.preventDefault(); //prevent submit
    
        Swal.fire({
          title: 'Selesaikan Pesanan?',
          text: "Pastikan barang telah diterima dan sesuai pesanan",
          icon: 'warning',
          showCancelButton: true,
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Tidak'
        }).then((result) => {
          if (result.isConfirmed) {
            $("#form").submit()
          }
        })
    });
</script>
<?php include "footer.php"; ?>