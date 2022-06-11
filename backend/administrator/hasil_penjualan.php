<?php 
$page='Grafik';
if(isset($_GET['id'])){
	$id=$_GET['id'];
}else{
	$id=1;
}
include "header.php";
$products = mysqli_query($conn,"SELECT * FROM produk");
$bulanan    = mysqli_query($conn,"SELECT MONTHNAME(p.tanggal_pesanan) as bulan, SUM(p.harga) as penjualan, k.nama_produk as produk 
FROM pesanan p, produk k 
WHERE p.id_status_pesanan > 1 AND p.id_status_pesanan < 5 AND 
p.id_produk = k.id_produk AND p.id_produk='$id' 
GROUP BY bulan, k.nama_produk ORDER BY tanggal_pesanan");
if(!empty(mysqli_num_rows($bulanan))){
    foreach($bulanan as $x){
		$bulan[] = $x['bulan'];
		$produk = $x['produk'];
        $penjualan[] = $x['penjualan'];
    }
}else{
    $bulan=[0];$penjualan=[0];
}
?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
        	<div class="page-header">
				<h4 class="page-title">Grafik Hasil Penjualan</h4>
				<ul class="breadcrumbs">
					<li class="nav-home">
				    	<a href="index.php">
			    	    	<i class="flaticon-home text-white"></i>
		    			</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="" class="text-white">Grafik</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="" class="text-white">Hasil Penjualan</a>
					</li>
				</ul>
			</div>
            <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body py-3">
							<select class="form-control my-3" id="selector">
								<?php while($d=mysqli_fetch_assoc($products)){ ?>
									<option value="<?= $d['id_produk']; ?>" <?php if($d['id_produk']==$id){ echo "selected"; }?>><?= $d['nama_produk']; ?></option>
								<?php } ?>
							</select>
						    <div class="bg-light rounded p-3" id="divGraph">
								<canvas class="bg-light rounded p-3" id="graph" style="width:100%"></canvas>
							</div>
					    </div>
				    </div>
			    </div>
			</div>
		</div>
	</div>
</div>
<script>
    
    const graf1 = document.getElementById('graph');
    
    const graph = new Chart(graf1, {
      type: 'line',
      data: {
        labels: <?php echo json_encode($bulan); ?>,
        datasets: [{
          label: 'Penjualan <?= $produk; ?>',
          data: <?php echo json_encode($penjualan); ?>,
          fill: true,
          borderWidth: 2,
          borderColor: "rgba(247,70,74,0.8)",
          backgroundColor: "rgba(247,70,74,0.2)",
          pointRadius: 5,
          pointHoverRadius: 8,
          tension: 0.1
        }]
      },
    });

</script>
<script>
	$("#selector").change(function(){
		var url = 'hasil_penjualan.php?id='+$(this).val();
		window.location.replace(url);
	});
</script>
<?php include "footer.php"; ?>