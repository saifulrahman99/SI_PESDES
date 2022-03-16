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
	<title>Halaman Registrasi Akun</title>
	<?php require('config/style.php'); ?>
</head>
<body>
	<div id="registrasi" class="d-flex flex-column justify-content-center align-items-center">

		<div id="logo" class="text-center">
			<img src="assets/img/logo/logo.png" alt="">
			<h5 class="mt-2 fw-bolder">SI PESDES BANTAL</h5>
		</div>

		<div class="box bg-white shadow-sm rounded p-4 px-5">
			<form action="action/action-akun.php?opsi=input" method="POST">

				<div class="from-group mb-2 row">
					<div class="col-3 d-flex align-items-center"><label for="nama">Nama</label></div>
					<div class="col-9"><input name="nama" id="nama" type="text" class="form-control bg-light" placeholder="Masukkan Nama Anda" required></div>
				</div>

				<div class="from-group mb-2 row">
					<div class="col-3 d-flex align-items-center"><label for="nama">Email</label></div>
					<div class="col-9"><input name="email" id="email" type="email" class="form-control bg-light" placeholder="Masukkan Email Anda" required></div>
				</div>

				<div class="from-group mb-2 row">
					<div class="col-3 d-flex align-items-center"><label for="nama">Password</label></div>
					<div class="col-9"><input name="password" id="password" type="password" class="form-control bg-light" placeholder="Masukkan Password Anda" required></div>
				</div>

				<div class="from-group mb-2 row">
					<div class="col-3 d-flex align-items-center"><label for="nama">Konfirmasi Password</label></div>
					<div class="col-9"><input name="repassword" id="repassword" type="password" class="form-control bg-light" placeholder="Masukkan Ulang Password Anda" required></div>
				</div>

				<div class="d-flex justify-content-center">
					<input name="submit" type="submit" value="Registrasi" class="col-6 btn btn-info text-white mt-2">
				</div>
			</form>

			<div class="opsi-login mt-4 text-center">
				<p class="mb-0">---  jika sudah memiliki akun silahkan login ---</p>
				<a href="login.php" class="text-decoration-none">Login</a>
			</div>
		</div>
		
	</div>
</body>
</html>
<?php require('config/script.php'); ?>