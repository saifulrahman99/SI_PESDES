<?php
require_once('../assets/koneksi.php');
require_once('../cek_login.php');
// require('../config/script.php');

//cek apakah sudah login
//jika belum login, akan di lempar ke form login 
if ($sessionStatus==false) {
	header("Location: login.php");
}

if (isset($_POST['nama'])) {
	$nama=$_POST['nama'];
}
else{
	echo "error nama <a href='../kepala-desa.php'>Kembali</a>"; //status error
}

if (isset($_POST['nik'])) {
	$nik=$_POST['nik'];
}
else{
	echo "error nik <a href='../kepala-desa.php'>Kembali</a>";
}

$panggil = "SELECT * FROM tb_kepdes";
$result = mysqli_query($db,$panggil);

$jmlh_data = mysqli_num_rows($result);

if ($jmlh_data == 0) {
	$query = "INSERT INTO tb_kepdes (nik,nama) VALUES ('$nik','$nama')";
	$insert = mysqli_query($db,$query);

	if ($insert == false) {
		?>
		<script type='text/javascript'>
			alert('Gagal Menambah Data');
			window.location.href="../kepala-desa.php";
		</script>
		<?php
	}
	else{
		?>
		<script type='text/javascript'>
			alert('Sukses Menambah Data');
			window.location.href="../kepala-desa.php";
		</script>
		<?php
	}	

}else{

	$query = "UPDATE tb_kepdes SET nik = '$nik', nama = '$nama'";
	$update = mysqli_query($db,$query);

	if ($update == false) {
		?>
		<script type='text/javascript'>
			alert('Gagal Mengubah Data');
			window.location.href="../kepala-desa.php";
		</script>
		<?php
	}
	else{
		?>
		<script type='text/javascript'>
			alert('Sukses Mengubah Data');
			window.location.href="../kepala-desa.php";
		</script>
		<?php
	}	
}
?>