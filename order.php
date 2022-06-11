<?php
if(isset($_GET['tripay_status'])){
    $status = $_GET['tripay_status'];
    if($status=='UNPAID'){
        $message = 'Mohon lakukan pembayaran sebelum link kadaluarsa';
    }elseif($status=='PAID'){
        $message = 'Pembayaran Berhasil Dilakukan';
    }
}else{
    header('Location:index.php');
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>Terimakasih</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet" />
        <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container my-5">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card bg-white px-4 py-5">
                        <div class="card-body">
                            <center>
                                <h1 class="text-success display-1"><i class="fa-solid fa-circle-check"></i></h1>
                                <h2>Terimakasih Atas Pembeliannya!</h2>
                                <p class="my-5"><?= $message; ?></p>
                                <a class="btn btn-lg btn-success" href="./customer/index.php#order">Kembali ke Halaman Order</a>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>