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
// filter get nik
if (isset($_GET['nik_cari2'])) {
	$result_nik2 = $_GET['nik_cari2'];
}
else{
	$result_nik2 = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cetak Izin Tebang Kayu</title>
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

					<h4 class="fw-bolder">Form Surat Permohonan Izin Penebangan Kayu</h4>
					<div class="wrap shadow-sm p-3">
						<!-- form temukan NIK -->
						<form action="cari/cari-cetak.php?jenis=kayu" method="POST">
							<div class="form-group mb-3 d-flex align-items-center col-6">
								<label for="nik" class="mb-2 col-3">NIK Pengaju</label>

								<input name="nik" id="nik"  class="form-control bg-light me-3" type="text" placeholder="Temukan NIK">

							</div>

							<div class="form-group mb-3 d-flex align-items-center col-6">
								<label for="nik2" class="mb-2 col-3">NIK Pembeli</label>

								<input name="nik2" id="nik2"  class="form-control bg-light me-3" type="text" placeholder="Temukan NIK">
							</div>

							<input type="submit" name="submit" value="Temukan" class="btn btn-info text-white col-2">

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
						$pekerjaan = $penduduk['pekerjaan'];
						$dusun = $penduduk['dusun'];
						$rt = $penduduk['rt'];
						$rw = $penduduk['rw'];

					}

					$query3 = "SELECT * FROM tb_penduduk WHERE nik = '$result_nik2'";
					$result3 = mysqli_query($db, $query3);

					$data_result2 = mysqli_num_rows($result3);

					// definisikan data
					foreach ($result3 as $penduduk) {
						$nama_b = $penduduk['nama'];
						$pekerjaan_b = $penduduk['pekerjaan'];
						$dusun_b = $penduduk['dusun'];
						$rt_b = $penduduk['rt'];
						$rw_b = $penduduk['rw'];

					}

					$desa = "Bantal";
					$kecamatan = "Asembagus";
					$kabupaten = "Situbondo";

					// filter atau pencegah error pemanggilan data
					if (empty($result_nik)) {
						$nama = "";
						$pekerjaan = "";
						$dusun = "xxx";
						$rt = "xxx";
						$rw = "xxx";

						$desa = "xxx";
						$kecamatan = "xxx";
						$kabupaten = "xxx";

						$pekerjaan5 = $pekerjaan;
						$dusun3 = $dusun;
					}
					
					if ($dusun == "xxx") {

					}else{
						$dusun2 = strtolower($dusun);
						$dusun3 = ucwords($dusun2);
					}

					if ($pekerjaan == "xxx") {
						
					}else{
						$pekerjaan2 = strtolower($pekerjaan);

						$pekerjaan3 = explode('/', $pekerjaan2);
						if (empty($pekerjaan3[1])) {
							$pekerjaan3[1] = "";
						}else{
							$pekerjaan3[1] = "$pekerjaan3[1]";
						}
						$kata_2_pekerjaan = ucwords("$pekerjaan3[1]");
						$kata_2_pekerjaan2 = "/$kata_2_pekerjaan";

						if (empty($pekerjaan3[1])) {
							$kata_2_pekerjaan_filter = "";
						}else{
							$kata_2_pekerjaan_filter = $kata_2_pekerjaan2;
						}

						$pekerjaan5 = ucwords("$pekerjaan3[0]$kata_2_pekerjaan_filter");
					}

					// bagian 2
					// filter atau pencegah error pemanggilan data
					if (empty($result_nik2)) {
						$nama_b = "";
						$pekerjaan_b = "";
						$dusun_b = "xxx";
						$rt_b = "xxx";
						$rw_b = "xxx";

						$pekerjaan5_b = $pekerjaan;
						$dusun3_b = $dusun;
					}
					
					if ($dusun_b == "xxx") {

					}else{
						$dusun2_b = strtolower($dusun_b);
						$dusun3_b = ucwords($dusun2_b);
					}

					if ($pekerjaan_b == "xxx") {
						
					}else{
						$pekerjaan2_b = strtolower($pekerjaan_b);

						$pekerjaan3_b = explode('/', $pekerjaan2_b);
						if (empty($pekerjaan3_b[1])) {
							$pekerjaan3_b[1] = "";
						}else{
							$pekerjaan3_b[1] = "$pekerjaan3_b[1]";
						}
						$kata_2_pekerjaan_b = ucwords("$pekerjaan3_b[1]");
						$kata_2_pekerjaan2_b = "/$kata_2_pekerjaan_b";

						if (empty($pekerjaan3_b[1])) {
							$kata_2_pekerjaan_filter_b = "";
						}else{
							$kata_2_pekerjaan_filter_b = $kata_2_pekerjaan2_b;
						}

						$pekerjaan5_b = ucwords("$pekerjaan3_b[0]$kata_2_pekerjaan_filter_b");
					}

					?>

					<div class="wrap shadow-sm p-3 mt-3">
						<form action="cetak/cetak-kayu.php" method="POST">
							<div class="row ps-3">
								<!-- kiri -->
								<div class="col-5 me-5">
									<div class="form-group mb-1 d-flex align-items-center">
										<label for="no_surat" class="mb-2 col-3 pt-2 pb-2">No Surat</label>

										<input name="no_surat" id="no_surat"  class="form-control bg-light" type="text" value="<?php echo $no_surat_cek?>" required>
									</div>

									<h4 class="mt-4 mb-2">Yang Mengajukan</h4>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nama" class="mb-2 col-3 pt-2 pb-2">Nama</label>

										<input name="nama" id="nama"  class="form-control bg-light" type="text" value="<?php echo $nama?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="pekerjaan" class="mb-2 col-3 pt-2 pb-2">Pekerjaan</label>

										<input name="pekerjaan" id="pekerjaan"  class="form-control bg-light" type="text" value="<?php echo $pekerjaan5?>" required>
									</div>



									<h4 class="mt-5 mb-2">Letak Tanah</h4>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nama2" class="mb-2 col-3 pt-2 pb-2">Atas Nama</label>

										<input name="nama2" id="nama2"  class="form-control bg-light" type="text" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="almat2" class="mb-2 col-3 pt-2 pb-2">Letak Persil</label>

										<textarea name="alamat2" id="alamat2" class="form-control bg-light" rows="2">Kampung xxx RT : xxx RW : xxx</textarea>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="no_sppt" class="mb-2 col-3 pt-2 pb-2">No Sppt</label>

										<input name="no_sppt" id="no_sppt"  class="form-control bg-light" type="text" value="35.12.140.004.xxx.0" required>
									</div>

									<h4 class="mt-5 mb-2">Data Pemakai Kayu</h4>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nama3" class="mb-2 col-3 pt-2 pb-2">Nama</label>

										<input name="nama3" id="nama3"  class="form-control bg-light" type="text" value="<?php echo $nama_b?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="pekerjaan2" class="mb-2 col-3 pt-2 pb-2">Pekerjaan</label>

										<input name="pekerjaan2" id="pekerjaan2"  class="form-control bg-light" type="text" value="<?php echo $pekerjaan5_b?>" required>
									</div>

									<h4 class="mt-5 mb-2">Ketentuan Pemakaian Kayu</h4>

									<div class="form-group mb-1 d-flex align-items-center">
										<div class="form-check">
											<input type="radio" class="form-check-input" value="sendiri" id="sendiri" name="pemakaian" required>
											<label for="sendiri" class="form-check-label me-5">Dipakai Sendiri</label>
										</div>
										<div class="form-check disabled">
											<input type="radio" class="form-check-input" value="dijual" id="dijual" name="pemakaian" required>
											<label for="dijual" class="form-check-label">Dijual</label>
										</div>
									</div>


								</div>

								<!-- kanan -->
								<div class="col-6">

									<!-- bagian yang mengajukan -->
									<div class="form-group mb-1 d-flex align-items-center" style="margin-top: 110px;">
										<label for="alamat" class="mb-2 col-2 pt-2 pb-2">Alamat</label>

										<textarea name="alamat" id="alamat" class="form-control bg-light" rows="3">Kampung <?php echo $dusun3?> RT : <?php echo $rt?> RW : <?php echo $rw?> Desa <?php echo $desa?>, Kecamatan <?php echo $kecamatan?>, Kabupaten <?php echo $kabupaten?>.</textarea>
									</div>

									<!-- bagian letak tanah -->
									<div class="form-group mb-1 d-flex align-items-center" style="margin-top: 90px;">
										<label for="j_kayu" class="mb-2 col-3 pt-2 pb-2 ">Jenis Kayu/Pohon</label>

										<input name="j_kayu" id="j_kayu"  class="form-control bg-light" type="text" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="jml_kayu" class="mb-2 col-3 pt-1 pb-1 ">Jumlah Kayu</label>

										<input name="jml_kayu" id="tmpt_ambil"  class="form-control bg-light" type="number" required>
									</div>

									<!-- bagian Pembeli -->
									<div class="form-group mb-1 d-flex align-items-center" style="margin-top: 144px;">
										<label for="alamat3" class="mb-2 col-2 pt-2 pb-2">Alamat</label>

										<textarea name="alamat3" id="alamat3" class="form-control bg-light" rows="3">Kampung <?php echo $dusun3_b?> RT : <?php echo $rt_b?> RW : <?php echo $rw_b?> Desa <?php echo $desa?>, Kecamatan <?php echo $kecamatan?>, Kabupaten <?php echo $kabupaten?>.</textarea>

									</div>

								</div>
							</div>

							<input type="submit" name="submit" value="Cetak" class="btn btn-info text-white col-2 ms-3 mt-4">
						</form>
					</div>

				</div>
			</div>

		</div>
		<!-- end konten -->
	</div>
</body>
</html>