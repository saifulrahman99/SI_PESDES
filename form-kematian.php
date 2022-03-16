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
	<title>Cetak Ket Kematian</title>
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

					<h4 class="fw-bolder">Form Surat Keterangan Kematian</h4>
					<div class="wrap shadow-sm p-3">
						<!-- form temukan NIK -->
						<form action="cari/cari-cetak.php?jenis=kematian" method="POST">
							<div class="form-group mb-3 d-flex align-items-center">
								<label for="nik" class="mb-2 col-2 pt-2 pb-2">NIK Yang Meninggal</label>

								<input name="nik" id="nik"  class="form-control bg-light me-3" type="text" placeholder="Temukan NIK" style="width:300px;">
							</div>

							<div class="form-group mb-3 d-flex align-items-center">
								<label for="nik2" class="mb-2 col-2 pt-2 pb-2">NIK Pelapor</label>

								<input name="nik2" id="nik2"  class="form-control bg-light me-3" type="text" placeholder="Temukan NIK" style="width:300px;">
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
						$dusun = $penduduk['dusun'];
						$rt = $penduduk['rt'];
						$rw = $penduduk['rw'];
						$tmpt_lahir = $penduduk['tmpt_lahir'];
						$tgl_lahir = $penduduk['tgl_lahir'];
						$jk = $penduduk['jk'];
						$pekerjaan = $penduduk['pekerjaan'];
						$agama = $penduduk['agama'];
					}

					$query3 = "SELECT * FROM tb_penduduk WHERE nik = '$result_nik2'";
					$result3 = mysqli_query($db, $query3);
					$data_result3 = mysqli_num_rows($result3);

					// definisikan data
					foreach ($result3 as $penduduk2) {
						$nama2 = $penduduk2['nama'];
						$nik2 = $penduduk2['nik'];
					}

					// filter atau pencegah error pemanggilan data
					if (empty($result_nik) AND empty($result_nik2)) {
						die();
					}

					// kondisi jika nik yang di cari tidak ditemukan 
					if ($data_result2 == 0 && $data_result3 == 0) {
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
					$dusun2 = strtolower($dusun);
					$dusun3 = ucwords($dusun2);
					$pekerjaan2 = strtolower($pekerjaan);
					$agama2 = strtolower($agama);
					$agama3 = ucwords($agama2);
					$tmpt_lahir2 = strtolower($tmpt_lahir);
					$tmpt_lahir3 = ucwords($tmpt_lahir2);

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

						// ubah ket jk ke kata
					if ($jk == 'L') {
						$jk_new = 'Laki-Laki';
					}elseif($jk == 'P'){
						$jk_new = 'Perempuan';
					}

					?>

					<div class="wrap shadow-sm p-3 mt-3">

						<form action="cetak/cetak-kematian.php" method="POST">
							<div class="row ps-3">
								<!-- kiri -->
								<div class="col-5 me-5">
									<div class="form-group mb-1 d-flex align-items-center">
										<label for="no_surat" class="mb-2 col-3 pt-2 pb-2">No Surat</label>

										<input name="no_surat" id="no_surat"  class="form-control bg-light" type="text" value="<?php echo $no_surat_cek?>" required>
									</div>

									<h4 class="my-3">Data Orang Yang Meninggal</h4>

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
										<label for="pekerjaan" class="mb-2 col-3 pt-2 pb-2">Pekerjaan</label>

										<input name="pekerjaan" id="pekerjaan"  class="form-control bg-light" type="text" value="<?php echo $pekerjaan5?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="agama" class="mb-2 col-3 pt-2 pb-2 ">Agama</label>

										<input name="agama" id="agama"  class="form-control bg-light" type="text" value="<?php echo $agama3?>" required>
									</div>

								</div>

								<!-- kanan -->
								<div class="col-6">

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="tmpt_lahir" class="mb-2 col-3 pt-2 pb-2 me-4">Tempat Lahir</label>

										<input name="tmpt_lahir" id="tmpt_lahir"  class="form-control bg-light" type="text" value="<?php echo $tmpt_lahir3?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="tgl_lahir" class="mb-2 col-3 pt-2 pb-2 me-4">Tgl Lahir</label>

										<input name="tgl_lahir" id="tgl_lahir"  class="form-control bg-light" type="date" value="<?php echo $tgl_lahir?>" required>
									</div>


									<div class="form-group mb-1 d-flex align-items-center">
										<label for="ket_wn" class="mb-2 col-3 pt-2 pb-2 me-4">Warga Negara</label>

										<input name="ket_wn" id="ket_wn"  class="form-control bg-light" type="text" value="WNI" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="jk" class="mb-2 col-3 pt-2 pb-2 me-4">Jenis Kelamin</label>

										<input name="jk" id="jk"  class="form-control bg-light" type="text" value="<?php echo $jk_new?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="tgl_mati" class="mb-2 col-3 pt-2 pb-2 me-4">Tgl Meninggal</label>

										<input name="tgl_mati" id="tgl_mati"  class="form-control bg-light" type="date" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="sebab" class="mb-2 col-3 pt-2 pb-2 me-4">Penyebab Meninggal</label>

										<input name="sebab" id="sebab"  class="form-control bg-light" type="text" required>
									</div>

									<h4 class="my-3">Data Pelapor</h4>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nama_lapor" class="mb-2 col-3 pt-2 pb-2 me-4">Nama Pelapor</label>

										<input name="nama_lapor" id="nama_lapor"  class="form-control bg-light" type="text" value="<?php echo $nama2?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nik_lapor" class="mb-2 col-3 pt-2 pb-2 me-4">NIK Pelapor</label>

										<input name="nik_lapor" id="nik_lapor"  class="form-control bg-light" type="text" value="<?php echo $nik2?>" required>
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