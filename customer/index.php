<?php 
$page = 'Halaman Customer';
include "header.php"; 

// alert

if(!empty($_GET['alert'])){
    $alert = $_GET['alert'];
    if($alert=='success'){
        echo "<script>Swal.fire({title: 'Ubah Data Akun Berhasil!',text: 'Berhasil mengubah data akun',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='passnomatch'){
        echo "<script>Swal.fire({title: 'Gagal Mengubah Data!',text: 'Password Tidak Cocok',icon: 'error',confirmButtonText: 'Coba Lagi'})</script>";
    }elseif($alert=='success-cancel'){
        echo "<script>Swal.fire({title: 'Berhasil Dibatalkan',text: 'Pesanan anda berhasil dibatalkan',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='success-complete'){
        echo "<script>Swal.fire({title: 'Berhasil Diselesaikan',text: 'Pesanan anda berhasil diselesaikan',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='success-rating'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Ulasan berhasil disimpan',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='server-error'){
        echo "<script>Swal.fire({title: 'Gagal',text: 'Terjadi Gangguan Pada Server',icon: 'error',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='forbidden'){
        echo "<script>Swal.fire({title: 'Gagal',text: 'File terlalu besar/Ekstensi tidak sesuai',icon: 'error',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='incomplete'){
        echo "<script>Swal.fire({title: 'Gagal',text: 'Isian Form Tidak Lengkap',icon: 'error',confirmButtonText: 'OK'})</script>";
    }
}
$cust = $u['id_customer'];
$order = mysqli_query($conn,"SELECT p.id_pesanan AS id, p.link_bayar AS link, pr.nama_produk AS produk, p.kuantitas AS qty, p.harga AS harga, s.nama_status_pesanan AS sp, b.nama_status_pembayaran AS sb
FROM pesanan p, produk pr, status_pembayaran b, status_pesanan s 
WHERE p.id_customer='$cust' AND pr.id_produk=p.id_produk AND p.id_status_pembayaran = b.id_status_pembayaran AND p.id_status_pesanan = s.id_status_pesanan AND p.vis='1'
ORDER BY id DESC");
?>
<script>
    $(document).ready(function () {
        $('#tablecust').DataTable({
            "order": [ 0, 'desc' ]
        });
    });
</script>
<div class="container-fluid bg-warning text-white text-center p-5">
    <a href="profpic.php"><img src="../assets/uploads/profile/<?=$foto;?>" class="profpic"></a>
    <h3 class="mt-3"><?= $u['username']; ?>
</div>
<div class="container">
    <div class="row bg-warning bg-gradient text-center rounded shadow p-3" style="margin-top:-25px">
        <div class="col-4 col-link" id="btn-dashboard" style="transform: rotate(0);">
            <h3><i class="fa-solid fa-house-user"></i></h3>
            <a class="text-dark stretched-link" href="#dashboard">Dasbor</a>
        </div>
        <div class="col-4 col-link" id="btn-profile" style="transform: rotate(0);">
            <h3><i class="fa-solid fa-user"></i></h3>
            <a class="text-dark stretched-link" href="#profile">Akun</a>
        </div>
        <div class="col-4 col-link" id="btn-order" style="transform: rotate(0);">
            <h3><i class="fa-solid fa-clock-rotate-left"></i></h3>
            <a class="text-dark stretched-link" href="#order">Pesanan</a>
        </div>
    </div>
    <div class="my-5 p-3" id="dashboard">
        <h2>Dashboard</h2>
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="card bg-white shadow">
                    <div class="card-body">
                        <h5>Jumlah Pesanan</h5>
                        <h2><?= mysqli_num_rows($order); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-5 p-3" id="profile">
        <div class="d-flex bd-highlight justify-content-center mb-5">
          <div class="bd-highlight"><h2 class="m-0" style="line-height:1">Akun</h2></div>
          <div class="ms-auto bd-highlight"><a class="btn btn-sm btn-warning" href="akun.php">EDIT</a></div>
        </div>
        <h3>Informasi Pribadi</h3>
        <div class="table-responsive mb-5">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Nama</th>
                        <td><?= $u['nama_customer']; ?></td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td><?= $u['username']; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= $u['email']; ?></td>
                    </tr>
                    <tr>
                        <th>No. Handphone</th>
                        <td><?= $u['no_hp']; ?></td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td><?= $u['no_ktp']; ?></td>
                    </tr>
                    <tr>
                        <th>Nomor Rekening</th>
                        <td><?= $u['no_rekening']; ?></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td><?= $j['jenis_kelamin']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td><?= date('d M Y',strtotime($u['tanggal_lahir'])); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h3>Alamat</h3>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Jalan</th>
                        <td><?= $u['nama_jalan']; ?></td>
                    </tr>
                    <tr>
                        <th>No. Jalan</th>
                        <td><?= $u['no_jalan']; ?></td>
                    </tr>
                    <tr>
                        <th>Kota/Kab.</th>
                        <td><?= $k['nama_kota']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="my-5 p-3" id="order">
        <h2>Pesanan</h2>
        <div class="table-responsive">
            <table class="table" id="tablecust">
                <thead>
                    <tr>
                        <th style="max-width:100px">ID Pesanan</th>
                        <th>Nama Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($d = mysqli_fetch_assoc($order)) :
                        $idp = $d['id'];
                        $ulasan = mysqli_query($conn,"SELECT * FROM ulasan WHERE id_pesanan='$idp'");
                        
                    ?>
                        <tr>
                            <td style="max-width:100px"><?= $idp; ?></td>
                            <td><?= $d['produk']; ?></td>
                            <td><?= $d['qty']; ?></td>
                            <td><?= $d['harga']; ?></td>
                            <td>
                                <p class="m-0">
                                    Pembayaran: <?= $d['sb']; ?>
                                </p>
                                <p class="m-0">
                                    Pesanan: <?= $d['sp']; ?>
                                </p>
                            </td>
                            <td><a class="btn btn-sm btn-primary" href="pesanan.php?id=<?= $d['id']; ?>"><i class="fa-solid fa-eye"></i></a>
                            <?php if($d['sp']!='Dibatalkan'):?>
                                <?php if($d['sp']=='Selesai' && mysqli_num_rows($ulasan)==0): ?>
                                    <a class="btn btn-sm btn-success m-1" href="ulasan.php?id=<?= $d['id']; ?>"><i class="fa-solid fa-message"></i></a>
                                <?php else: ?>
                                    <a class="btn btn-sm btn-secondary m-1" href="ulasan_view.php?id=<?= $d['id']; ?>"><i class="fa-solid fa-message"></i></a>
                                <?php endif; ?>
                                <?php if($d['sp']=='Belum Diproses'): ?>
                                    <a class="btn btn-sm btn-danger m-1" href="batal.php?id=<?= $d['id']; ?>"><i class="fa-solid fa-circle-xmark"></i></a>
                                <?php endif; ?>
                                <?php if($d['sb']=='Belum Bayar'): ?>
                                    <a class="btn btn-sm btn-success m-1" href="<?= $d['link']; ?>"><i class="fa-solid fa-money-bills"></i></a>
                                <?php endif; ?>
                                <?php if($d['sp']=='Dikirim'): ?>
                                    <a class="btn btn-sm btn-warning m-1" href="pesanan_edit.php?id=<?= $d['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                <?php endif; ?>
                            <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
            
    </div>
</div>

<?php include "footer.php"; ?>