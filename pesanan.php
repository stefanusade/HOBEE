<?php
$page = 'Pesanan Baru';
include "header.php";

if(!isset($_GET['id'])){
    header('Location:katalog.php');
}
$id = $_GET['id'];

$produk = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id'");
if(mysqli_num_rows($produk)==0){
    header('Location:katalog.php');
}
if(!isset($_SESSION['login'])&&$_SESSION['role']!=3){
    header("Location:login.php?alert=nologin&ref=order&id=$id");
}
$d=mysqli_fetch_assoc($produk)
?>
<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body pt-4 pb-2">
                    <h2>Buat Pesanan</h2>
                    <form method="POST" action="./customer/add/pesanan.php">
                        <div class="row">
                            <div class="col-lg-6 my-2">
                                <label for="produk"><small>Nama Produk</small></label>
                                <input  class="form-control" type="hidden" name="id" value="<?= $id; ?>" required>
                                <input  class="form-control" type="hidden" name="seri" value="<?= $d['nomor_seri']; ?>" required>
                                <input  class="form-control" type="hidden" name="gambar" value="<?= $d['foto_produk']; ?>" required>
                                <input  class="form-control" type="text" name="produk" value="<?= $d['nama_produk']; ?>" readonly required>
                            </div>
                            <div class="col-lg-6 my-2">
                                <label for="harga"><small>Harga</small></label>
                                <input  class="form-control" type="number" name="harga" id="harga" value="<?= $d['harga']; ?>" readonly required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 my-2">
                                <label for="qty"><small>Kuantitas</small></label>
                                <input  class="form-control" type="hidden" name="berat" id="berat" value="<?= $d['berat']; ?>" required>
                                <input  class="form-control" type="number" name="qty" id="qty" value="1" min="1" placeholder="Banyaknya Pesanan" required>
                            </div>
                            <div class="col-lg-6 my-2">
                                <label for="bayar"><small>Metode Pembayaran</small></label>
                                <select class="form-select" name="bayar" id="bayar" required>
                                    <option value="BRIVA">BRIVA</option>
                                    <option value="BNIVA">BNI VA</option>
                                    <option value="BCAVA">BCA VA</option>
                                    <option value="MANDIRIVA">Mandiri VA</option>
                                    <option value="OVO">OVO</option>
                                    <option value="QRIS">QRIS (Gopay,LinkAja,DANA,Shopee,etc.)</option>
                                    <option value="ALFAMART">Alfamart</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-12">
                                <label for="ket">Keterangan</label>
                                <textarea class="form-control" name="ket" placeholder="Tambahkan Catatan untuk Penjual (opsional)"></textarea> 
                            </div>
                            <div class="col-12">
                                <table class="table table-borderless mt-3">
                                    <tr>
                                        <th class="align-middle">Jumlah</th>
                                        <td class="align-middle"><input  class="form-control" type="number" name="jumlah" id="jumlah" readonly required></td>
                                    </tr>
                                    <tr>
                                        <th class="align-middle">Ongkir</th>
                                        <td class="align-middle"><input  class="form-control" type="number" name="ongkir" id="ongkir" readonly required></td>
                                    </tr>
                                </table>
                                <hr>
                                <table class="table table-borderless">
                                    <tr>
                                        <th class="align-middle">TOTAL</th>
                                        <td class="align-middle"><input  class="form-control" type="number" name="total" id="total" readonly required></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12">
                                <input class="btn btn-warning text-dark form-control" type="submit" name="submit" value="SIMPAN">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>   
</div>
<script>
    $(document).ready(function(){
        var flat = 12000;
        $("#jumlah").val($("#harga").val());
        $("#ongkir").val(flat);
        var temp = parseInt($("#jumlah").val())+parseInt($("#ongkir").val());
        $("#total").val(temp);
        $("#qty").change(function(){
            var ongkir = Math.ceil($("#berat").val())*$(this).val()*flat;
            var jumlah = $("#harga").val()*$(this).val();
            $("#ongkir").val(ongkir);
            $("#jumlah").val(jumlah);
            temp = parseInt(ongkir)+parseInt(jumlah);
            $("#total").val(temp);
        });
    });
</script>
<?php include "footer.php"; ?>