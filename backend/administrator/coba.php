<?php
include "../../config/db.php";
$bulanan    = mysqli_query($conn,
"SELECT MONTHNAME(p.tanggal_pesanan) as bulan, SUM(p.harga) as penjualan, k.nama_produk as produk FROM pesanan p, produk k WHERE p.id_status_pesanan > 1 AND p.id_status_pesanan < 5 AND p.id_produk = k.id_produk AND p.id_produk='1'  GROUP BY bulan, k.nama_produk ORDER BY tanggal_pesanan");

if(!empty(mysqli_num_rows($bulanan))){
    foreach($bulanan as $x){
		if(!in_array($x['bulan'],$bulan)){
			$bulan[] = $x['bulan'];
		}
		$produk[] = $x['produk'];
        $penjualan[] = $x['penjualan'];
    }
}else{
    $bulan=[0];$penjualan=[0];
}
echo json_encode($bulan);
?>