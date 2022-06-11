<?php
$page = 'Pesanan';
include "header.php";
if(!isset($_GET['id'])){
    header('Location:pesanan.php');
}
$id = $_GET['id'];
$order = mysqli_query($conn, "SELECT p.*, k.nama_produk AS produk, c.nama_customer AS cust,
b.nama_status_pembayaran AS bayar, s.nama_status_pesanan AS stats
FROM pesanan p, produk k, customer c, status_pembayaran b, status_pesanan s
WHERE p.id_customer=c.id_customer AND s.id_status_pesanan=p.id_status_pesanan 
AND b.id_status_pembayaran=p.id_status_pembayaran AND k.id_produk=p.id_produk AND p.id_pesanan='$id'");
$o = mysqli_fetch_assoc($order);
$tgl = date('Y-m-d',strtotime($o['tanggal_pesanan']));
$button = '';
if($o['bayar']=='Selesai'){
    if($o['stats']=='Belum Diproses'){
        $button = "
            <p>Customer belum melakukan pembayaran</p>
        ";
    }elseif($o['stats']=='Dikemas'||$o['stats']=='Dikirim'){
        $button = "
        <div class='d-flex'>
            <div><a class='btn btn-warning ' href='invoice.php?id=$id'><i class='fas fa-file-invoice'></i> Invoice</a></div>
            <div><a class='btn btn-warning mx-2' href='label.php?id=$id'><i class='fas fa-print'></i> Label Pengiriman</a></div>
        </div>
        ";
    }elseif($o['stats']=='Selesai'){
        $button = "<p>Pesanan sudah selesai</p>";
    }elseif($o['stats']=='Dibatalkan'){
        $idb = $o['id_status_pembatalan'];
        $batal = mysqli_query($conn,"SELECT * FROM status_pembatalan WHERE id_status_pembatalan='$idb'");
        $b = mysqli_fetch_assoc($batal);
        $button = 
        "<div class='alert alert-danger'>
            <p class='text-danger m-0'><strong>PESANAN DIBATALKAN</strong></p>
            <p class='text-dark m-0'>Alasan: $b[nama_status_pembatalan]</p>
        </div>";
    }
}else{
    $button = "<p class='text-white'>Customer Belum Melakukan Pembayaran</p>";
}
    
?>

<script type="text/javascript" src="../../assets/ckeditor/ckeditor.js"></script>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
				<h4 class="page-title">Pesanan #<?= $id; ?></h4>
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
						<a href="pesanan.php">KEMBALI</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
					    <a href="#">Pesanan #<?= $id; ?></a>
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
    					            <?= $button; ?>
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