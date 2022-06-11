<?php
include "./add/verify.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header("Location:index.php");
}
include "../config/db.php";
$pesanan = mysqli_query($conn,"SELECT p.*, k.nama_produk AS produk, k.keterangan AS ket FROM pesanan p, produk k WHERE p.id_pesanan='$id' AND k.id_produk=p.id_produk");
$d = mysqli_fetch_assoc($pesanan);
$kons = $d['id_customer'];
$customer = mysqli_query($conn,"SELECT c.*,k.nama_kota AS kota FROM customer c, kota k WHERE username='$username'");
$c = mysqli_fetch_assoc($customer);
$alamat = $c['nama_jalan']." ".$c['no_jalan'].", ".$c['kota'];
if($d['id_status_pembayaran']==1){
    $image = '../assets/img/bl.png';
}elseif($d['id_status_pembayaran']==2){
    $image = '../assets/img/l.png';
}
if($d['id_customer']!=$c['id_customer']){
    header("Location:index.php");
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>INVOICE #<?= $id; ?></title>
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .paper{
                width:21.5cm;
                height:29.7cm;
                background-image:url('<?= $image; ?>') !important;
                background-size:contain;
            }
            @media print {
            * {
                -webkit-print-color-adjust: exact !important; /*Chrome, Safari */
                color-adjust: exact !important;  /*Firefox*/
              }
            }
        </style>
    </head>
    <body class="bg-light" onload="myFunction()">
        <div class="paper p-3">
            <div class="row">
                <div class="col-12">
                    <img class="mb-3" src="../assets/img/Logo.png" height="75">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <h2>INVOICE #<?= $id; ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p><strong>Dari:</strong></p>
                    <p class="m-0">Madu Samsi</p>
                    <p class="m-0">Wonosalam, Jombang, Jawa Timur 61476</p>
                    <p class="m-0">info@hobee.com</p>
                    <p class="m-0">08123197923</p>
                </div>
                <div class="col-6">
                    <p><strong>Kepada:</strong></p>
                    <p class="m-0"><?= $c['nama_customer']; ?></p>
                    <p class="m-0"><?= $alamat; ?></p>
                    <p class="m-0"><?= $c['email']; ?></p>
                    <p class="m-0"><?= $c['no_hp']; ?></p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Qty</th>
                                <th class="text-end">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $d['produk']; ?></td>
                                <td><?= $d['kuantitas']; ?></td>
                                <td class="text-end"><?= "Rp".number_format($d['harga']/$d['kuantitas'],2,',','.'); ?></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SUBTOTAL</th>
                                <th></th>
                                <th class="text-end"><?= "Rp".number_format($d['harga'],2,',','.'); ?></th>
                            </tr>
                            <tr>
                                <th>ONGKIR</th>
                                <th></th>
                                <th class="text-end"><?= "Rp".number_format(12000*$d['kuantitas'],2,',','.'); ?></th>
                            </tr>
                            <tr>
                                <th>TOTAL</th>
                                <th></th>
                                <th class="text-end"><?= "Rp".number_format(12000*$d['kuantitas']+$d['harga'],2,',','.'); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    <script>
        function myFunction() {
            window.print();
        }
    </script>
    </body>
</html>