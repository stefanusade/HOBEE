<?php 
$page='Keuangan';
include "header.php"; 
?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
        	<div class="page-header">
				<h4 class="page-title">Laporan Keuangan</h4>
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
						<a href="laporan.php">Laporan Keuangan</a>
					</li>
				</ul>
			</div>
            <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body py-3">
						    <p>Pilih Periode</p>
						    <div class="row">
						        <div class="col-6 col-md-4 col-lg-3">
						            <input class="form-control" type="date" id="begin">
						        </div>
						        <div class="col-6 col-md-4 col-lg-3">
						            <input class="form-control" type="date" id="end">
						        </div>
						    </div>
							<a id="print" class="btn btn-warning my-3"><i class="fas fa-print"></i> Cetak Laporan</a>
							<div class="table-responsive" id="tampil">
								
			    			</div>
					    </div>
				    </div>
			    </div>
			</div>
		</div>
	</div>
</div>
<script>
    $(document).ready(function(){
        $("#begin").val("<?= date('Y-m'); ?>-01");
        $("#end").val("<?= date('Y-m-d'); ?>");
		$.ajax({
            type: 'GET',
                url: './ajax/laporan.php',
                data: {
            	    begin	: $("#begin").val(),
					end		: $("#end").val()
                },
                cache: false,
                success: function(data) {
                $('#tampil').html(data);
            }
        });
		$("#begin").change(function(){
			$.ajax({
				type: 'GET',
					url: './ajax/laporan.php',
					data: {
						begin	: $("#begin").val(),
						end		: $("#end").val()
					},
					cache: false,
					success: function(data) {
					$('#tampil').html(data);
				}
			});	
		});
		$("#end").change(function(){
			$.ajax({
				type: 'GET',
					url: './ajax/laporan.php',
					data: {
						begin	: $("#begin").val(),
						end		: $("#end").val()
					},
					cache: false,
					success: function(data) {
					$('#tampil').html(data);
				}
			});	
		});
		$("#print").click(function(){
			var url = "./printable/laporan.php?begin=" + $("#begin").val() + "&end=" + $("#end").val();
			window.open(url, '_blank');
		});
    });
</script>
<?php include "footer.php"; ?>