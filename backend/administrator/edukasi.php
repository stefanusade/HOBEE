<?php 
$page='Edukasi';
include "header.php"; 
if(!empty($_GET['alert'])){
    $alert = $_GET['alert'];
    if($alert=='cancel'){
        echo "<script>Swal.fire({title: 'Batal',text: 'Batal menambahkan data edukasi',icon: 'warning',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='success'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil menambahkan data edukasi',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='cancel-edit'){
        echo "<script>Swal.fire({title: 'Batal',text: 'Batal mengubah data edukasi',icon: 'warning',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='delete-success'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil menghapus data edukasi',icon: 'success',confirmButtonText: 'OK'})</script>";
    }elseif($alert=='success-edit'){
        echo "<script>Swal.fire({title: 'Berhasil',text: 'Berhasil mengubah data edukasi',icon: 'success',confirmButtonText: 'OK'})</script>";
    }
}
?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
        	<div class="page-header">
				<h4 class="page-title">Edukasi</h4>
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
						<a href="edukasi.php">Edukasi</a>
					</li>
				</ul>
			</div>
            <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body py-3">
						    <a class="btn btn-primary mb-3" href="edukasi_add.php">+ TAMBAH</a>
							<div class="table-responsive">
								<table id="basic-datatables" class="display table table-striped table-hover" >
									<thead>
										<tr>
											<th>No</th>
											<th>Judul</th>
											<th>Tanggal Post</th>
											<th>Author</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										    $i = 1;
										    while($d=mysqli_fetch_assoc($edu)){
										        echo "
										            <tr>
										                <td>$i</td>
										                <td>$d[judul]</td>
										                <td>$d[tgl]</td>
										                <td>$d[author]</td>
										                <td class='p-0'>
    										                <div class='row'>
    										                        <a href='../../edukasi.php?id=$d[id]' target='_blank' class='btn btn-sm btn-primary mr-2 mb-2'><i class='fas fa-eye'></i></a>
    										                        <a href='edukasi_edit.php?id=$d[id]' class='btn btn-sm btn-warning mr-2 mb-2'><i class='fas fa-pen'></i></a>
    										                        <a href='./delete/edukasi.php?id=$d[id]' class='delete btn btn-danger btn-sm mr-2 mb-2' ><i class='fas fa-trash-alt'></i></a>
    										                </div>
										                </td>
										            </tr>
										        ";
										        $i++;
										    }
										?>
									</tbody>
								</table>
			    			</div>
					    </div>
				    </div>
			    </div>
			</div>
		</div>
	</div>
</div>
<script>
    
        $('.delete').click(function(e){
            e.preventDefault();
            var link = $(this).attr('href');
        
            Swal.fire({
              title: 'Peringatan',
              icon: 'warning',
              text: 'Anda yakin untuk menghapus data ini?',
              showDenyButton: true,
              confirmButtonText: 'Hapus',
              denyButtonText: 'Batal',
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
                window.location.href = link
              } else if (result.isDenied) {
                Swal.fire('Berhasil Dibatalkan', 'Batal menghapus data', 'info')
              }
            })
        });
    
</script>
<?php include "footer.php"; ?>