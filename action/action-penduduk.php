<?php
require_once('../assets/koneksi.php');
require_once('../cek_login.php');
require('../config/script.php');

//cek apakah sudah login
//jika belum login, akan di lempar ke form login 
if ($sessionStatus==false) {
	header("Location: login.php");
}
// dapatken variable opsi
$opsi = $_GET['opsi'];

// cek jika input
if ($opsi == "input") {

	if (isset($_POST['nik'])) {
		$nik = $_POST['nik'];
	}
	else{
		echo "kesalahan dari nik";
	}

	if (isset($_POST['no_kk'])) {
		$no_kk = $_POST['no_kk'];
	}
	else{
		echo "kesalahan dari no_kk";
	}
// batas
	if (isset($_POST['nama'])) {
		$nama = $_POST['nama'];
	}
	else{
		echo "kesalahan dari nama";
	}
// batas
	if (isset($_POST['nik'])) {
		$nik = $_POST['nik'];
	}
	else{
		echo "kesalahan dari nik";
	}
// batas
	if (isset($_POST['dusun'])) {
		$dusun = $_POST['dusun'];
	}
	else{
		echo "kesalahan dari dusun";
	}
// batas
	if (isset($_POST['rt'])) {
		$rt = $_POST['rt'];
	}
	else{
		echo "kesalahan dari rt";
	}
// batas
	if (isset($_POST['rw'])) {
		$rw = $_POST['rw'];
	}
	else{
		echo "kesalahan dari rw";
	}
// batas
	if (isset($_POST['tmpt_lahir'])) {
		$tmpt_lahir = $_POST['tmpt_lahir'];
	}
	else{
		echo "kesalahan dari tmpt_lahir";
	}
// batas
	if (isset($_POST['tgl_lahir'])) {
		$tgl_lahir = $_POST['tgl_lahir'];
	}
	else{
		echo "kesalahan dari tgl_lahir";
	}
// batas
	if (isset($_POST['jk'])) {
		$jk = $_POST['jk'];
	}
	else{
		echo "kesalahan dari jk";
	}
// batas
	if (isset($_POST['shdk'])) {
		$shdk = $_POST['shdk'];
	}
	else{
		echo "kesalahan dari shdk";
	}
// batas
	if (isset($_POST['agama'])) {
		$agama = $_POST['agama'];
	}
	else{
		echo "kesalahan dari agama";
	}
// batas
	if (isset($_POST['pekerjaan'])) {
		$pekerjaan = $_POST['pekerjaan'];
	}
	else{
		echo "kesalahan dari pekerjaan";
	}
// batas
	if (isset($_POST['pendidikan'])) {
		$pendidikan = $_POST['pendidikan'];
	}
	else{
		echo "kesalahan dari pendidikan";
	}
// batas
	if (isset($_POST['nm_ayah'])) {
		$nm_ayah = $_POST['nm_ayah'];
	}
	else{
		echo "kesalahan dari nm_ayah";
	}
// batas
	if (isset($_POST['nm_ibu'])) {
		$nm_ibu = $_POST['nm_ibu'];
	}
	else{
		echo "kesalahan dari nm_ibu";
	}
// batas

	$query = "INSERT INTO tb_penduduk(no_kk, nama, nik, dusun, rt, rw, tmpt_lahir, tgl_lahir, jk, shdk, agama, pendidikan, pekerjaan, nm_ayah, nm_ibu) VALUES ('$no_kk','$nama','$nik','$dusun','$rt','$rw','$tmpt_lahir','$tgl_lahir','$jk','$shdk','$agama','$pendidikan','$pekerjaan','$nm_ayah','$nm_ibu')";

	$insert = mysqli_query($db,$query);

	if ($insert == false) {
		?>
		<script type='text/javascript'>
			alert('Gagal Menambah Data');
			window.location.href="../form-penduduk.php";
		</script>
		<?php
	}
	else{
		?>
		<script type='text/javascript'>
			alert('Sukses Menambah Data');
			window.location.href="../form-penduduk.php";
		</script>
		<?php
	}

}


