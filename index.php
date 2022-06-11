<?php 

$page = 'Beranda';

include "header.php";

if(!empty($_GET['alert'])){

    $alert = $_GET['alert'];

    if($alert=='logout'){

            echo "<script>Swal.fire({title: 'Logout',text: 'Sesi anda telah berakhir',icon: 'success',confirmButtonText: 'OK'})</script>";

    }

}

    

?>



    <section class="hero justify-content-center align-items-center">
    
        <div class="container my-auto">
    
            <img src="./assets/img/Hobee.png" height="250"/>
    
        </div>
    
    </section>
    
    <section >
    
        <div class="container">
    
            <div class="row g-4 my-3 align-items-center">
    
                <div class="col-md-6 col-lg-4 p-5">
    
                    <img src="./assets/img/edu.svg" style="width:100%"/>
    
                </div>
    
                <div class="col-md-6 col-lg-8 p-5">
    
                    <h1>Edukasi</h1>
    
                    <p>Halaman berisi artikel dan video edukasi seputar madu dan lebah.</p>
    
                    <a class="btn btn-warning" href="edukasi.php">Pelajari Selengkapnya</a>
    
                </div>
    
            </div>
    
            <div class="row g-4 my-3 align-items-center">
    
                <div class="col-md-6 col-lg-8 p-5 order-md-1 order-2">
    
                    <h1>Toko</h1>
    
                    <p>Beli madu asli terpercaya dari Madu Samsi langsung secara daring.</p>
    
                    <a class="btn btn-warning" href="katalog.php">Mulai Berbelanja</a>
    
                </div>
    
                <div class="col-md-6 col-lg-4 p-5 order-md-2 order-1">
    
                    <img src="./assets/img/shop.svg" style="width:100%"/>
    
                </div>
    
            </div>
    
        </div>
    
    </section>



<?php 



include "footer.php";

?>