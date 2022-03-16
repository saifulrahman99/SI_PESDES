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
	<title>Cetak Ket Kenal Lahir</title>
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

					<h4 class="fw-bolder">Form Surat Keterangan Kenal Lahir (Kelahiran)</h4>
					
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

					?>

					<div class="wrap shadow-sm p-3 mt-3">

						<form action="cetak/cetak-lahir.php" method="POST">
							<div class="row ps-3">

								<!-- kiri -->
								<div class="col-5 me-5">
									<div class="form-group mb-1 d-flex align-items-center">
										<label for="no_surat" class="mb-2 col-3 pt-2 pb-2">No Surat</label>

										<input name="no_surat" id="no_surat"  class="form-control bg-light" type="text" value="<?php echo $no_surat_cek?>" required>
									</div>

									<h4 class="my-3">Data Anak</h4>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nama" class="mb-2 col-3 pt-2 pb-2  me-3">Nama</label>

										<input name="nama" id="nama"  class="form-control bg-light" type="text" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="jk" class="mb-2 col-3 pt-2 pb-2 me-4">Jenis Kelamin</label>
										
										<div class="form-check">
											<input type="radio" class="form-check-input" value="Laki-Laki" id="laki-laki" name="jk" required>
											<label for="laki-laki" class="form-check-label me-4">Laki-Laki</label>
										</div>

										<div class="form-check disabled">
											<input type="radio" class="form-check-input" value="Perempuan" id="perempuan" name="jk" required>
											<label for="perempuan" class="form-check-label">Perempuan</label>
										</div>

									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="tgl_kelahiran" class="mb-2 col-3 pt-2 pb-2  me-3">Tanggal Kelahiran</label>

										<input name="tgl_kelahiran" id="tgl_kelahiran"  class="form-control bg-light" type="datetime-local" required>
									</div>

								</div>

								<!-- kanan -->

								<div class="col-6">
									<h4 class="mb-3">Data Orang Tua</h4>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nm_ibu" class="mb-2 col-3 pt-2 pb-2">Nama Ibu</label>

										<input name="nm_ibu" id="nm_ibu"  class="form-control bg-light" type="text" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nm_ayah" class="mb-2 col-3 pt-2 pb-2">Nama Ayah</label>

										<input name="nm_ayah" id="nm_ayah"  class="form-control bg-light" type="text" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="dusun" class="mb-2 col-3 pt-2 pb-2">Dusun</label>

										<input name="dusun" id="dusun"  class="form-control bg-light" type="text"  required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="rt" class="mb-2 col-3 pt-2 pb-2">RT</label>

										<input name="rt" id="rt"  class="form-control bg-light" type="text" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="rw" class="mb-2 col-3 pt-2 pb-2">RW</label>

										<input name="rw" id="rw"  class="form-control bg-light" type="text" required>
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