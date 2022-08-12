<?php

require_once('assets/koneksi.php');
require_once('cek_login.php');

//cek apakah sudah login
//jika belum login, akan di lempar ke form login 
if ($sessionStatus==false) {
	header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Impr Data</title>
	<?php 

	require('config/script.php');
	require('config/style.php'); 
	
	?>
</head>
<body>
	<!-- bagian sidebar -->
	<?php require('komponen/sidebar.php'); ?>

	<!-- header-->
	<?php require('komponen/header-konten.php');?>

	<div id="bungkus" class="d-flex">

		<!-- bagian konten -->
		<div id="konten">
			
			<!-- isi konten -->
			<div class="isi-konten m-3">

				<div class="container">
					<h4 class="fw-bolder">Impor Data Penduduk Dari Excel</h4>

					<div class="wrap shadow-sm p-3 mt-3">
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="col-7 me-5">

								<div class="form-group mb-1 d-flex align-items-center">
									<label for="file_excel" class="mb-2 col-2 pt-2 pb-2">Pilih File</label>

									<input name="file_excel" id="file_excel"  class="form-control bg-light" type="file">

									<input type="submit" name="submit" value="Impor" class="btn btn-info text-white col-3 ms-3">
								</div>

							</div>

						</form>
					</div>

				</div>

			</div>
			<!-- akhir isi konten -->

			<!-- footer konten -->
			<div class="footer">
				<span>Copyright 2022 Saiful Rahman. All Right Reserverd</span>
			</div>
		</div>
		<!-- end konten -->
	</div>
</body>
</html>