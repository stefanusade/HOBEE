<?php
$page = "Pendaftaran Customer";
include "header.php";
$daftar_bank = mysqli_query($conn,"SELECT * FROM bank");
$daftar_kota = mysqli_query($conn,"SELECT * FROM kota");
$minusia = date('Y-m-d',strtotime('-17years'));
if(isset($_POST['submit'])){
    if(!empty($_POST['username']) && !empty($_POST['nama'])
    && !empty($_POST['email']) && !empty($_POST['no_hp'])
    && !empty($_POST['jenis_kelamin']) && !empty($_POST['tgl_lahir']) 
    && !empty($_POST['alamat']) && !empty($_POST['no_rumah']) 
    && !empty($_POST['kota']) && !empty($_POST['pass']) 
    && !empty($_POST['konfpass'])){
        $username = $_POST['username'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $no_hp = $_POST['no_hp'];
        $nik = $_POST['nik'];
        $norek = $_POST['norek'];
        $bank = $_POST['bank'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $tgl_lahir = date('Y-m-d',strtotime($_POST['tgl_lahir']));
        $alamat = $_POST['alamat'];
        $no_rumah = $_POST['no_rumah'];
        $kota = $_POST['kota'];
        $pass = $_POST['pass'];
        $konfpass = $_POST['konfpass'];
        $check = mysqli_query($conn,"SELECT * FROM customer WHERE username='$username' OR email='$email' OR no_hp='$no_hp'");
        if(mysqli_num_rows($check)>0){
            header("Location:register.php?alert=registered");
        }else{
            if($pass==$konfpass){
                include "./config/mail.php";
                $options = ['cost' => 10,];
                $hash = password_hash($pass, PASSWORD_BCRYPT, $options);
                $simpan = mysqli_query($conn,"INSERT INTO customer 
                (nama_customer,id_jenis_kelamin,tanggal_lahir,no_jalan,nama_jalan,id_kota,no_hp,no_ktp,no_rekening,id_bank,
                username,email,password) VALUES ('$nama','$jenis_kelamin','$tgl_lahir','$no_rumah','$alamat','$kota','$no_hp','$nik','$norek','$id_bank','$username','$email','$hash')");
                if($simpan){
                    $kode = rand(100000,999999);
                    $_SESSION['verify'] = $email;
                    $subject = "Kode Verifikasi HOBEE $username";
                    $body = "
                        <h1>Kode Verifikasi HOBEE</h1>
                        <hr>
                        Berikut ini kode verifikasi akun Anda:
                        <h2><b>$kode</b></h2>
                        <hr>
                        Segera masukkan kode ke dalam form verifikasi. Kode hanya berlaku untuk 3 menit.
                    ";
                    mail($email,$subject,$body,$headers);
                    $plus3m = date('Y-m-d H:i:s',strtotime('+3mins'));
                    $verify = mysqli_query($conn,"INSERT INTO verifikasi_user 
                    (email,kode,waktu) VALUES ('$email','$kode','$plus3m')");
                    if($verify){
                        header("Location:verify.php");
                    }else{
                        header("Location:register.php?alert=server-error");
                    } 
                }else{
                    header("Location:register.php?alert=server-error");
                }   
            }else{
                header("Location:register.php?alert=passnomatch");
            }
        }  
    }else{
        header("Location:register.php?alert=incomplete");
    }
}

// alert

if(!empty($_GET['alert'])){
    $alert = $_GET['alert'];
    if($alert=='incomplete'){
        echo "<script>Swal.fire({title: 'Gagal Daftar!',text: 'Form Tidak Lengkap',icon: 'error',confirmButtonText: 'Coba Lagi'})</script>";
    }elseif($alert=='registered'){
        echo "<script>Swal.fire({title: 'Gagal Daftar!',text: 'Email/Nomor Handphone/Username sudah terdaftar',icon: 'error',confirmButtonText: 'Coba Lagi'})</script>";
    }elseif($alert=='passnomatch'){
        echo "<script>Swal.fire({title: 'Gagal Daftar!',text: 'Password Tidak Cocok',icon: 'error',confirmButtonText: 'Coba Lagi'})</script>";
    }elseif($alert=='server-error'){
        echo "<script>Swal.fire({title: 'Server Error!',text: 'Terjadi galat pada server',icon: 'error',confirmButtonText: 'Coba Lagi'})</script>";
    }
}
?>

<div class="container my-5">
    <div class="row shadow border" style="border-radius:15px">
        <div class="col-md-3 mx-auto hide-mobile align-items-center text-white bg-primary py-5 px-3" style="border-radius:15px 0px 0px 15px">
            
        </div>
        <div class="col-md-9 py-5 px-5 mx-auto">
            <h1>Daftar</h1>
            <p>Masukkan informasi Anda pada form yang tersedia</p>
            <form method="POST" action="">
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="mt-3" for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" maxlength="20" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="username">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" maxlength="10" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="no_hp">Nomor Handphone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control numeric" name="no_hp" id="no_hp" placeholder="Nomor Handphone" maxlength="13" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="nik">NIK <span class="text-danger">*</span></label>
                        <input type="text" class="form-control numeric" name="nik" id="nik" placeholder="Nomor Induk Kependudukan" maxlength="16" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="norek">Nomor Rekening <span class="text-danger">*</span></label>
                        <input type="text" class="form-control numeric" name="norek" id="norek" placeholder="Nomor Rekening Bank" maxlength="13" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="norek">Nama Bank <span class="text-danger">*</span></label>
                        <select class="form-select" name="bank" id="bank">
                            <option selected>Pilih Bank</option>
                            <?php while($b = mysqli_fetch_assoc($daftar_bank)):?>
                            <option value="<?= $b['id_bank'];?>"><?= $b['nama_bank'];?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="jk">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select type="text" class="form-select" name="jenis_kelamin" id="jk" placeholder="Jenis Kelamin" required>
                            <option selected>Pilih Salah Satu</option>
                            <option value="1">Laki-Laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="tl">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="tgl_lahir" id="tl" max="<?= $minusia; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="username">Alamat Lengkap <span class="text-danger">*</span></label>
                        <div class="row g-2">
                            <div class="col-8">
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat Lengkap" required>
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control" name="no_rumah" id="no_rumah" placeholder="Nomor Rumah" required>
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="select-data">Kota <span class="text-danger">*</span></label>
                        <select class="form-select" name="kota" id="select-data">
                            <option selected>Pilih Kota</option>
                            <?php while($k = mysqli_fetch_assoc($daftar_kota)):?>
                            <option value="<?= $k['id_kota'];?>"><?= $k['nama_kota'];?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="mt-3" for="pass">Password <span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="pass" id="password" placeholder="Password">
                            <span class="input-group-text" id="showHide"><i class="fa-solid fa-eye"></i></i></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="pass">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="konfpass" id="konfpass" placeholder="Password">   
                    </div>
                </div>
                <input type="submit" class="form-control btn btn-primary mt-3" name="submit" id="submit" value="DAFTAR">
                
            </form>
            <p class="mt-3 mb-3">Sudah punya akun? <a href="login.php">Masuk</a></p>
        </div>  
    </div>
</div>
<script>
    $("#submit").click(function(){
        var nama = $("#nama").val();
        var username = $("#username").val();
        var email = $("#email").val();
        var no_hp = $("#no_hp").val();
        var nik = $("#nik").val();
        var norek = $("#norek").val();
        var jk = $("#jk").val();
        var tl = $("#tl").val();
        var alamat = $("#alamat").val();
        var no_rumah = $("#no_rumah").val();
        var kota = $("#kota").val();
        
        if(nama==''||username==''||email==''||no_hp==''||nik==''){
            Swal.fire({
                title:'Form Belum Lengkap',
                text:'Mohon periksa kembali bidang yang belum terisi',
                icon:'warning',
                button:'OK',
            });
        }
    })
    $(".numeric").keyup(function(){
        var numonly = $(this).val();
        var key = event.keyCode || event.charCode;
        if( key != 8 || key != 46 ){
            if(numonly != ''){
                if(!$.isNumeric(numonly)){
                    Swal.fire({
                        title: 'Input Tidak Sesuai',
                        text:'Input hanya boleh terdiri atas angka 0-9',
                        icon:'warning',
                        button:'OK',
                    });
                }
            }   
        }
    })
</script>

<?php include "footer.php";?>