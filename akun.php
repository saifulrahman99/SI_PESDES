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
	<title>Akun Admin</title>
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
					<h4>Akun Admin</h4>

					<div class="wrap col table-responsive shadow-sm rounded p-3">
						<a href="registrasi.php" class="btn btn-info text-white mb-3">Buat Akun</a>
						<table class="table table-striped table-bordered responsive-utilities text-center">
							<thead>
								<tr>
									<th scope="col" style="min-width:200px;">Nama</th>
									<th scope="col" style="min-width:150px;">email</th>
									<th scope="col" style="min-width:150px;">Password</th>
									<th scope="col" style="min-width:80px;">Aksi</th>
								</tr>
							</thead>

							<tbody>
								<?php

								$query= "SELECT * FROM akun";
								$result=mysqli_query($db, $query);
								// foreach
								$i=1;
								foreach ($result as $akun) {
									?>
									<tr>
										<td class="text-uppercase"><?php echo $akun['nm_petugas']?></td>
										<td><?php echo $akun['email']?></td>
										<td><?php echo $akun['password']?></td>
										<td>
											<a class="card-text text-decoration-none text-danger fs-6" href="action/action-akun.php?id_akun=<?php echo $akun['id']?>&opsi=delete" onclick="return confirm_delete()">
												<i class="fa fa-trash-alt"></i>
											</a>

										</td>
									</tr>

								<?php } ?>
							</tbody>
						</table>
					</div>

				</div>

				
			</div>
		</div>
		<!-- end konten -->
	</div>
</body>
</html>
<?php require('config/script.php'); ?>