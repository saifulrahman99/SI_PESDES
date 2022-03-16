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
	<title>Cetak Harga Tanah</title>
	<?php 
	require('config/style.php');
	require('config/script.php'); 
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

					<h4 class="fw-bolder">Form Surat Keterangan Harga Tanah</h4>
					<div class="wrap shadow-sm p-3">
						<!-- form temukan NIK -->
						<form action="cari/cari-cetak.php?jenis=harga-tanah" method="POST">
							<div class="form-group mb-3 d-flex align-items-center col-8">
								<label for="nik" class="mb-2 col-3 pt-2 pb-2">NIK Penduduk</label>

								<input name="nik" id="nik"  class="form-control bg-light me-3" type="text" placeholder="Temukan NIK">

								<input type="submit" name="submit" value="Temukan" class="btn btn-info text-white col-2">
							</div>

						</form>

					</div>
					<?php
					// query untuk nomer surat
					$query = "SELECT no_surat FROM tb_surat ORDER BY id DESC";
					$result = mysqli_query($db, $query);
					$no_surat = mysqli_fetch_assoc($result);

					// nomor surat otomatis
					if (empty($no_surat['no_surat'])) {
						$no_surat_cek = "001";
					}else{
						$no_surat = $no_surat['no_surat'];
						$no_surat_cek = $no_surat+1;
						$hitung_word = strlen($no_surat_cek);
						if ($hitung_word == 3) {
							$no_surat_cek = ''.$no_surat_cek.'';
						}elseif ($hitung_word == 2) {
							$no_surat_cek = '0'.$no_surat_cek.'';
						}else{
							$no_surat_cek = '00'.$no_surat_cek.'';
						}
					}

					// panggil data dari nik cari

					// query untuk data penduduk
					$query2 = "SELECT * FROM tb_penduduk WHERE nik = '$result_nik'";
					$result2 = mysqli_query($db, $query2);

					$data_result2 = mysqli_num_rows($result2);

					// definisikan data
					foreach ($result2 as $penduduk) {
						$nama = $penduduk['nama'];
					}

					// filter atau pencegah error pemanggilan data
					if (empty($result_nik)) {
						die();
					}

					// kondisi jika nik yang di cari tidak ditemukan 
					if ($data_result2 == 0) {
						?>
						<div class="no-data wrap shadow-sm p-3 mt-3 d-flex justify-content-center">
							<div class="bg-danger rounded px-2 py-1">
								<span class="text-white" style="cursor: default; font-size: 14px;">Data Tidak Ditemukan !</span>
							</div>
						</div>
						<?php
						die();
					}

					?>

					<div class="wrap shadow-sm p-3 mt-3">
						<form action="cetak/cetak-harga-tanah.php" method="POST">
							<div class="row ps-3">
								<!-- kiri -->
								<div class="col-5 me-5">
									<div class="form-group mb-1 d-flex align-items-center">
										<label for="no_surat" class="mb-2 col-3 pt-2 pb-2">No Surat</label>

										<input name="no_surat" id="no_surat"  class="form-control bg-light" type="text" value="<?php echo $no_surat_cek?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nama" class="mb-2 col-3 pt-2 pb-2">Nama</label>

										<input name="nama" id="nama"  class="form-control bg-light" type="text" value="<?php echo $nama?>" required>
									</div>

									<h4 class="mt-4 mb-3">Lokasi Tanah</h4>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="dusun" class="col-3 pt-2 pb-2">Dusun</label>

										<select id="dusun" class="form-control bg-light" name="dusun" required>
											<option value="">- Pilih Dusun</option>
											<option value="Utara">UTARA</option>
											<option value="Selatan">SELATAN</option>
											<option value="Tenggara">TENGGARA</option>

										</select>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="rt" class="mb-2 col-3 pt-2 pb-2">RT Persil</label>

										<input name="rt" id="rt"  class="form-control bg-light" type="text" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="rw" class="mb-2 col-3 pt-2 pb-2">RW Persil</label>

										<input name="rw" id="rw"  class="form-control bg-light" type="text" required>
									</div>
									<h4 class="mt-5 mb-5"> </h4>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="luas" class="mb-2 col-3 pt-2 pb-2">Luas Persil</label>

										<input name="luas" id="luas"  class="form-control bg-light" type="text" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="penggunaan" class="mb-2 col-3 pt-2 pb-2 ">Penggunaan Persil</label>

										<input name="penggunaan" id="penggunaan"  class="form-control bg-light" placeholder="Dikelola xxx, jenis xxx" type="text">
									</div>

								</div>

								<!-- kanan -->
								<div class="col-6">

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="no_sertifikat" class="mb-2 col-3 pt-2 pb-2 me-4">Nomor SHM</label>

										<input name="no_sertifikat" id="no_sertifikat"  class="form-control bg-light" type="number">
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="b_utara" class="mb-2 col-3 pt-2 pb-2 me-4">Batas Utara</label>

										<input name="b_utara" id="b_utara"  class="form-control bg-light" type="text">
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="b_timur" class="mb-2 col-3 pt-2 pb-2 me-4">Batas Timur</label>

										<input name="b_timur" id="b_timur"  class="form-control bg-light" type="text">
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="b_selatan" class="mb-2 col-3 pt-2 pb-2 me-4">Batas Selatan</label>

										<input name="b_selatan" id="b_selatan"  class="form-control bg-light" type="text">
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="b_barat" class="mb-2 col-3 pt-2 pb-2 me-4">Batas Barat</label>

										<input name="b_barat" id="b_barat"  class="form-control bg-light" type="text">
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="harga_t" class="mb-2 col-3 pt-2 pb-2 me-4">Harga Tanah</label>

										<input name="harga_t" id="harga_t"  class="form-control bg-light" type="number" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="harga_b" class="mb-2 col-3 pt-2 pb-2 me-4">Harga Bangunan</label>

										<input name="harga_b" id="harga_b"  class="form-control bg-light" type="number">
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="f_surat" class="col-3 pt-2 pb-2 me-4">Format Surat</label>

										<select id="f_surat" class="form-control bg-light" name="f_surat" required>
											<option value="">- Pilih Format</option>
											<option value="fbiasa">FORMAT BIASA</option>
											<option value="flengkap">FORMAT LENGKAP</option>

										</select>
									</div>

								</div>
							</div>

							<input type="submit" name="submit" value="Cetak" class="btn btn-info text-white col-2 ms-3 mt-3">
						</form>
					</div>

				</div>
			</div>

		</div>
		<!-- end konten -->
	</div>
</body>
</html>