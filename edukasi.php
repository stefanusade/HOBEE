<?php 
$page = 'Edukasi';
include "header.php";
?>

<?php if(isset($_GET['id'])):
    $id = $_GET['id'];
    $content = mysqli_fetch_assoc(mysqli_query($conn,"SELECT e.*, a.nama_admin AS author FROM edukasi e, admin a WHERE e.id_admin=a.id_admin AND id_edukasi='$id'"));
?>

    <div class="container my-5 px-lg-5">
        <div class="row bg-white py-5 px-3 rounded">
            <div class="col-lg-8">
                <img src="./assets/uploads/edukasi/<?= $content['gambar_sampul']; ?>" style="width:100%">
                <hr style="width:15%">
                <h1><?= $content['judul']; ?></h1>
                <small class="text-disabled">Oleh: <?= $content['author'];?> | Dipublikasikan pada: <?= date('d-m-Y H:i',strtotime($content['tgl_post']));?></small>
                <?= $content['konten']; ?>
                <iframe src="https://www.youtube.com/embed/<?= $content['link_video']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-lg-4">
                
            </div>
        </div>
    </div>

<?php else: 
    $edu = mysqli_query($conn,"SELECT * FROM edukasi");
?>

    <div class="container my-5 px-lg-5">
        <div class="row">
            <?php while($d=mysqli_fetch_assoc($edu)):?>
                <div class="col-lg-3 col-md-4">
                    <a href="edukasi.php?id=<?=$d['id_edukasi'];?>" class="text-dark">
                        <div class="card">
                          <img src="./assets/uploads/edukasi/<?= $d['gambar_sampul']; ?>" class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title"><?= $d['judul'];?></h5>
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