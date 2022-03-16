<?php
require_once('assets/koneksi.php');
require_once('cek_login.php');

//cek apakah sudah login
//jika belum login, akan di lempar ke form login 
if ($sessionStatus==false) {
	header("Location: login.php");
}

// filter get nik
if (isset($_GET['nik_cari'])) {
	$result_nik = $_GET['nik_cari'];
}
else{
	$result_nik = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ubah Data Kepala Desa</title>
	<?php require('config/style.php'); ?>
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
				<div class="container mt-4">
					

					<div class="wrap shadow-sm p-3 mb-4">
						<!-- form temukan NIK -->
						<form action="cari/cari-kepdes.php?jenis=skkb" method="POST">
							<div class="form-group mb-3 d-flex align-items-center col-8">
								<label for="nik" class="mb-2 col-3">NIK Kepala Desa</label>

								<input name="nik" id="nik"  class="form-control bg-light me-3" type="text" placeholder="Temukan NIK">

								<input type="submit" name="submit" value="Temukan" class="btn btn-info text-white col-2">
							</div>

						</form>

					</div>

					<h4 class="fw-bolder">Data Kepala Desa</h4>

					<div class="wrap col table-responsive shadow-sm rounded p-3 mt-2">
						<?php

						$queryKepdes = "SELECT * FROM tb_penduduk WHERE nik = '$result_nik'";
						$hasil = mysqli_query($db,$queryKepdes);

						foreach ($hasil as $dbKepdes) {
							$namaKepdes = $dbKepdes['nama'];
							$nikKepdes = $dbKepdes['nik'];
						}


						$query= "SELECT * FROM tb_kepdes";
						$result=mysqli_query($db, $query);
								// foreach
						foreach ($result as $kepdes) {
							$nama = $kepdes['nama'];
							$nik = $kepdes['nik'];
						}
						if (empty($nama)) {
							$nama = "";
						}
						if (empty($nik)) {
							$nik = "";
						} 
						?>
						<form action="action/action-update-kepdes.php" method="POST">
							<div class="row">
								<div class="col-4">
									<div class="form-group mb-3 d-flex align-items-center">
										<label for="nik" class="mb-2 col-2">NIK</label>

										<input name="nik" id="nik"  class="form-control bg-light" type="number" value="<?php echo empty($_GET['nik_cari']) ? $nik : $nikKepdes ?>">

									</div>
								</div>
								<div class="col-4">
									<div class="form-group mb-3 d-flex align-items-center ">
										<label for="nama" class="mb-2 col-2 ms-3">Nama</label>

										<input name="nama" id="nama"  class="form-control bg-light" type="text" value="<?php echo empty($_GET['nik_cari']) ? $nama : $namaKepdes ?>">

									</div>
								</div>
							</div>

							<input type="submit" name="submit" value="Perbarui" class="btn btn-info text-white col-2">
						</form>

					</div>

				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php require('config/script.php'); ?>
