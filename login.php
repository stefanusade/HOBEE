<?php
$page = "Login Customer";
include "header.php";

$alert = '';
$ref = '';
$id = '';
if(isset($_GET['ref'])){
    $ref = 'order';
    $id = $_GET['id'];
}
if(isset($_POST['login'])){
    require_once "./config/db.php";
    if(isset($_POST['email']) && isset($_POST['pass'])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $ref = $_POST['ref'];
        $id = $_POST['id'];
        $search = mysqli_query($conn,"SELECT * FROM customer WHERE email = '$email'");
        if(mysqli_num_rows($search)>0){
            $d = mysqli_fetch_assoc($search);
            $validation = $d['password'];
            $status = $d['status'];
            if(password_verify($pass,$validation)){
                if($status==1){
                    $_SESSION['login'] = true;
                    $_SESSION['role'] = 3;
                    $_SESSION['username'] = $d['username'];
                    $_SESSION['pass'] = $pass;
                    $_SESSION['success'] = true;
                    if(!empty($ref)){
                        header("Location:pesanan.php?id=$id");
                    }else{
                        header("Location:./customer");
                    }
                }else{
                    include "./config/mail.php";
                    $kode = rand(100000,999999);
                    $_SESSION['verify'] = $email;
                    $mail->addAddress($email, $nama);
                    $mail->isHTML(true);                                  
                    $mail->Subject = "Kode Verifikasi HOBEE $username";
                    $mail->Body    = "
                        <h1>Kode Verifikasi HOBEE</h1>
                        <hr>
                        Berikut ini kode verifikasi akun Anda:
                        <h2><b>$kode</b></h2>
                        <hr>
                        Segera masukkan kode ke dalam form verifikasi. Kode hanya berlaku untuk 3 menit.
                    ";
                    $mail->send();
                    $plus3m = date('Y-m-d H:i:s',strtotime('+3mins'));
                    $verify = mysqli_query($conn,"INSERT INTO verifikasi_user 
                    (email,kode,waktu) VALUES ('$email','$kode','$plus3m')");
                    if($verify){
                        header("Location:verify.php");
                    }else{
                        header("Location:login.php?alert=server-error");
                    } 
                }
            }else{
                header('Location:login.php?alert=invalidpass');
            }
        }else{
            header('Location:login.php?alert=nouser');
        }
    }else{
        header('Location:login.php?alert=incomplete');
    }
}

// alert

if(!empty($_GET['alert'])){
    $alert = $_GET['alert'];
    if($alert=='incomplete'){
        echo "<script>Swal.fire({title: 'Gagal Login!',text: 'Form Tidak Lengkap',icon: 'error',confirmButtonText: 'Coba Lagi'})</script>";
    }elseif($alert=='nouser'){
        echo "<script>Swal.fire({title: 'Gagal Login!',text: 'Akun Pengguna Tidak Ditemukan',icon: 'error',confirmButtonText: 'Coba Lagi'})</script>";
    }elseif($alert=='invalidpass'){
        echo "<script>Swal.fire({title: 'Gagal Login!',text: 'Password Yang Anda Masukkan Salah',icon: 'error',confirmButtonText: 'Coba Lagi'})</script>";
    }elseif($alert=='register-success'){
        echo "<script>Swal.fire({title: 'Pendaftaran Berhasil!',text: 'Akun berhasil diverifikasi.',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='nologin'){
        echo "<script>Swal.fire({title: 'Login',text: 'Anda perlu login terlebih dahulu.',icon: 'info',confirmButtonText: 'OK'})</script>";
    }
}
?>
<div class="container my-5 px-3">
    <div class="row">
        <div class="col-lg-9 mx-auto">
            <div class="row bg-transparent-dark text-white shadow border mb-3" style="border-radius:15px">
                <div class="col-md-6 mx-auto hide-mobile align-items-center text-white py-5 px-3" style="border-radius:15px 0px 0px 15px">
                    
                </div>
                <div class="col-md-6 py-5 px-5 mx-auto">
                    <h1>Login customer</h1>
                    <small>Masukkan informasi login pada form yang tersedia</small>
                    <form method="POST" action="">
                        <div class="form-floating my-3">
                            <input type="hidden" name="ref" value="<?=$ref; ?>">
                            <input type="hidden" name="id" value="<?=$id; ?>">
                            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="input-group mb-3">
                            <div class="form-floating form-floating-group flex-grow-1">
                                <input type="password" class="form-control" name="pass" id="password" placeholder="Password">
                                <label for="pass">Password</label>
                            </div>
                        </div>
                        <input class="form-control btn btn-lg btn-warning" type="submit" name="login" value="Masuk"/>
                    </form>
                    <p class="my-3">Belum punya akun? <a href="register.php">Daftar Sekarang!</a></p>
                </div>  
            </div>        
        </div>
    </div>
    <center><a class="text-white" href="./backend">Login Sebagai Admin/Supplier</a></center>
</div>

<?php include "footer.php";?>