// cek jika edit
if ($opsi == "edit") {

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	}
	else{
		echo "kesalahan dari nik";
	}
	// batas
	if (isset($_POST['nik'])) {
		$nik = $_POST['nik'];
	}
	else{
		echo "kesalahan dari nik";
	}
	// batas
	if (isset($_POST['no_kk'])) {
		$no_kk = $_POST['no_kk'];
	}
	else{
		echo "kesalahan dari no_kk";
	}
// batas
	if (isset($_POST['nama'])) {
		$nama = $_POST['nama'];
	}
	else{
		echo "kesalahan dari nama";
	}
// batas
	if (isset($_POST['nik'])) {
		$nik = $_POST['nik'];
	}
	else{
		echo "kesalahan dari nik";
	}
// batas
	if (isset($_POST['dusun'])) {
		$dusun = $_POST['dusun'];
	}
	else{
		echo "kesalahan dari dusun";
	}
// batas
	if (isset($_POST['rt'])) {
		$rt = $_POST['rt'];
	}
	else{
		echo "kesalahan dari rt";
	}
// batas
	if (isset($_POST['rw'])) {
		$rw = $_POST['rw'];
	}
	else{
		echo "kesalahan dari rw";
	}
// batas
	if (isset($_POST['tmpt_lahir'])) {
		$tmpt_lahir = $_POST['tmpt_lahir'];
	}
	else{
		echo "kesalahan dari tmpt_lahir";
	}
// batas
	if (isset($_POST['tgl_lahir'])) {
		$tgl_lahir = $_POST['tgl_lahir'];
	}
	else{
		echo "kesalahan dari tgl_lahir";
	}
// batas
	if (isset($_POST['jk'])) {
		$jk = $_POST['jk'];
	}
	else{
		echo "kesalahan dari jk";
	}
// batas
	if (isset($_POST['shdk'])) {
		$shdk = $_POST['shdk'];
	}
	else{
		echo "kesalahan dari shdk";
	}
// batas
	if (isset($_POST['agama'])) {
		$agama = $_POST['agama'];
	}
	else{
		echo "kesalahan dari agama";
	}
// batas
	if (isset($_POST['pekerjaan'])) {
		$pekerjaan = $_POST['pekerjaan'];
	}
	else{
		echo "kesalahan dari pekerjaan";
	}
// batas
	if (isset($_POST['pendidikan'])) {
		$pendidikan = $_POST['pendidikan'];
	}
	else{
		echo "kesalahan dari pendidikan";
	}
// batas
	if (isset($_POST['nm_ayah'])) {
		$nm_ayah = $_POST['nm_ayah'];
	}
	else{
		echo "kesalahan dari nm_ayah";
	}
// batas
	if (isset($_POST['nm_ibu'])) {
		$nm_ibu = $_POST['nm_ibu'];
	}
	else{
		echo "kesalahan dari nm_ibu";
	}
// batas

	$query = "UPDATE tb_penduduk SET 
	no_kk='$no_kk',
	nama='$nama',
	nik='$nik',
	dusun='$dusun',
	rt='$rt',
	rw='$rw',
	tmpt_lahir='$tmpt_lahir',
	tgl_lahir='$tgl_lahir',
	jk='$jk',
	shdk='$shdk',
	agama='$agama',
	pendidikan='$pendidikan',
	pekerjaan='$pekerjaan',
	nm_ayah='$nm_ayah',
	nm_ibu='$nm_ibu' WHERE id = '$id'";

	$update = mysqli_query($db,$query);
	
	if ($update == false) {
		?>
		<script type='text/javascript'>
			alert('Gagal Mengubah Data');
			window.location.href="../edit-penduduk.php";
		</script>
		<?php
	}
	else{
		?>
		<script type='text/javascript'>
			alert('Sukses Mengubah Data');
			window.location.href="../data-penduduk.php";
		</script>
		<?php
	}	


}

// cek jika delete
if ($opsi == "delete") {
	// batas
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	else{
		echo "kesalahan dari id";
	}
	$query = "DELETE FROM tb_penduduk WHERE id = $id";
	$delete = mysqli_query($db,$query);

	if ($delete == false) {
		?>
		<script type='text/javascript'>
			alert('Gagal Menghapus Data');
			window.location.href="../data-penduduk.php";
		</script>
		<?php
	}
	else{
		?>
		<script type='text/javascript'>
			alert('Sukses Menghapus Data');
			window.location.href="../data-penduduk.php";
		</script>
		<?php
	}
}

?>