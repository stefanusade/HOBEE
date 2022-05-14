    <footer class="bg-secondary">
        <div class="container py-4 text-white">
            <div class="row mx-2">
                <div class="col-md-6 col-lg-4 my-3">
                    <h2><b>Madu Samsi</b></h2>
                    <hr class="line-10">
                    <p>Wonosalam, Jombang</p>
                </div>
                <div class="col-md-6 col-lg-4 my-3">
                    <h5><b>SITEMAP</b></h5>
                    <hr class="line-10">
                    <a class="text-white" href="../../index.php">Beranda</a><br>
                    <a class="text-white" href="../../edukasi.php">Edukasi</a><br>
                    <a class="text-white" href="../../toko.php">Toko</a><br>
                    <a class="text-white" href="../../customer">Pelanggan</a><br>
                    <a class="text-white" href="../../backend">Admin dan Supplier</a><br>
                </div>
                <div class="col-md-6 col-lg-4 my-3">
                    <h5><b>MEDIA SOSIAL</b></h5>
                    <hr class="line-10">
                    <p>Tagline Madu Samsi</p>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-dark text-center text-white py-3">
            <p>Madu Samsi. <?= $year; ?></p>
        </div>
    </footer>


	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
					]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>

</body>
</html>