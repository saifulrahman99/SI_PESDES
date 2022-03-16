<?php
require_once('assets/koneksi.php');
require_once('cek_login.php');

//cek apakah sudah login
//jika belum login, akan di lempar ke form login 
if ($sessionStatus==false) {
	header("Location: login.php");
}

//mendapatkan data nik
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
else {
	echo "NIK tidak ditemukan! <a href='data-penduduk.php'>Kembali</a>";
	exit();
}

$query = "SELECT * FROM tb_penduduk WHERE id = '$id'";
$result = mysqli_query($db,$query);

foreach($result as $penduduk){
	$nik = $penduduk['nik'];
	$no_kk = $penduduk['no_kk'];
	$pendidikan = $penduduk['pendidikan'];
	$shdk = $penduduk['shdk'];
	$nm_ayah = $penduduk['nm_ayah'];
	$nm_ibu = $penduduk['nm_ibu'];
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ubah Data Penduduk</title>
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
					<h4>Ubah Data Penduduk</h4>
					<div class="wrap shadow-sm p-3 mt-3">

						<form action="action/action-penduduk.php?opsi=edit" method="POST">
							<div class="row ps-3">
								<!-- kiri -->
								<div class="col-5 me-5">
									<input name="id" id="id"  class="form-control bg-light" type="number" value="<?php echo $id;?>" hidden required>

									<div class="form-group mb-1 d-flex align-items-center py-1">
										<label for="no_kk" class="col-3">Nomor KK</label>

										<input name="no_kk" id="no_kk"  class="form-control bg-light" type="number" value="<?php echo $no_kk;?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center py-1">
										<label for="nama" class="col-3">Nama</label>

										<input name="nama" id="nama"  class="form-control bg-light" type="text" value="<?php echo $nama;?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center py-1">
										<label for="nik" class="col-3">NIK</label>

										<input name="nik" id="nik"  class="form-control bg-light" type="number" value="<?php echo $nik;?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center py-1">
										<label for="dusun" class="col-3">Dusun</label>

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
											<option value="UTARA" <?php echo $utara?> >UTARA</option>
											<option value="TENGGARA" <?php echo $tenggara?> >TENGGARA</option>
											<option value="SELATAN" <?php echo $selatan?> >SELATAN</option>
										</select>
									</div>

									<div class="form-group mb-1 d-flex align-items-center py-1">
										<label for="rt" class="col-3">RT</label>

										<input name="rt" id="rt"  class="form-control bg-light" type="text" value="<?php echo $rt;?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center py-1">
										<label for="rw" class="col-3">RW</label>

										<input name="rw" id="rw"  class="form-control bg-light" type="text" value="<?php echo $rw;?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center py-1">
										<label for="tmpt_lahir" class="col-3">Tempat Lahir</label>

										<input name="tmpt_lahir" id="tmpt_lahir"  class="form-control bg-light" type="text" value="<?php echo $tmpt_lahir;?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center py-1">
										<label for="tgl_lahir" class="col-3">Tanggal Lahir</label>

										<input name="tgl_lahir" id="tgl_lahir"  class="form-control bg-light" type="date" value="<?php echo $tgl_lahir;?>" required>
									</div>

								</div>

								<!-- kanan -->
								<div class="col-6">

									<div class="form-group mb-1 d-flex align-items-center py-1">
										<label for="jk" class="col-3 me-4">Jenis Kelamin</label>
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
											<input type="radio" class="form-check-input" value="L" id="laki-laki" name="jk" <?php echo $jk_L;?> required>
											<label for="laki-laki" class="form-check-label me-4">Laki-Laki</label>
										</div>
										<div class="form-check disabled">
											<input type="radio" class="form-check-input" value="P" id="perempuan" name="jk" <?php echo $jk_P;?> required>
											<label for="perempuan" class="form-check-label">Perempuan</label>
										</div>
									</div>

									<div class="form-group mb-1 d-flex align-items-center" py-1>

										<label for="shdk" class="col-3 me-4">SHDK</label>

										<select id="shdk" class="form-control bg-light" name="shdk" required>
											<?php
											if ($shdk == "KEPALA KELUARGA") {
												$keplaKeluarga = "selected";
												$istri = "";
												$anak = "";
												$cucu = "";
												$orangTua = "";
												$mertua = "";
												$menantu = "";
												$familiLain = "";
												$lainnya = "";
											}elseif ($shdk == "ISTRI") {
												$keplaKeluarga = "";
												$istri = "selected";
												$anak = "";
												$cucu = "";
												$orangTua = "";
												$mertua = "";
												$menantu = "";
												$familiLain = "";
												$lainnya = "";
											}elseif ($shdk == "ANAK") {
												$keplaKeluarga = "";
												$istri = "";
												$anak = "selected";
												$cucu = "";
												$orangTua = "";
												$mertua = "";
												$menantu = "";
												$familiLain = "";
												$lainnya = "";
											}elseif ($shdk == "CUCU") {
												$keplaKeluarga = "";
												$istri = "";
												$anak = "";
												$cucu = "selected";
												$orangTua = "";
												$mertua = "";
												$menantu = "";
												$familiLain = "";
												$lainnya = "";
											}elseif ($shdk == "ORANG TUA") {
												$keplaKeluarga = "";
												$istri = "";
												$anak = "";
												$cucu = "";
												$orangTua = "selected";
												$mertua = "";
												$menantu = "";
												$familiLain = "";
												$lainnya = "";
											}elseif ($shdk == "MERTUA") {
												$keplaKeluarga = "";
												$istri = "";
												$anak = "";
												$cucu = "";
												$orangTua = "";
												$mertua = "selected";
												$menantu = "";
												$familiLain = "";
												$lainnya = "";
											}elseif ($shdk == "MENANTU") {
												$keplaKeluarga = "";
												$istri = "";
												$anak = "";
												$cucu = "";
												$orangTua = "";
												$mertua = "";
												$menantu = "selected";
												$familiLain = "";
												$lainnya = "";
											}elseif ($shdk == "FAMILI LAIN") {
												$keplaKeluarga = "";
												$istri = "";
												$anak = "";
												$cucu = "";
												$orangTua = "";
												$mertua = "";
												$menantu = "";
												$familiLain = "selected";
												$lainnya = "";
											}elseif ($shdk == "LAINNYA") {
												$keplaKeluarga = "";
												$istri = "";
												$anak = "";
												$cucu = "";
												$orangTua = "";
												$mertua = "";
												$menantu = "";
												$familiLain = "";
												$lainnya = "selected";
											}
											?>
											<option value="KEPALA KELUARGA" <?php echo $keplaKeluarga?> >KEPALA KELUARGA</option>
											<option value="ISTRI" <?php echo $istri?> >ISTRI</option>
											<option value="ANAK" <?php echo $anak?> >ANAK</option>
											<option value="CUCU" <?php echo $cucu?> >CUCU</option>
											<option value="ORANG TUA" <?php echo $orangTua?> >ORANG TUA</option>
											<option value="MERTUA" <?php echo $mertua?> >MERTUA</option>
											<option value="MENANTU" <?php echo $menantu?> >MENANTU</option>
											<option value="FAMILI LAIN" <?php echo $familiLain?> >FAMILI LAIN</option>
											<option value="LAINNYA" <?php echo $lainnya?> >LAIN-NYA</option>
										</select>
									</div>

									<div class="form-group mb-1 d-flex align-items-center py-1">
										<label for="agama" class="col-3 me-4">Agama</label>

										<select id="agama" class="form-control bg-light" name="agama" required>
											<?php
											if ($agama == "ISLAM") {
												$islam = "selected";
												$kristen = "";
												$katholik = "";
												$hindu = "";
												$budha = "";
												$khonghucu = "";
												$kepercayaan = "";
											}elseif ($agama == "KRISTEN") {
												$islam = "";
												$kristen = "selected";
												$katholik = "";
												$hindu = "";
												$budha = "";
												$khonghucu = "";
												$kepercayaan = "";
											}elseif ($agama == "KATHOLIK") {
												$islam = "";
												$kristen = "";
												$katholik = "selected";
												$hindu = "";
												$budha = "";
												$khonghucu = "";
												$kepercayaan = "";
											}elseif ($agama == "HINDU") {
												$islam = "";
												$kristen = "";
												$katholik = "";
												$hindu = "selected";
												$budha = "";
												$khonghucu = "";
												$kepercayaan = "";
											}elseif ($agama == "BUDHA") {
												$islam = "";
												$kristen = "";
												$katholik = "";
												$hindu = "";
												$budha = "selected";
												$khonghucu = "";
												$kepercayaan = "";
											}elseif ($agama == "KHONGHUCU") {
												$islam = "";
												$kristen = "";
												$katholik = "";
												$hindu = "";
												$budha = "";
												$khonghucu = "selected";
												$kepercayaan = "";
											}elseif ($agama == "KEPERCAYA AN") {
												$islam = "";
												$kristen = "";
												$katholik = "";
												$hindu = "";
												$budha = "";
												$khonghucu = "";
												$kepercayaan = "selected";
											}
											?>
											<option value="ISLAM" <?php echo $islam?> >ISLAM</option>
											<option value="KRISTEN" <?php echo $kristen?> >KRISTEN</option>
											<option value="KATHOLIK" <?php echo $katholik?> >KATHOLIK</option>
											<option value="HINDU" <?php echo $hindu?> >HINDU</option>
											<option value="BUDHA" <?php echo $budha?> >BUDHA</option>
											<option value="KHONGHUCU" <?php echo $khonghucu?> >KHONGHUCU</option>
											<option value="KEPERCAYA AN" <?php echo $kepercayaan?> >KEPERCAYA AN</option>

										</select>
									</div>

									<div class="form-group mb-1 d-flex align-items-center py-1">
										<label for="pekerjaan" class="col-3 me-4">Pekerjaan</label>

										<input name="pekerjaan" id="pekerjaan"  class="form-control bg-light" type="text" value="<?php echo $pekerjaan;?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center py-1">
										<label for="pendidikan" class="col-3 me-4">Pendidikan</label>

										<select id="pendidikan" class="form-control bg-light" name="pendidikan" required>
											<?php
											if ($pendidikan == "TIDAK/BELUM SEKOLAH") {
												$sekolah1 = "selected";
												$sekolah2 = "";
												$sekolah3 = "";
												$sekolah4 = "";
												$sekolah5 = "";
												$sekolah6 = "";
												$sekolah7 = "";
												$sekolah8 = "";
												$sekolah9 = "";
												$sekolah10 = "";
												$sekolah11 = "";
											}elseif ($pendidikan == "BELUM TAMAT SD/SEDERAJAT") {
												$sekolah1 = "";
												$sekolah2 = "selected";
												$sekolah3 = "";
												$sekolah4 = "";
												$sekolah5 = "";
												$sekolah6 = "";
												$sekolah7 = "";
												$sekolah8 = "";
												$sekolah9 = "";
												$sekolah10 = "";
												$sekolah11 = "";
											}elseif ($pendidikan == "TAMAT SD/SEDERAJAT") {
												$sekolah1 = "";
												$sekolah2 = "";
												$sekolah3 = "selected";
												$sekolah4 = "";
												$sekolah5 = "";
												$sekolah6 = "";
												$sekolah7 = "";
												$sekolah8 = "";
												$sekolah9 = "";
												$sekolah10 = "";
												$sekolah11 = "";
											}elseif ($pendidikan == "SLTP/SEDERAJAT") {
												$sekolah1 = "";
												$sekolah2 = "";
												$sekolah3 = "";
												$sekolah4 = "selected";
												$sekolah5 = "";
												$sekolah6 = "";
												$sekolah7 = "";
												$sekolah8 = "";
												$sekolah9 = "";
												$sekolah10 = "";
												$sekolah11 = "";
											}elseif ($pendidikan == "SLTA/SEDERAJAT") {
												$sekolah1 = "";
												$sekolah2 = "";
												$sekolah3 = "";
												$sekolah4 = "";
												$sekolah5 = "selected";
												$sekolah6 = "";
												$sekolah7 = "";
												$sekolah8 = "";
												$sekolah9 = "";
												$sekolah10 = "";
												$sekolah11 = "";
											}elseif ($pendidikan == "DIPLOMA I/II") {
												$sekolah1 = "";
												$sekolah2 = "";
												$sekolah3 = "";
												$sekolah4 = "";
												$sekolah5 = "";
												$sekolah6 = "selected";
												$sekolah7 = "";
												$sekolah8 = "";
												$sekolah9 = "";
												$sekolah10 = "";
												$sekolah11 = "";
											}elseif ($pendidikan == "DIPLOMA III") {
												$sekolah1 = "";
												$sekolah2 = "";
												$sekolah3 = "";
												$sekolah4 = "";
												$sekolah5 = "";
												$sekolah6 = "";
												$sekolah7 = "selected";
												$sekolah8 = "";
												$sekolah9 = "";
												$sekolah10 = "";
												$sekolah11 = "";
											}elseif ($pendidikan == "DIPLOMA IV/STRATA I") {
												$sekolah1 = "";
												$sekolah2 = "";
												$sekolah3 = "";
												$sekolah4 = "";
												$sekolah5 = "";
												$sekolah6 = "";
												$sekolah7 = "";
												$sekolah8 = "selected";
												$sekolah9 = "";
												$sekolah10 = "";
												$sekolah11 = "";
											}elseif ($pendidikan == "AKADEMI/DIPLOMA III/SARJANA MUDA") {
												$sekolah1 = "";
												$sekolah2 = "";
												$sekolah3 = "";
												$sekolah4 = "";
												$sekolah5 = "";
												$sekolah6 = "";
												$sekolah7 = "";
												$sekolah8 = "";
												$sekolah9 = "selected";
												$sekolah10 = "";
												$sekolah11 = "";
											}elseif ($pendidikan == "STRATA-II") {
												$sekolah1 = "";
												$sekolah2 = "";
												$sekolah3 = "";
												$sekolah4 = "";
												$sekolah5 = "";
												$sekolah6 = "";
												$sekolah7 = "";
												$sekolah8 = "";
												$sekolah9 = "";
												$sekolah10 = "selected";
												$sekolah11 = "";
											}elseif ($pendidikan == "STRATA-III") {
												$sekolah1 = "";
												$sekolah2 = "";
												$sekolah3 = "";
												$sekolah4 = "";
												$sekolah5 = "";
												$sekolah6 = "";
												$sekolah7 = "";
												$sekolah8 = "";
												$sekolah9 = "";
												$sekolah10 = "";
												$sekolah11 = "selected";
											}
											?>
											
											<option value="TIDAK/BELUM SEKOLAH" <?php echo $sekolah1?> >TIDAK/BELUM SEKOLAH</option>
											<option value="BELUM TAMAT SD/SEDERAJAT" <?php echo $sekolah2?> >BELUM TAMAT SD/SEDERAJAT</option>
											<option value="TAMAT SD/SEDERAJAT" <?php echo $sekolah3?> >TAMAT SD/SEDERAJAT</option>
											<option value="SLTP/SEDERAJAT" <?php echo $sekolah4?> >SLTP/SEDERAJAT</option>
											<option value="SLTA/SEDERAJAT" <?php echo $sekolah5?> >SLTA/SEDERAJAT</option>
											<option value="DIPLOMA I/II" <?php echo $sekolah6?> >DIPLOMA I/II</option>
											<option value="DIPLOMA III" <?php echo $sekolah7?> >DIPLOMA III</option>
											<option value="DIPLOMA IV/STRATA I" <?php echo $sekolah8?> >DIPLOMA IV/STRATA I</option>
											<option value="AKADEMI/DIPLOMA III/SARJANA MUDA" <?php echo $sekolah9?> >AKADEMI/DIPLOMA III/SARJANA MUDA</option>

											<option value="STRATA-II" <?php echo $sekolah10?> >STRATA-II</option>
											<option value="STRATA-III" <?php echo $sekolah11?> >STRATA-III</option>

										</select>

									</div>
									<div class="form-group mb-1 d-flex align-items-center py-1">
										<label for="nm_ayah" class="col-3 me-4">Nama Ayah</label>

										<input name="nm_ayah" id="nm_ayah"  class="form-control bg-light" type="text" value="<?php echo $nm_ayah;?>">
									</div>

									<div class="form-group mb-1 d-flex align-items-center py-1">
										<label for="nm_ibu" class="col-3 me-4">Nama Ibu</label>

										<input name="nm_ibu" id="nm_ibu"  class="form-control bg-light" type="text" value="<?php echo $nm_ibu;?>">
									</div>
									
								</div>
							</div>

							<input type="submit" name="submit" value="Ubah" class="btn btn-info text-white col-2 ms-3 mt-3">
							<a href="data-penduduk.php" class="btn btn-info ms-3 mt-3 text-white px-5 py-1">Kembali</a>
						</form>


					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php require('config/script.php'); ?>