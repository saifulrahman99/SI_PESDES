<?php
// kalau pakai offline
$db = new mysqli("localhost","root","","suratdesa");

// kalau online
// $db = new mysqli("localhost","id18576301_db_suratdesa","@D{o~RSM*QfC7HpB","id18576301_suratdesa");

// cek koneksi
if ($db->connect_error) {
	echo "Gagal menyambungkan ke MySQL : ".$db->connect_error;
	exit();
}
?>