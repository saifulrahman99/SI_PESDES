<?php
require_once('../assets/koneksi.php');
require_once('../cek_login.php');

if ($sessionStatus==false) {
	header("Location: login.php");
}

if (isset($_POST['nik'])) {
	$nik = $_POST['nik'];
}
else {
	$nik = $_POST['nik'];
} //status error

header("Location: ../kepala-desa.php?nik_cari=$nik");
?>