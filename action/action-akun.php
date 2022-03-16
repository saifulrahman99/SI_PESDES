<?php
require_once('../assets/koneksi.php');
require_once('../cek_login.php');
// require('../config/script.php');

//cek apakah sudah login
//jika belum login, akan di lempar ke form login 
if ($sessionStatus==false) {
	header("Location: login.php");
}
// dapatken variable opsi
$opsi = $_GET['opsi'];

if ($opsi == "input") {

	if (isset($_POST['nama'])) {
		$nama=$_POST['nama'];
	}
	else{
		echo "error nama <a href='../registrasi.php'>Kembali</a>"; //status error
	}

	if (isset($_POST['email'])) {
		$email=$_POST['email'];
	}
	else{
		echo "error email <a href='../registrasi.php'>Kembali</a>";
	}

	if (isset($_POST['password'])) {
		$password=$_POST['password'];
	}
	else{
		echo "error password <a href='../registrasi.php'>Kembali</a>";
	}

	if (isset($_POST['repassword'])) {
		$repassword=$_POST['repassword'];
	}
	else{
		echo "error re-password <a href='../registrasi.php'>Kembali</a>";
	}

// pengecekan password dan konfirmasi password
	if ($password != $repassword) {
		echo "password tidak sama, ulangi mengisi pendaftaran <a href='../registrasi.php'>Kembali</a>";
		exit();
	}
	else{
		$password=hash("sha256", $password);
	}

// menyiapkan Query MySQL untuk dieksekusi
	$query = "INSERT INTO akun (nm_petugas,email,password) VALUES ('$nama','$email','$password')";
// mengeksekusi MySQL Query
	$insert = mysqli_query($db, $query);

// menangani ketika error pada saat eksekusi query
	if ($insert == false) {
		echo "Error Dalam Eksekusi Query. <a href='../registrasi.php'>Kembali</a>";
	}else{
		header("Location: ../akun.php");
	}
}

if ($opsi="delete") {
	if (isset($_GET['id_akun'])) {
		$id_akun=$_GET['id_akun'];
	}
	else{
		echo "error id <a href='../registrasi.php'>Kembali</a>"; //status error
	}

	$query = "DELETE FROM akun WHERE id = $id_akun";
	$delete = mysqli_query($db,$query);

	if ($delete == false) {
		echo "Error Dalam Eksekusi Query. <a href='../akun.php'>Kembali</a>";
	}else{
		header("Location: ../akun.php");
	}

}
?>