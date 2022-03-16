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
	<title>Cetak Surat Pindah</title>
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

					<h4 class="fw-bolder">Form Surat Keterangan Pindah</h4>
					<div class="wrap shadow-sm p-3">
						<!-- form temukan NIK -->
						<form action="cari/cari-cetak.php?jenis=pindah" method="POST">
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

					// filter atau pencegah error pemanggilan data
					if (empty($result_nik)) {
						die();
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
						$no_kk = $penduduk['no_kk'];
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

					$query3 = "SELECT * FROM tb_penduduk WHERE no_kk = '$no_kk' AND shdk LIKE '%KEPALA KELUARGA%'";
					$result3 = mysqli_query($db, $query3);

					// definisikan data
					$nm_kk = mysqli_fetch_assoc($result3);

					$kepala_keluarga = $nm_kk['nama'];

					// ubah kapital semua ke hanya awal kapital
					$dusun2 = strtolower($dusun);
					$dusun3 = ucwords($dusun2);

					?>

					<div class="wrap shadow-sm p-3 mt-3">
						<form action="cetak/cetak-pindah.php" method="POST">
							<div class="row ps-3">
								<!-- kiri -->
								<div class="col-5 me-5">
									<div class="form-group mb-1 d-flex align-items-center">
										<label for="no_surat" class="mb-2 col-3 pt-2 pb-2">No Surat</label>

										<input name="no_surat" id="no_surat"  class="form-control bg-light" type="text" value="<?php echo $no_surat_cek?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nik" class="mb-2 col-3 pt-2 pb-2">NIK</label>

										<input name="nik" id="nik"  class="form-control bg-light" type="text" value="<?php echo $result_nik?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nama" class="mb-2 col-3 pt-2 pb-2">Nama</label>

										<input name="nama" id="nama"  class="form-control bg-light" type="text" value="<?php echo $nama?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="dusun" class="mb-2 col-3 pt-2 pb-2">Dusun</label>

										<input name="dusun" id="dusun"  class="form-control bg-light" type="text" value="<?php echo $dusun3?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="rt" class="mb-2 col-3 pt-2 pb-2">RT</label>

										<input name="rt" id="rt"  class="form-control bg-light" type="text" value="<?php echo $rt?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="rw" class="mb-2 col-3 pt-2 pb-2">RW</label>

										<input name="rw" id="rw"  class="form-control bg-light" type="text" value="<?php echo $rw?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="no_kk" class="mb-2 col-3 pt-2 pb-2">Nomor KK</label>

										<input name="no_kk" id="no_kk"  class="form-control bg-light" type="text" value="<?php echo $no_kk?>" required>
									</div>

								</div>

								<!-- kanan -->
								<div class="col-6">
									
									<div class="form-group mb-1 d-flex align-items-center">
										<label for="kp_kk" class="mb-2 col-3 pt-2 pb-2 me-4">Kepala Keluarga</label>

										<input name="kp_kk" id="kp_kk"  class="form-control bg-light" type="text" value="<?php echo $kepala_keluarga?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="alamat_pindah" class="mb-2 col-3 pt-2 pb-2 me-4">Alamat Pindah</label>

										<textarea name="alamat_pindah" id="alamat_pindah" class="form-control bg-light" rows="4">Kampung ..., RT ... / RW ... Desa ..., Kecamatan ... Kode Pos ..., Kabupaten ..., Provinsi ...</textarea>
										
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="jml_pindah" class="mb-2 col-3 pt-2 pb-2 me-4">Jumlah yang Pindah</label>

										<input name="jml_pindah" id="jml_pindah"  class="form-control bg-light" type="number" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">

										<label for="jenis" class="mb-2 col-3 pt-2 pb-2 me-4">Format Surat</label>

										<select id="jenis" class="form-control bg-light" name="jenis" required>
											<option value="">- Pilih</option>

											<option value="ANTAR DUSUN, RT/RW DALAM SATU DESA/KELURAHAN">ANTAR DUSUN, RT/RW DALAM SATU DESA/KELURAHAN</option>

											<option value="ANTAR KECAMATAN DALAM SATU KABUPATEN/KOTA">ANTAR KECAMATAN DALAM SATU KABUPATEN/KOTA</option>

											<option value="ANTAR KABUPATEN/KOTA DALAM SATU PROVINSI">ANTAR KABUPATEN/KOTA DALAM SATU PROVINSI</option>

											<option value="ANTAR KABUPATEN/KOTA ATAU ANTAR PROVINSI">ANTAR KABUPATEN/KOTA ATAU ANTAR PROVINSI</option>

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