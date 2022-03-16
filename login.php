<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Login</title>
	<?php 
	require('config/script.php'); 
	require('config/style.php'); 
	?>
</head>
<body>
	<div id="login" class="d-flex flex-column justify-content-center align-items-center">

		<div id="logo" class="text-center">
			<img src="assets/img/logo/logo.png" alt="">
			<h5 class="mt-1 mb-3 fw-bolder">SI PESDES BANTAL</h5>
		</div>

		<div class="box bg-white shadow-sm rounded p-4 px-5">
			<form action="action/action-login.php" method="POST">

				<div class="from-group mb-2 row">
					<div class="col-3 d-flex align-items-center"><label for="nama">Email</label></div>
					<div class="col-9"><input name="email" id="email" type="email" class="form-control bg-light" placeholder="Masukkan Email Anda" required></div>
				</div>

				<div class="from-group mb-2 row">
					<div class="col-3 d-flex align-items-center"><label for="nama">Password</label></div>
					<div class="col-9"><input name="password" id="password" type="password" class="form-control bg-light" placeholder="Masukkan Password Anda" required></div>
				</div>

				<div class="d-flex justify-content-center">
					<input name="submit" type="submit" value="Login" class="col-4 btn btn-info text-white mt-2">
				</div>
			</form>
		</div>
	</div>
</body>
</html>