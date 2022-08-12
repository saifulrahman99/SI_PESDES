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
	<title>Halaman Utama</title>
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
				<h5 class="fw-bolder text-center mt-4 mb-4">Sistem Informasi Pelayanan Surat Desa Bantal</h5>

				<div class="row justify-content-center">

					<!-- batas -->
					<div class="box-dashboard col-2 bg-white p-3 my-3 mx-4 shadow-sm text-center">
						<?php
						// query untuk nomer surat
						$query = "SELECT no_surat FROM tb_surat ORDER BY id DESC";
						$result = mysqli_query($db, $query);
						$no_surat = mysqli_fetch_assoc($result);
						if (is_null($no_surat)) {
							$no_s = 0;
						}else{
							$no_s = intval($no_surat['no_surat']);
						}
						?>
						<p class="m-0 fw-bolder fs-5"><?php echo $no_s?></p>
						<p class="m-0">Surat Dibuat</p>
					</div>
					
					<!-- batas -->
					<div class="box-dashboard col-2 bg-white p-3 my-3 mx-4 shadow-sm text-center">
						<?php
						$query = "SELECT * FROM tb_penduduk";
						$result = mysqli_query($db, $query);
						
						$jml_penduduk = mysqli_num_rows($result);
						?>
						<p class="m-0 fw-bolder fs-5"><?php echo $jml_penduduk;?></p>
						<p class="m-0">Penduduk</p>
					</div>
					
					<!-- batas -->
					<div class="box-dashboard col-2 bg-white p-3 my-3 mx-4 shadow-sm text-center">
						<?php
						$query = "SELECT * FROM tb_penduduk WHERE jk LIKE '%L%'";
						$result = mysqli_query($db, $query);

						$jml_L = mysqli_num_rows($result);
						?>
						<p class="m-0 fw-bolder fs-5"><?php echo $jml_L;?></p>
						<p class="m-0">Laki - Laki</p>
					</div>
					
					<!-- batas -->
					<div class="box-dashboard col-2 bg-white p-3 my-3 mx-4 shadow-sm text-center">
						<?php
						$query = "SELECT * FROM tb_penduduk WHERE jk LIKE '%P%'";
						$result = mysqli_query($db, $query);

						$jml_P = mysqli_num_rows($result);
						?>
						<p class="m-0 fw-bolder fs-5"><?php echo $jml_P;?></p>
						<p class="m-0">Perempuan</p>
					</div>
					
					<!-- batas -->
					<div class="box-dashboard col-2 bg-white p-3 my-3 mx-4 shadow-sm text-center">
						<?php
						$query = "SELECT COUNT(DISTINCT no_kk) AS jml_kk FROM tb_penduduk";
						$result = mysqli_query($db, $query);
						$kk = mysqli_fetch_assoc($result);

						$jml_kk = $kk['jml_kk'];
						?>
						<p class="m-0 fw-bolder fs-5"><?php echo $jml_kk;?></p>
						<p class="m-0">Kepala Keluarga</p>
					</div>

				</div>

			</div>

			<!-- footer konten -->
			<div class="footer">
				<span>Copyright 2022 Saiful Rahman. All Right Reserverd</span>
			</div>
		</div>
		<!-- end konten -->
	</div>
</body>
</html>