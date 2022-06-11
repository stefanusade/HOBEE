<?php 
$page='Akun';
include "header.php"; 
$daftar_bank = mysqli_query($conn,"SELECT * FROM bank");
$daftar_kota = mysqli_query($conn,"SELECT * FROM kota");?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
        	<div class="page-header">
				<h4 class="page-title">Tambah Akun Supplier</h4>
				<ul class="breadcrumbs">
					<li class="nav-home">
				    	<a href="index.php">
			    	    	<i class="flaticon-home"></i>
		    			</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Data Akun</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
					    <a href="supplier.php">Supplier</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
					    <a href="#">Tambah Supplier</a>
					</li>
				</ul>
			</div>
            <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body py-3">
						    <form method="POST" action="./add/supplier.php">
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
                                        <label class="mt-3" for="norek">Nomor Rekening <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control numeric" name="norek" id="norek" placeholder="Nomor Rekening Bank" maxlength="13" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-3">Nama Bank <span class="text-danger">*</span></label>
                                        <select class="form-control" name="bank">
                                            <option selected>Pilih Bank</option>
                                            <?php while($b = mysqli_fetch_assoc($daftar_bank)):?>
                                            <option value="<?= $b['id_bank'];?>"><?= $b['nama_bank'];?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-3" for="tgl">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="tgl" id="tgl" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-3" for="nik">NIK <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control numeric" name="nik" id="nik" placeholder="Nomor Induk Kependudukan" maxlength="16" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-3" for="jk">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select type="text" class="form-control" name="jenis_kelamin" id="jk" placeholder="Jenis Kelamin" required>
                                            <option selected>Pilih Salah Satu</option>
                                            <option value="1">Laki-Laki</option>
                                            <option value="2">Perempuan</option>
                                        </select>
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
                                        <select class="form-control" name="kota" id="select-data">
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
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn-block btn btn-primary mt-3" name="submit" id="submit" value="DAFTAR">
                                
                            </form>
					    </div>
				    </div>
			    </div>
			</div>
		</div>
	</div>
</div>
<script>
    $("#submit").click(function(){
        var nama = $("#nama").val();
        var username = $("#username").val();
        var email = $("#email").val();
        var no_hp = $("#no_hp").val();
        var norek = $("#norek").val();
        var tgl = $("#tgl").val();
        var nik = $("#nik").val();
        var jk = $("#jk").val();
        var alamat = $("#alamat").val();
        var no_rumah = $("#no_rumah").val();
        var kota = $("#kota").val();
        var pass = $("#pass").val();
        if(nama==''||username==''||email==''||no_hp==''||norek==''||tgl==''||nik==''||jk==''||alamat==''||no_rumah==''||kota==''||pass==''){
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
<?php include "footer.php"; ?>