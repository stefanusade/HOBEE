<?php

// Include file koneksi database
require('./config/db.php');

// Ambil data JSON
$json = file_get_contents('php://input');

// Ambil callback signature
$callbackSignature = isset($_SERVER['HTTP_X_CALLBACK_SIGNATURE'])
    ? $_SERVER['HTTP_X_CALLBACK_SIGNATURE']
    : '';

// Isi dengan private key anda
$privateKey = '6BEzY-ZON6Y-54Gw3-1d0GQ-xgIxl';

// Generate signature untuk dicocokkan dengan X-Callback-Signature
$signature = hash_hmac('sha256', $json, $privateKey);

// Validasi signature
if ($callbackSignature !== $signature) {
    exit('Invalid signature');
}

$data = json_decode($json,true);

// Hentikan proses jika callback event-nya bukan payent_status
if ('payment_status' !== $_SERVER['HTTP_X_CALLBACK_EVENT']) {
    exit('Invalid callback event, no action was taken');
}

$uniqueRef = $data['merchant_ref'];
$status = strtoupper((string) $data['status']);
if($status=='PAID'){
    $update = mysqli_query($conn,"UPDATE pesanan SET id_status_pembayaran=2 WHERE id_pesanan='$uniqueRef'");
}elseif($status=='EXPIRED'){
    $delete = mysqli_query($conn,"DELETE FROM pesanan WHERE id_pesanan='$uniqueRef'");
}