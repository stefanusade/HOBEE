<?php
$page = "Pendaftaran Customer";
include "header.php";
$daftar_kota = mysqli_query($conn,"SELECT * FROM kota");
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
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $tgl_lahir = date('Y-m-d',strtotime($_POST['tgl_lahir']));
        $alamat = $_POST['alamat'];
        $no_rumah = $_POST['no_rumah'];
        $kota = $_POST['kota'];
        $pass = $_POST['pass'];
        $konfpass = $_POST['konfpass'];
        if($pass==$konfpass){
            include "./config/mail.php";
            $options = [
                'cost' => 10,
            ];
            $hash = password_hash($pass, PASSWORD_BCRYPT, $options);
            $simpan = mysqli_query($conn,"INSERT INTO customer 
            (nama_customer,id_jenis_kelamin,tanggal_lahir,no_jalan,nama_jalan,id_kota,no_hp,no_ktp,no_rekening,
            username,email,password) VALUES ('$nama','$jenis_kelamin','$tgl_lahir','$no_rumah','$alamat','$kota','$no_hp','$nik','$norek','$username','$email','$hash')");
            if($simpan){
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
                    header("Location:register.php?alert=server-error");
                } 
            }else{
                header("Location:register.php?alert=server-error");
            }   
        }else{
            header("Location:register.php?alert=passnomatch");
        }
    }else{
        header("Location:register.php?alert=incomplete");
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
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="username">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="no_hp">Nomor Handphone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="Nomor Handphone" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="nik">NIK <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nik" id="nik" placeholder="Nomor Induk Kependudukan" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="norek">Nomor Rekening <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="norek" id="norek" placeholder="Nomor Rekening Bank" required>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="jk">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select type="text" class="form-select" name="jenis_kelamin" id="jk" placeholder="Nomor Handphone" required>
                            <option selected>Pilih Salah Satu</option>
                            <option value="1">Laki-Laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="mt-3" for="tl">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="tgl_lahir" id="tl" placeholder="Email" required>
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
                <input type="submit" class="form-control btn btn-primary mt-3" name="submit" value="DAFTAR">
                
            </form>
            <p class="mt-3 mb-3">Sudah punya akun? <a href="login.php">Masuk</a></p>
        </div>  
    </div>
</div>

<?php include "footer.php";?>