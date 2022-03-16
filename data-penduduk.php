<?php
require_once('assets/koneksi.php');
require_once('cek_login.php');

//cek apakah sudah login
//jika belum login, akan di lempar ke form login 
if ($sessionStatus==false) {
	header("Location: login.php");
}

// untuk paging
$halaman = 25; //batasan halaman
$page = isset($_GET['halaman'])? (int)$_GET["halaman"]:1;
$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;

// filter get nik
if (empty($_GET['search'])) {
	$cari = "ORDER BY rt LIMIT $mulai, $halaman";
	$navPage = "ada";
}
else{
	$result_cari = $_GET['search'];
	$cari = "WHERE nama LIKE '%$result_cari%' OR nik LIKE '%$result_cari%' OR no_kk LIKE '%$result_cari%'";
	$navPage = "";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Data Penduduk</title>
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
				<h4 class="fw-bolder">Database Penduduk</h4>

				<div class="wrap shadow-sm pt-4 pb-2 ps-2 mt-3 mb-4 rounded">
					<form action="cari/cari-penduduk.php" method="POST">
						<div class="form-group mb-3 d-flex align-items-center col-8">
							<label for="formSearch" class="mb-2 col-3">NIK/ Nama/ No KK</label>

							<input name="formSearch" id="formSearch"  class="form-control bg-light me-3" type="text" placeholder="Cari..." style="max-width:250px;">

							<input type="submit" name="submit" value="Temukan" class="btn btn-info text-white col-2">
						</div>

					</form>

				</div>
				<div class="wrap col table-responsive shadow-sm rounded p-3">

					<table class="table table-striped table-bordered responsive-utilities text-center">
						<thead>
							<tr>
								<th scope="col" style="min-width:80px;">Aksi</th>
								<th scope="col">NIK</th>
								<th scope="col" style="min-width:200px;">Nama</th>
								<th scope="col">NO KK</th>
								<th scope="col">Dusun</th>
								<th scope="col">RT</th>
								<th scope="col">RW</th>
								<th scope="col">Tempat Lahir</th>
								<th scope="col" style="min-width:150px;">Tanggal Lahir</th>
								<th scope="col">JK</th>
								<th scope="col" style="min-width:200px;">SHDK</th>
								<th scope="col">Agama</th>
								<th scope="col" style="min-width:200px;">Pendidikan</th>
								<th scope="col" style="min-width:200px;">Pekerjaan</th>
								<th scope="col" style="min-width:200px;">Nama Ayah</th>
								<th scope="col" style="min-width:200px;">Nama Ibu</th>
							</tr>
						</thead>

						<tbody>
							<?php

							$query= "SELECT * FROM tb_penduduk $cari";
							$result=mysqli_query($db, $query);
								// foreach
							$i=1;
							foreach ($result as $penduduk) {
								?>
								<tr>
									<td>
										<a class="card-text text-decoration-none text-info fs-6" href="edit-penduduk.php?id=<?php echo $penduduk['id']?>"><i class="fas fa-edit"></i>
										</a>&nbsp | &nbsp

										<a class="card-text text-decoration-none text-danger fs-6" href="action/action-penduduk.php?id=<?php echo $penduduk['id']?>&opsi=delete" onclick="return confirm_delete()">
											<i class="fa fa-trash-alt"></i>
										</a>

									</td>
									<td><?php echo $penduduk['nik']?></td>
									<td class="text-uppercase"><?php echo $penduduk['nama']?></td>
									<td><?php echo $penduduk['no_kk']?></td>
									<td class="text-uppercase"><?php echo $penduduk['dusun']?></td>
									<td><?php echo $penduduk['rt']?></td>
									<td><?php echo $penduduk['rw']?></td>
									<td class="text-uppercase"><?php echo $penduduk['tmpt_lahir']?></td>
									<td><?php echo $penduduk['tgl_lahir']?></td>
									<td class="text-uppercase"><?php echo $penduduk['jk']?></td>
									<td class="text-uppercase"><?php echo $penduduk['shdk']?></td>
									<td class="text-uppercase"><?php echo $penduduk['agama']?></td>
									<td class="text-uppercase"><?php echo $penduduk['pendidikan']?></td>
									<td class="text-uppercase"><?php echo $penduduk['pekerjaan']?></td>
									<td class="text-uppercase"><?php echo $penduduk['nm_ayah']?></td>
									<td class="text-uppercase"><?php echo $penduduk['nm_ibu']?></td>
								</tr>

							<?php } ?>
						</tbody>
					</table>
				</div>

			</div>

			<!-- footer konten -->
			<div class="layerPage m-3">
				<?php
				$sql = mysqli_query($db,"SELECT * FROM tb_penduduk");
				$total = mysqli_num_rows($sql);
				$pages = ceil($total/$halaman);

				// batas page tampil
				$limitpageshow = $page+3;

				// kondisi disable tombol sebelumnya
				if ($page == 1) {
					$hilangP = 'disabled';
				}else{
					$hilangP = '';
				}

				// kondisi disable tombol selanjutnya
				if ($page == $pages-3) {
					$hilangN = 'disabled';
					$limitpageshow = $page+3;
				}elseif ($page == $pages-2) {
					$hilangN = 'disabled';
					$limitpageshow = $page+2;
				}elseif ($page == $pages-1) {
					$hilangN = 'disabled';
					$limitpageshow = $page+1;
				}elseif($page == $pages){
					$hilangN = 'disabled';
					$limitpageshow = $page;
				}
				else{
					$hilangN = '';
				}

				if ($navPage == "ada") {

				?>
				<nav aria-label="pagging">
					<ul class="pagination">
						<?php if ($page > 1) {?>
							<li class="page-item">
								<a class="page-link" href="?halaman=1"><i class="fa fa-angle-double-left"></i></a>
							</li>
						<?php } ?>

						<li class="page-item <?php echo $hilangP?>">
							<?php $previouspage = $page-1; ?>
							<a class="page-link" href="?halaman=<?php echo $previouspage; ?>" aria-disabled="true"><i class="fa fa-angle-left"></i></a>
						</li>

						<?php
						if ($page == $pages) {
							$limitpageshow = $page;
						}
						// menampilkan pages
						for ($i=$page; $i<=$limitpageshow; $i++){ ?>
							<li class="page-item"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
						<?php } ?>

						<li class="page-item <?php echo $hilangN?>">
							<?php $nextpage = $page+1; ?>
							<a class="page-link" href="?halaman=<?php echo $nextpage; ?>"><i class="fa fa-angle-right"></i></a>
						</li>

						<?php if ($page < $pages) { ?>
							<li class="page-item">
								<a class="page-link" href="?halaman=<?php echo $pages?>"><i class="fa fa-angle-double-right"></i></a>
							</li>
						<?php } ?>

					</ul>
					<p>Page: <?php echo $page?> of <?php echo $pages?></p>
				</nav>
				<?php } ?>

			</div>
		</div>
		<!-- end konten -->
	</div>
</body>
</html>
<?php require('config/script.php'); ?>