<?php 
$page = 'Halaman Customer';
include "header.php"; 

// alert

if(!empty($_GET['alert'])){
    $alert = $_GET['alert'];
    if($alert=='success'){
        echo "<script>Swal.fire({title: 'Ubah Data Akun Berhasil!',text: 'Berhasil mengubah data akun',icon: 'success',confirmButtonText: 'OK'})</script>";
    }
}
?>

<div class="container-fluid bg-success text-white text-center p-5">
    <a href="profpic.php"><img src="../assets/uploads/profile/<?=$foto;?>" class="profpic"></a>
    <h3 class="mt-3"><?= $u['username']; ?>
</div>
<div class="container">
    <div class="row bg-warning text-center rounded shadow p-3" style="margin-top:-25px">
        <div class="col-3 col-link" id="btn-dashboard">
            <h3><i class="fa-solid fa-house-user"></i></h3>
            <small>Dasbor</small>
        </div>
        <div class="col-3 col-link" id="btn-profile">
            <h3><i class="fa-solid fa-user"></i></h3>
            <small>Akun</small>
        </div>
        <div class="col-3 col-link" id="btn-history">
            <h3><i class="fa-solid fa-clock-rotate-left"></i></h3>
            <small>Riwayat</small>
        </div>
        <div class="col-3 col-link" id="btn-profile">
            <h3><i class="fa-solid fa-clock-rotate-left"></i></h3>
            <small>Riwayat</small>
        </div>
    </div>
    <div class="my-5 p-3" id="dashboard">
        <h2>Dashboard</h2>
        
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
    <div class="my-5 p-3" id="history">
        <h2>Riwayat Transaksi</h2>
    </div>
</div>

<?php include "footer.php"; ?>