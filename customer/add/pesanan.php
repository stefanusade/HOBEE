<?php
include "verify.php";
if(isset($_POST['submit'])){
    if(!empty($_POST['bayar'])||!empty($_POST['qty'])){
        include "../../config/db.php";
        include "../../config/mail.php";
        $user = mysqli_query($conn,"SELECT * FROM customer WHERE username='$username'");
        $d = mysqli_fetch_assoc($user);
        $cust_name      = $d['nama_customer'];
        $cust_email     = $d['email'];
        $cust_id        = $d['id_customer'];
        $cust_phone     = $d['no_hp'];
        $apiKey         = 'DEV-NbMAW0uMdtOHG9Z2PTLveWY4pWDEAa5S79qVk7Z8';
        $privateKey     = '6BEzY-ZON6Y-54Gw3-1d0GQ-xgIxl';
        $merchantCode   = 'T1292';
        $tanggal        = date('Y-m-d H:i:s');
        $id             = $_POST['id'];
        $seri           = $_POST['seri'];
        $produk         = $_POST['produk'];
        $harga          = $_POST['harga'];
        $bayar          = $_POST['bayar'];
        $qty            = $_POST['qty'];
        $ongkir         = ceil($_POST['berat']*$qty);
        $gambar         = $_POST['gambar'];
        $ket            = $_POST['ket'];
        $jumlah         = $_POST['jumlah'];
        $total          = $_POST['total'];
        $simpan = mysqli_query($conn,"INSERT INTO pesanan 
        (id_customer,tanggal_pesanan,id_produk,kuantitas,harga,id_status_pesanan,id_status_pembayaran,keterangan) 
        VALUES ('$cust_id','$tanggal','$id','$qty','$jumlah',1,1,'$ket')");
        if($simpan){
            $last = mysqli_query($conn,"SELECT * FROM pesanan WHERE id_customer='$cust_id' AND id_produk='$id' AND tanggal_pesanan='$tanggal' ORDER BY id_pesanan DESC LIMIT 1");
            $l = mysqli_fetch_assoc($last);
            $ref = $l['id_pesanan'];
            
            $data = [
                'method'         => $bayar,
                'merchant_ref'   => $ref,
                'amount'         => $total,
                'customer_name'  => $cust_name,
                'customer_email' => $cust_email,
                'customer_phone' => $cust_phone,
                'order_items'    => [
                    [
                        'sku'         => $seri,
                        'name'        => $produk,
                        'price'       => $harga,
                        'quantity'    => $qty,
                        'product_url' => 'https://stefanusade.web.id/hobee/katalog.php?id='.$id,
                        'image_url'   => 'https://stefanusade.web.id/hobee/uploads/produk/'.$gambar,
                    ],
                    [
                        'sku'         => 'ONGKIR',
                        'name'        => 'Ongkos Kirim',
                        'price'       => 12000,
                        'quantity'    => $ongkir,
                    ]
                ],
                'return_url'   => 'https://stefanusade.web.id/hobee/order.php?id='.$ref,
                'expired_time' => (time() + (24 * 60 * 60)),
                'signature'    => hash_hmac('sha256', $merchantCode.$ref.$total, $privateKey)
            ];
            $curl = curl_init();
        
            curl_setopt_array($curl, [
                CURLOPT_FRESH_CONNECT  => true,
                CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
                CURLOPT_FAILONERROR    => false,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => http_build_query($data),
                CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ]);
            
            $response = curl_exec($curl);
            $error = curl_error($curl);
            
            curl_close($curl);
            
            if(empty($error)){
                $decode = json_decode($response,true);
                $link = $decode['data']['checkout_url'];
                $update = mysqli_query($conn,"UPDATE pesanan SET link_bayar='$link', vis='1' WHERE id_pesanan='$ref'");
                if($update){
                    $subject = "Konfirmasi Pesanan HOBEE #$ref";
                    $body = "
                        <h1>Konfirmasi Pesanan HOBEE</h1>
                        <hr>
                            <p>Anda baru-baru ini melakukan pesanan pada website HOBEE</p>
                            <p>ID Pesanan: #$ref</p>
                            <p>Produk: $produk</p>
                            <p>Harga: $harga</p>
                            <p>Link Bayar: $link</p>
                            <p>Jika transaksi ini tidak anda kenali, anda bisa melakukan pembatalan pada halaman 
                            customer</p>
                            <p>Pembatalan hanya dapat dilakukan saat status pemesanan belum diproses. </p>
                        <hr>
                        Segera lakukan pembayaran untuk memproses pesanan.
                        ";
                    mail($cust_email,$subject,$body,$headers);
                    header("Location:$link");
                }else{
                    header('Location:../../katalog.php?alert=server-error');
                }
            }else{
                header('Location:../../katalog.php?alert=gateway-error');
            }  
        }else{
            header('Location:../../katalog.php?alert=server-error');
        }   
    }else{
        print_r($_POST);
    }
}else{
    header('Location:../../katalog.php');
}