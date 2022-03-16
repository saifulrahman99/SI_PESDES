<?php
require_once('../assets/koneksi.php');
require_once('../cek_login.php');

if ($sessionStatus==false) {
	header("Location: login.php");
}

if (isset($_POST['formSearch'])) {
	$formSearch = $_POST['formSearch'];
}
else {
	$formSearch = $_POST['formSearch'];
} //status error

header("Location: ../data-penduduk.php?search=$formSearch");
?>