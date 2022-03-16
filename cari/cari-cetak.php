<?php
require_once('../assets/koneksi.php');
require_once('../cek_login.php');

if ($sessionStatus==false) {
	header("Location: login.php");
}

$jenis = $_GET['jenis'];

// SKKB/SKCK
if ($jenis == "skkb") {

	if (isset($_POST['nik'])) {
		$nik = $_POST['nik'];
	}
	else {
		echo "Error dari nik";
		exit();
	} //status error

	header("Location: ../form-skkb.php?nik_cari=$nik");
}

// SKU
if ($jenis == "sku") {

	if (isset($_POST['nik'])) {
		$nik = $_POST['nik'];
	}
	else {
		echo "Error dari nik";
		exit();
	} //status error

	header("Location: ../form-sku.php?nik_cari=$nik");
}

// Lokasi tanah
if ($jenis == "lokasi-tanah") {

	if (isset($_POST['nik'])) {
		$nik = $_POST['nik'];
	}
	else {
		echo "Error dari nik";
		exit();
	} //status error

	header("Location: ../form-lokasi-tanah.php?nik_cari=$nik");
}

// SKTM
if ($jenis == "sktm") {

	if (isset($_POST['nik'])) {
		$nik = $_POST['nik'];
	}
	else {
		echo "Error dari nik";
		exit();
	} //status error

	header("Location: ../form-sktm.php?nik_cari=$nik");
}

// Ket Jalan atau bepergian
if ($jenis == "jalan") {

	if (isset($_POST['nik'])) {
		$nik = $_POST['nik'];
	}
	else {
		echo "Error dari nik";
		exit();
	} //status error

	header("Location: ../form-jalan.php?nik_cari=$nik");
}


// Kepemilikan tanah
if ($jenis == "kepemilikan") {

	if (isset($_POST['nik'])) {
		$nik = $_POST['nik'];
	}
	else {
		echo "Error dari nik";
		exit();
	} //status error

	header("Location: ../form-kepemilikan-tanah.php?nik_cari=$nik");
}

// Kehilangan
if ($jenis == "kehilangan") {

	if (isset($_POST['nik'])) {
		$nik = $_POST['nik'];
	}
	else {
		echo "Error dari nik";
		exit();
	} //status error

	header("Location: ../form-kehilangan.php?nik_cari=$nik");
}

// harga tanah
if ($jenis == "harga-tanah") {

	if (isset($_POST['nik'])) {
		$nik = $_POST['nik'];
	}
	else {
		echo "Error dari nik";
		exit();
	} //status error

	header("Location: ../form-harga-tanah.php?nik_cari=$nik");
}

// BBM
if ($jenis == "bbm") {

	if (isset($_POST['nik'])) {
		$nik = $_POST['nik'];
	}
	else {
		echo "Error dari nik";
		exit();
	} //status error

	header("Location: ../form-bbm.php?nik_cari=$nik");
}

// Penebangan Kayu
if ($jenis == "kayu") {

	if (isset($_POST['nik'])) {
		$nik = $_POST['nik'];
	}
	else {
		echo "Error dari nik";
		exit();
	} //status error

	if (isset($_POST['nik2'])) {
		$nik2 = $_POST['nik2'];
	}
	else {
		echo "Error dari nik";
		exit();
	} //status error

	header("Location: ../form-penebangan-kayu.php?nik_cari=$nik&nik_cari2=$nik2");
}

// Pindah
if ($jenis == "pindah") {

	if (isset($_POST['nik'])) {
		$nik = $_POST['nik'];
	}
	else {
		echo "Error dari nik";
		exit();
	} //status error

	header("Location: ../form-pindah.php?nik_cari=$nik");
}

// Kematian
if ($jenis == "kematian") {

	if (isset($_POST['nik'])) {
		$nik = $_POST['nik'];
	}
	else {
		echo "Error dari nik";
		exit();
	} //status error

	if (isset($_POST['nik2'])) {
		$nik2 = $_POST['nik2'];
	}
	else {
		echo "Error dari nik2";
		exit();
	} //status error

	header("Location: ../form-kematian.php?nik_cari=$nik&nik_cari2=$nik2");
}

// domisili
if ($jenis == "domisili") {

	if (isset($_POST['nik'])) {
		$nik = $_POST['nik'];
	}
	else {
		echo "Error dari nik";
		exit();
	} //status error

	header("Location: ../form-domisili.php?nik_cari=$nik");
}

// permohonan-kk
if ($jenis == "permohonan-kk") {

	if (isset($_POST['nik'])) {
		$nik = $_POST['nik'];
	}
	else {
		echo "Error dari nik";
		exit();
	} //status error

	header("Location: ../form-permohonan-kk.php?nik_cari=$nik");
}
// beda-nama
if ($jenis == "beda-nama") {

	if (isset($_POST['nik'])) {
		$nik = $_POST['nik'];
	}
	else {
		echo "Error dari nik";
		exit();
	} //status error

	header("Location: ../form-beda-nama.php?nik_cari=$nik");
}

?>