<?php 
$page = "Halaman Verifikasi Akun";
include "header.php";
if(isset($_SESSION['verify'])){
    $verify = $_SESSION['verify'];
}else{
    header('Location:login.php');
    exit;
}
if(isset($_POST['verify'])){
    $kode = $_POST['kode'];
    $search = mysqli_query($conn,"SELECT * FROM verifikasi_user WHERE waktu >= '$datetime' AND email='$verify' ORDER BY waktu DESC LIMIT 1");
    $s = mysqli_fetch_assoc($search);
    $dbkode = $s['kode'];
    if($dbkode==$kode){
        $verified = mysqli_query($conn,"UPDATE customer SET status='1' WHERE email='$verify'");
        if($verified){
            $clear = mysqli_query($conn,"DELETE FROM verifikasi_user WHERE kode='$kode'");
            if($clear){
                header('Location:login.php?alert=register-success');
            }
        }else{
            header('Location:verify.php?alert=server-error');
        }
    }else{
        header('Location:verify.php?alert=wrong-otp');
    }
}
?>

<div class="container my-5 mx-2">
    <div class="row">
        <div class="col-md-6 mx-auto shadow px-3 py-5 text-center border" style="border-radius:15px">
            <img src="./assets/img/verify.svg" class="mb-4" style="height:150px">
            <h3>Verifikasi Akun</h3>
            <p>Kami telah mengirim kode OTP ke Email yang anda daftarkan (<?= $_SESSION['verify']; ?>)</p>
            <form action="" method="post">
                <div class="row">
                    <div class="col-8 mx-auto">
                        <input class="text-line" type="number" max="999999" name="kode" required>
                        <a class="text-center" href="resend.php">Kirim Ulang Kode</a>
                        <input class="form-control btn btn-lg btn-primary mt-3" type="submit" name="verify" value="VERIFIKASI">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>