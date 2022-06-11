<?php
$page = 'Pesanan';
include "header.php";
if(!isset($_GET['id'])){
    header('Location:pesanan.php');
}
$id = $_GET['id'];
$order =mysqli_query($conn, "SELECT p.*, k.nama_produk AS produk, c.nama_customer AS cust,
b.nama_status_pembayaran AS bayar, s.nama_status_pesanan AS stats
FROM pesanan p, produk k, customer c, status_pembayaran b, status_pesanan s
WHERE p.id_customer=c.id_customer AND s.id_status_pesanan=p.id_status_pesanan 
AND b.id_status_pembayaran=p.id_status_pembayaran AND k.id_produk=p.id_produk AND p.id_pesanan='$id'");
$o = mysqli_fetch_assoc($order);
$tgl = date('Y-m-d',strtotime($o['tanggal_pesanan']));
$action = '';
if($o['bayar']=='Selesai'){
    if($o['stats']=='Belum Diproses'){
        $action = 
            "<form action='./edit/pesanan.php' method='POST'>
                <input type='hidden' name='id' value='$id'/>
                <input type='hidden' name='tgl' value='$tgl'/>
                <input type='hidden' name='nom' value='$o[harga]'/>
                <input type='hidden' name='ket' value='Penjualan $o[produk]'/>
                <button class='btn btn-warning' value='kemas' name='action'><i class='fas fa-archive'></i> Kemas</button>
            </form>";
    }elseif($o['stats']=='Dikemas'){
        $action = 
            "<form action='./edit/pesanan.php' method='POST'>
                <input type='hidden' name='id' value='$id'/>
                <button class='btn btn-warning' value='kirim' name='action'><i class='fas fa-truck'></i> Kirim</button>
            </form>";
    }elseif($o['stats']=='Dikirim'){
        $action = "<p class='text-white'>Menunggu diselesaikan customer</p>";
    }elseif($o['stats']=='Selesai'){
        $action = "<p class='text-white'>Pesanan sudah selesai</p>";
    }elseif($o['stats']=='Dibatalkan'){
        $action = "<p class='text-white'>Pesanan dibatalkan oleh customer</p>";
    }
}else{
    $action = "<p class='text-white'>Customer Belum Melakukan Pembayaran</p>";
}
    
?>

<script type="text/javascript" src="../../assets/ckeditor/ckeditor.js"></script>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
				<h4 class="page-title">Ubah Pesanan</h4>
				<ul class="breadcrumbs">
					<li class="nav-home">
				    	<a href="index.php">
			    	    	<i class="flaticon-home"></i>
		    			</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="pesanan.php">Pesanan</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
					    <a href="#">Ubah Pesanan</a>
					</li>
				</ul>
			</div>
            <div class="row">
    			<div class="col-md-12">
    				<div class="card">
    					<div class="card-body py-3">
    					    <a href="pesanan.php" class="btn btn-danger">BATAL</a> 
    					    <p><small>Klik nama customer untuk melihat info customer</small></p>
    					    <table class="table">
    					        <tbody>
    					            <tr>
    					                <th>Nama Customer</th>
    					                <td>
    					                    <form action='details.php' method='POST'>
    					                        <input type='hidden' name='role' value='customer'/>
    					                        <button class="btn btn-link p-0" name="lihat" value='<?= $o['id_customer']; ?>'><?= $o['cust']; ?></a>
    					                    </form>
    					               </td>
    					            </tr>
    					            <tr>
    					                <th>Produk</th>
    					                <td>
    					                    <?= $o['produk']; ?>
    					               </td>
    					            </tr>
    					            <tr>
    					                <th>Harga</th>
    					                <td>
    					                    <?= $o['harga']/$o['kuantitas']; ?>
    					               </td>
    					            </tr>
    					            <tr>
    					                <th>Qty</th>
    					                <td>
    					                    <?= $o['kuantitas']; ?>
    					               </td>
    					            </tr>
    					            <tr>
    					                <th>Total Belanja</th>
    					                <td>
    					                    <?= $o['harga']; ?>
    					               </td>
    					            </tr>
    					        </tbody>
    					    </table>
    					</div>
    					<div class="card-footer">
    					    <div class="d-flex">
    					        <div>
    					            <?= $action; ?>
    					        </div>
    					    </div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
<script>
    $("#submit").click(function(){
        var rincian = $("#rincian").val();
        if(rincian==''){
            Swal.fire({
                title:'Form Belum Lengkap',
                text:'Mohon periksa kembali bidang yang belum terisi',
                icon:'warning',
                confirmButtonText:'OK',
            });
        }
    })
</script>

<?php include "footer.php"; ?>