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
	<title>Tambah Data Penduduk</title>
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
				<div class="container">
					
					<h4 class="fw-bolder">Tambah Data Penduduk</h4>
					
					<!-- <a href="impor-data.php" class="btn btn-success mt-3 text-white px-4 py-1">Impor Dari Excel</a> -->

					<div class="wrap shadow-sm p-3 mt-3">
						<form action="action/action-penduduk.php?opsi=input" method="POST">
							<div class="row ps-3">
								<!-- kiri -->
								<div class="col-5 me-5">

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="no_kk" class="mb-2 col-3 pt-2 pb-2">Nomor KK</label>

										<input name="no_kk" id="no_kk"  class="form-control bg-light" type="number">
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nama" class="mb-2 col-3 pt-2 pb-2">Nama</label>

										<input name="nama" id="nama"  class="form-control bg-light" type="text" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nik" class="mb-2 col-3 pt-2 pb-2">NIK</label>

										<input name="nik" id="nik"  class="form-control bg-light" type="number" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="dusun" class="mb-2 col-3 pt-2 pb-2">Dusun</label>

										<select id="dusun" class="form-control bg-light" name="dusun" required>
											<option value="">- Pilih Dusun</option>
											<option value="UTARA">UTARA</option>
											<option value="TENGGARA">TENGGARA</option>
											<option value="SELATAN">SELATAN</option>
										</select>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="rt" class="mb-2 col-3 pt-2 pb-2">RT</label>

										<input name="rt" id="rt"  class="form-control bg-light" type="text" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="rw" class="mb-2 col-3 pt-2 pb-2">RW</label>

										<input name="rw" id="rw"  class="form-control bg-light" type="text" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="tmpt_lahir" class="mb-2 col-3 pt-2 pb-2">Tempat Lahir</label>

										<input name="tmpt_lahir" id="tmpt_lahir"  class="form-control bg-light" type="text" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="tgl_lahir" class="mb-2 col-3 pt-2 pb-2">Tanggal Lahir</label>

										<input name="tgl_lahir" id="tgl_lahir"  class="form-control bg-light" type="date" required>
									</div>

								</div>

								<!-- kanan -->
								<div class="col-6">

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="jk" class="mb-2 col-3 pt-2 pb-2 me-4">Jenis Kelamin</label>
										<div class="form-check">
											<input type="radio" class="form-check-input" value="L" id="laki-laki" name="jk" required>
											<label for="laki-laki" class="form-check-label me-4">Laki-Laki</label>
										</div>
										<div class="form-check disabled">
											<input type="radio" class="form-check-input" value="P" id="perempuan" name="jk" required>
											<label for="perempuan" class="form-check-label">Perempuan</label>
										</div>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">

										<label for="shdk" class="mb-2 col-3 pt-2 pb-2 me-4">SHDK</label>

										<select id="shdk" class="form-control bg-light" name="shdk" required>
											<option value="">- Pilih</option>
											<option value="KEPALA KELUARGA">KEPALA KELUARGA</option>
											<option value="ISTRI">ISTRI</option>
											<option value="ANAK">ANAK</option>
											<option value="CUCU">CUCU</option>
											<option value="ORANG TUA">ORANG TUA</option>
											<option value="MERTUA">MERTUA</option>
											<option value="MENANTU">MENANTU</option>
											<option value="FAMILI LAIN">FAMILI LAIN</option>
											<option value="LAINNYA">LAIN-NYA</option>

										</select>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="agama" class="mb-2 col-3 pt-2 pb-2 me-4">Agama</label>

										<select id="agama" class="form-control bg-light" name="agama" required>
											<option value="">- Pilih Agama</option>
											<option value="ISLAM">ISLAM</option>
											<option value="KRISTEN">KRISTEN</option>
											<option value="KATHOLIK">KATHOLIK</option>
											<option value="HINDU">HINDU</option>
											<option value="BUDHA">BUDHA</option>
											<option value="KHONGHUCU">KHONGHUCU</option>
											<option value="KEPERCAYA AN">KEPERCAYA AN</option>

										</select>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="pekerjaan" class="mb-2 col-3 pt-2 pb-2 me-4">Pekerjaan</label>

										<input name="pekerjaan" id="pekerjaan"  class="form-control bg-light" type="text" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="pendidikan" class="mb-2 col-3 pt-2 pb-2 me-4">Pendidikan</label>

										<select id="pendidikan" class="form-control bg-light" name="pendidikan" required>
											<option value="">- Pilih Pendidikan</option>
											<option value="TIDAK/BELUM SEKOLAH">TIDAK/BELUM SEKOLAH</option>
											<option value="BELUM TAMAT SD/SEDERAJAT">BELUM TAMAT SD/SEDERAJAT</option>
											<option value="TAMAT SD/SEDERAJAT">TAMAT SD/SEDERAJAT</option>
											<option value="SLTP/SEDERAJAT">SLTP/SEDERAJAT</option>
											<option value="SLTA/SEDERAJAT">SLTA/SEDERAJAT</option>
											<option value="DIPLOMA I/II">DIPLOMA I/II</option>
											<option value="DIPLOMA III">DIPLOMA III</option>
											<option value="DIPLOMA IV/STRATA I">DIPLOMA IV/STRATA I</option>
											<option value="AKADEMI/DIPLOMA III/SARJANA MUDA">AKADEMI/DIPLOMA III/SARJANA MUDA</option>
											<option value="STRATA-II">STRATA-II</option>
											<option value="STRATA-III">STRATA-III</option>


										</select>

									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nm_ayah" class="mb-2 col-3 pt-2 pb-2 me-4">Nama Ayah</label>

										<input name="nm_ayah" id="nm_ayah"  class="form-control bg-light" type="text">
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nm_ibu" class="mb-2 col-3 pt-2 pb-2 me-4">Nama Ibu</label>

										<input name="nm_ibu" id="nm_ibu"  class="form-control bg-light" type="text">
									</div>
									
								</div>
							</div>

							<input type="submit" name="submit" value="Simpan" class="btn btn-info text-white col-2 ms-3 mt-3">
							
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php require('config/script.php'); ?>