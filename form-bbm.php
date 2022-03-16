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
	<title>Cetak Izin BBM</title>
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

					<h4 class="fw-bolder">Form Surat Rekomendasi Pembelian BBM Jenis Tertentu </h4>
					<div class="wrap shadow-sm p-3">
						<!-- form temukan NIK -->
						<form action="cari/cari-cetak.php?jenis=bbm" method="POST">
							<div class="form-group mb-3 d-flex align-items-center col-8">
								<label for="nik" class="mb-2 col-3">NIK Penduduk</label>

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
						<form action="cetak/cetak-bbm.php" method="POST">
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

									<h4 class="mt-4 mb-3">Alamat Usaha</h4>

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
										<label for="rt" class="mb-2 col-3 pt-2 pb-2 pt-2 pb-2">RT Persil</label>

										<input name="rt" id="rt"  class="form-control bg-light" type="text" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="rw" class="mb-2 col-3 pt-2 pb-2">RW Persil</label>

										<input name="rw" id="rw"  class="form-control bg-light" type="text" required>
									</div>

									<h4 class="mt-4 mb-4"> </h4>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="penggunaan" class="mb-2 col-3 pt-2 pb-2 ">Konsumen</label>

										<select id="penggunaan" class="form-control bg-light" name="penggunaan" required>
											<option value="">- Pilih</option>
											<option value="Pribadi">PRIBADI</option>
											<option value="Masyarakat Umum">MASYARAKAT UMUM</option>

										</select>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="j_usaha" class="mb-2 col-3 pt-2 pb-2 ">Jenis Usaha</label>

										<input name="j_usaha" id="j_usaha"  class="form-control bg-light" type="text" placeholder="contoh : Pompa Air" required>
									</div>


									<h4 class="mt-4 mb-3">Pengambilan</h4>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="tmpt_ambil" class="mb-2 col-3 pt-2 pb-2 ">Tempat Pengambilan</label>

										<input name="tmpt_ambil" id="tmpt_ambil"  class="form-control bg-light" type="text" placeholder="contoh : Lembaga Penyalur (SPBU)" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="no_penyalur" class="mb-2 col-3 pt-2 pb-2 ">Nomor Lembaga Penyalur</label>

										<select id="no_penyalur" class="form-control bg-light" name="no_penyalur" required>
											<option value="">- Pilih</option>
											<option value="54.683.04">54.683.04 (Asembagus)</option>
											<option value="54.683.11">54.683.11 (Sumberejo)</option>

										</select>

									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="lokasi_ambil" class="mb-2 col-3 pt-1 pb-1 ">Lokasi Pengambilan</label>

										<input name="lokasi_ambil" id="tmpt_ambil"  class="form-control bg-light" type="text" placeholder="contoh : Asembagus" required>
									</div>

								</div>

								<!-- kanan -->
								<div class="col-6">

									<h4 class="mb-2">Alat</h4>
									<div class="form-group mb-1 d-flex align-items-center">
										<label for="j_alat" class="mb-2 col-3 pt-2 pb-2 me-4">Jenis Alat</label>

										<input name="j_alat" id="j_alat"  class="form-control bg-light" type="text" placeholder="contoh : Mesin Pompa Air" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="jml_alat" class="mb-2 col-3 pt-2 pb-2 me-4">Jumlah Alat</label>

										<input name="jml_alat" id="jml_alat"  class="form-control bg-light" type="number" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="fungsi_alat" class="mb-2 col-3 pt-3 pb-3 me-4">Fungsi Alat</label>

										<textarea name="fungsi_alat" id="fungsi_alat" class="form-control bg-light" placeholder="contoh : Mengairi Lahan Pertanian Padi dan Jagung" required></textarea>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="j_bbm" class="mb-2 col-3 pt-2 pb-2 me-4">Jenis BBM</label>

										<input name="j_bbm" id="j_bbm"  class="form-control bg-light" type="text" placeholder="contoh : Solar" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="jml_kebutuhan" class="mb-2 col-3 pt-2 pb-2 me-4">Jumlah Kebutuhan (Liter)</label>

										<input name="jml_kebutuhan" id="jml_kebutuhan"  class="form-control bg-light" type="number" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="lama_operasi" class="mb-2 col-3 pt-2 pb-2 me-4">Jam/Hari Operasi</label>

										<input name="lama_operasi" id="lama_operasi"  class="form-control bg-light" type="number" required>
										
										<select id="acuan_operasi" class="form-control bg-light ms-3" name="acuan_operasi" required>
											<option value="">- Pilih</option>
											<option value="Hari">HARI</option>
											<option value="Jam">JAM</option>
										</select>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="konsumsi_bbm" class="mb-2 col-3 pt-2 pb-2 me-4">Jumlah Konsumsi BBM</label>

										<input name="konsumsi_bbm" id="konsumsi_bbm"  class="form-control bg-light" type="number" required>
										
										<select id="acuan_konsumsi" class="form-control bg-light ms-3" name="acuan_konsumsi" required>
											<option value="">- Pilih</option>
											<option value="Jam">JAM</option>
											<option value="Hari">HARI</option>
											<option value="Minggu">MINGGU</option>
											<option value="Bulan">BULAN</option>
										</select>
									</div>

									<h4 class="mt-3 mb-2">Masa Berlaku Surat</h4>

									<?php
									// hari sekarang
									$tgl1 = date('Y-m-d');
									$tgl2 = date('Y-m-d',strtotime('+30 days',strtotime($tgl1))); // operasi

									?>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="berlaku" class="mb-2 col-3 pt-2 pb-2 me-4">Masa Berlaku Sampai</label>

										<input name="berlaku" id="berlaku"  class="form-control bg-light" type="date" value="<?php echo $tgl2?>" required>
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