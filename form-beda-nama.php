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
	<title>Cetak Beda Nama</title>
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

					<h4 class="fw-bolder">Form Surat Keterangan Beda Nama</h4>
					<div class="wrap shadow-sm p-3">
						<!-- form temukan NIK -->
						<form action="cari/cari-cetak.php?jenis=beda-nama" method="POST">
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
						$dusun = $penduduk['dusun'];
						$rt = $penduduk['rt'];
						$rw = $penduduk['rw'];
						$tmpt_lahir = $penduduk['tmpt_lahir'];
						$tgl_lahir = $penduduk['tgl_lahir'];
						$jk = $penduduk['jk'];
						$no_kk = $penduduk['no_kk'];
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

					// ubah kapital semua ke hanya awal kapital
					$tmpt_lahir2 = strtolower($tmpt_lahir);
					$tmpt_lahir3 = ucwords($tmpt_lahir2);

						// ubah ket jk ke kata
					if ($jk == 'L') {
						$jk_new = 'Laki-Laki';
					}elseif($jk == 'P'){
						$jk_new = 'Perempuan';
					}
					?>

					<div class="wrap shadow-sm p-3 mt-3">
						<form action="cetak/cetak-beda-nama.php" method="POST">

							<span style="font-size: 12px; color: green;" class="ms-3">*bantuan data</span>
							<div class="form-group mb-1 ms-3 d-flex align-items-center">
								<p><?php echo "NIK : $result_nik";?></p>
								<p style="margin-left: 60px;"><?php echo "No KK : $no_kk";?></p>
							</div>

							<div class="row ps-3">
								<!-- kiri -->
								<div class="col-5 me-5">
									<div class="form-group mb-1 d-flex align-items-center">
										<label for="no_surat" class="mb-2 col-3 me-2 pt-2 pb-2">No Surat</label>

										<input name="no_surat" id="no_surat"  class="form-control bg-light" type="text" value="<?php echo $no_surat_cek?>" required>
									</div>


									<h4 class="mt-3 mb-2">Data Lama</h4>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nama" class="mb-2 col-3 me-2 pt-2 pb-2">Nama</label>

										<input name="nama" id="nama"  class="form-control bg-light" type="text" value="<?php echo $nama?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="dusun" class="mb-2 col-3 me-2 pt-2 pb-2">Dusun</label>

										<select id="dusun" class="form-control bg-light" name="dusun" required>
											<?php
											if ($dusun == "UTARA") {
												$utara = "selected";
												$tenggara = "";
												$selatan = "";
											}elseif ($dusun == "TENGGARA") {
												$utara = "";
												$tenggara = "selected";
												$selatan = "";
											}elseif ($dusun == "SELATAN") {
												$utara = "";
												$tenggara = "";
												$selatan = "selected";
											}
											?>
											<option value="Utara" <?php echo $utara?> >UTARA</option>
											<option value="Tenggara" <?php echo $tenggara?> >TENGGARA</option>
											<option value="Selatan" <?php echo $selatan?> >SELATAN</option>
										</select>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="rt" class="mb-2 col-3 me-2 pt-2 pb-2">RT</label>

										<input name="rt" id="rt"  class="form-control bg-light" type="text" value="<?php echo $rt?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="rw" class="mb-2 col-3 me-2 pt-2 pb-2">RW</label>

										<input name="rw" id="rw"  class="form-control bg-light" type="text" value="<?php echo $rw?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="jk" class="mb-2 col-3 me-4 pt-2 pb-2">Jenis Kelamin</label>

										<?php
										if ($jk == "L") {
											$jk_L = "checked";
											$jk_P = "";
										}elseif($jk == "P"){
											$jk_L = "";
											$jk_P = "checked";
										}
										?>
										<div class="form-check">
											<input type="radio" class="form-check-input" value="Laki-Laki" id="laki-laki" name="jk" <?php echo $jk_L;?> required>
											<label for="laki-laki" class="form-check-label me-4">Laki-Laki</label>
										</div>
										<div class="form-check disabled">
											<input type="radio" class="form-check-input" value="Perempuan" id="perempuan" name="jk" <?php echo $jk_P;?> required>
											<label for="perempuan" class="form-check-label">Perempuan</label>
										</div>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="tmpt_lahir" class="mb-2 col-3 me-2 pt-2 pb-2">Tempat Lahir</label>

										<input name="tmpt_lahir" id="tmpt_lahir"  class="form-control bg-light" type="text" value="<?php echo $tmpt_lahir3?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="tgl_lahir" class="mb-2 col-3 me-2 pt-2 pb-2">Tgl Lahir</label>

										<input name="tgl_lahir" id="tgl_lahir"  class="form-control bg-light" type="date" value="<?php echo $tgl_lahir?>" required>
									</div>
									

									<h4 class="mb-2 mt-4">Data Baru</h4>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nama2" class="mb-2 col-3 me-2 pt-2 pb-2">Nama</label>

										<input name="nama2" id="nama2"  class="form-control bg-light" type="text" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="dusun2" class="mb-2 col-3 pt-2 pb-2 me-2">Dusun</label>

										<select id="dusun2" class="form-control bg-light" name="dusun2" required>
											<option value="Utara" <?php echo $utara?> >UTARA</option>
											<option value="Tenggara" <?php echo $tenggara?> >TENGGARA</option>
											<option value="Selatan" <?php echo $selatan?> >SELATAN</option>
										</select>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="rt2" class="mb-2 col-3 me-2 pt-2 pb-2">RT</label>

										<input name="rt2" id="rt2" class="form-control bg-light" type="text" value="<?php echo $rt?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="rw2" class="mb-2 col-3 me-2 pt-2 pb-2">RW</label>

										<input name="rw2" id="rw2" class="form-control bg-light" type="text" value="<?php echo $rw?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="jk2" class="mb-2 col-3 pt-2 pb-2 me-4">Jenis Kelamin</label>
										<div class="form-check">
											<input type="radio" class="form-check-input" value="Laki-Laki" id="laki-laki" name="jk2" required>
											<label for="laki-laki" class="form-check-label me-4">Laki-Laki</label>
										</div>
										<div class="form-check disabled">
											<input type="radio" class="form-check-input" value="Perempuan" id="perempuan" name="jk2" required>
											<label for="perempuan" class="form-check-label">Perempuan</label>
										</div>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="tmpt_lahir2" class="mb-2 col-3 me-2 pt-2 pb-2">Tempat Lahir</label>

										<input name="tmpt_lahir2" id="tmpt_lahir2"  class="form-control bg-light" type="text" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="tgl_lahir2" class="mb-2 col-3 me-2 pt-2 pb-2">Tgl Lahir</label>

										<input name="tgl_lahir2" id="tgl_lahir2"  class="form-control bg-light" type="date" required>
									</div>
									

								</div>

								<!-- kanan -->
								<div class="col-6" style="margin-top: 102.5px;">

									<!-- data lama -->

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nm_tertera" class="mb-2 col-3 me-2 pt-2 pb-2 ">Tertera Pada</label>
										
										<textarea name="nm_tertera" id="nm_tertera" class="form-control bg-light" placeholder="KTP atau KK atau Akta dll" required></textarea>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="parameter" class="mb-2 col-3 me-2 pt-2 pb-2">Parameter</label>

										<input name="parameter" id="parameter"  class="form-control bg-light" type="text" placeholder="Sesuai Dengan Data Tertera" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="no_parameter" class="mb-2 col-3 me-2 pt-2 pb-2">Nomor Parameter</label>

										<input name="no_parameter" id="no_parameter"  class="form-control bg-light" type="text" required>
									</div>

									<!-- data baru -->

									<div class="form-group mb-1 d-flex align-items-center" style="margin-top: 225px;">
										<label for="nm_tertera2" class="mb-2 col-3 me-2 pt-2 pb-2 ">Tertera Pada</label>
										
										<textarea name="nm_tertera2" id="nm_tertera2" class="form-control bg-light" placeholder="KTP atau KK atau Akta dll" required></textarea>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="parameter2" class="mb-2 col-3 me-2 pt-2 pb-2">Parameter</label>

										<input name="parameter2" id="parameter2"  class="form-control bg-light" type="text" placeholder="Sesuai Dengan Data Tertera" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="no_parameter2" class="mb-2 col-3 me-2 pt-2 pb-2">Nomor Parameter</label>

										<input name="no_parameter2" id="no_parameter2"  class="form-control bg-light" type="text" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="diubah" class="mb-2 col-3 me-2 pt-2 pb-2">Yang Diubah</label>

										<input name="diubah" id="diubah"  class="form-control bg-light" type="text" placeholder="Nama atau Tanggal Lahir atau nik" required>
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