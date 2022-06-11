<?php 

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   {
     $url = "https://"; 
}else {
    $url = "http://";   
}
$url.= $_SERVER['HTTP_HOST'];     
$url.= $_SERVER['REQUEST_URI'];

if(isset($_GET['id'])):
    include "./config/db.php";
    $id = $_GET['id'];
    $content    = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM produk WHERE id_produk='$id'"));
    $review     = mysqli_query($conn,"SELECT u.*,c.nama_customer AS nama FROM ulasan u, pesanan o, customer c WHERE o.id_produk='$id' AND u.id_pesanan=o.id_pesanan AND o.id_customer=c.id_customer");
    $page = $content['nama_produk'];
    include "header.php";
    
?>
    <div class="container my-5 px-lg-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card bg-white">
                    <div class="card-body p-3">
                        <center>
                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-dark" href="index.php">Beranda</a></li>
                                <li class="breadcrumb-item"><a class="text-dark" href="katalog.php">Katalog</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?= strtoupper($content['nama_produk']); ?></li>
                            </ol>
                        </nav>
                        </center>
                        <div class="row rounded">
                            <div class="col-lg-6 mb-3">
                                <img src="./assets/uploads/produk/<?= $content['foto_produk']; ?>" style="width:100%; border-radius:8px">
                            </div>
                            <div class="col-lg-6">
                                <h3><strong><?= strtoupper($content['nama_produk']); ?></strong></h3>
                                <h5 class="text-secondary"><strong><?= "Rp ".number_format($content['harga'],0,',','.'); ?></strong></h5>
                                <div class="d-grid">
                                    <a class="btn btn-warning my-2" href="pesanan.php?id=<?= $id; ?>">BUAT PESANAN</a>
                                </div>
                                <div class="accordion accordion-flush my-2" id="accordionFlushExample">
                                  <div class="accordion-item m-0">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                      <button class="accordion-button collapsed px-0 py-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Deskripsi Singkat
                                      </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                      <div class="accordion-body px-1 pt-2 pb-0"><?= $content['keterangan']; ?></div>
                                    </div>
                                  </div>
                                  <div class="accordion-item m-0">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                      <button class="accordion-button collapsed px-0 py-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        Rincian
                                      </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                      <div class="accordion-body px-1 pt-2 pb-0">
                                          <table class="table table-borderless">
                                              <tr>
                                                  <td class="align-middle">Berat</td>
                                                  <td class="align-middle"><?= $content['berat']; ?></td>
                                              </tr>
                                              <tr>
                                                  <td class="align-middle">Tgl Produksi</td>
                                                  <td class="align-middle"><?= date('d-m-Y',strtotime($content['tanggal_produksi'])); ?></td>
                                              </tr>
                                              <tr>
                                                  <td class="align-middle">Tgl Kadaluarsa</td>
                                                  <td class="align-middle"><?= date('d-m-Y',strtotime($content['tanggal_kadaluarsa'])); ?></td>
                                              </tr>
                                          </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                
                                <p><strong>Bagikan:</strong></p>
                                <div class="d-flex bd-highlight">
                                    <div class="bd-highlight me-1">
                                        <button class="btn btn-success" onclick="window.open('whatsapp://send?text=Beli <?= $content['nama_produk']; ?> seharga <?= "Rp ".number_format($content['harga'],0,',','.'); ?> di Madu Samsi. <?= $url; ?>')"><i class="fa-brands fa-whatsapp"></i></button>
                                    </div>
                                    <div class="bd-highlight">
                                        <a class="btn btn-primary" href="https://www.facebook.com/sharer/sharer.php?u=<?= $url; ?>"><i class="fa-brands fa-facebook"></i></a>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h3>Ulasan Pelanggan</h3>
                                        <?php while($d=mysqli_fetch_assoc($review)): ?>
                                            <?php if(!empty($d['video_ulasan'])): ?>
                                                <video height="120" controls>
                                                    <source src="./assets/uploads/video/<?= $d['video_ulasan']; ?>" type="video/mp4">
                                                    </video>
                                            <?php endif; ?>
                                            <div class="alert alert-warning">
                                                <p><strong><?= substr($d['nama'],0,4)."***"; ?></strong></p>
                                                <p><?= $d['komentar']; ?></p>
                                                <?php if(!empty($d['foto_ulasan'])): ?>
                                                <a href="./assets/uploads/ulasan/<?=$d['foto_ulasan'];?>" target="_blank">
                                                    <img src="./assets/uploads/ulasan/<?=$d['foto_ulasan'];?>" height="75">
                                                </a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>   

<?php else: 
    $page = 'Katalog';
    include "header.php";
    $kat = mysqli_query($conn,"SELECT * FROM produk");
?>

    <div class="container my-5 px-lg-5">
        <div class="row">
            <?php while($d=mysqli_fetch_assoc($kat)):
                $harga = "Rp ".number_format($d['harga'],0,',','.');
            ?>
                <div class="col-lg-3 col-md-4 my-2">
                    <a href="katalog.php?id=<?=$d['id_produk'];?>" class="text-dark">
                        <div class="card" style="height:100%; border-radius:15px">
                          <img src="./assets/uploads/produk/<?= $d['foto_produk']; ?>" class="card-img-top" alt="..." style="border-radius:15px 15px 0px 0px">
                          <div class="card-body">
                            <h5 class="card-title"><strong><?= $d['nama_produk'];?></strong></h5>
                            <p class="px-2 text-secondary"><strong><?= $harga;?></strong></p>
                          </div>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

<?php 
endif;
include "footer.php"; ?>