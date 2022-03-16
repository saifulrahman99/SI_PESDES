<?php
require_once('../assets/koneksi.php');
require_once('../cek_login.php');

if ($sessionStatus==false) {
	header("Location: login.php");
}

if (isset($_POST['no_surat'])) {
	$no_surat = $_POST['no_surat'];
}
else{
	echo "kesalahan dari no_surat";
}
// batas
if (isset($_POST['nama'])) {
	$nama = $_POST['nama'];
}
else{
	echo "kesalahan dari nama ";
}
// batas
if (isset($_POST['nama2'])) {
	$nama2 = $_POST['nama2'];
}
else{
	echo "kesalahan dari nama2 ";
}
// batas
if (isset($_POST['nama3'])) {
	$nama3 = $_POST['nama3'];
}
else{
	echo "kesalahan dari nama3 ";
}
// batas
if (isset($_POST['alamat'])) {
	$alamat = $_POST['alamat'];
}
else{
	echo "kesalahan dari alamat ";
}
// batas
if (isset($_POST['alamat2'])) {
	$alamat2 = $_POST['alamat2'];
}
else{
	echo "kesalahan dari alamat2 ";
}
// batas
if (isset($_POST['alamat3'])) {
	$alamat3 = $_POST['alamat3'];
}
else{
	echo "kesalahan dari alamat3 ";
}
// batas
if (isset($_POST['pekerjaan'])) {
	$pekerjaan = $_POST['pekerjaan'];
}
else{
	echo "kesalahan dari pekerjaan ";
}
// batas
if (isset($_POST['pekerjaan2'])) {
	$pekerjaan2 = $_POST['pekerjaan2'];
}
else{
	echo "kesalahan dari pekerjaan2 ";
}
// batas
if (isset($_POST['no_sppt'])) {
	$no_sppt = $_POST['no_sppt'];
}
else{
	echo "kesalahan dari no_sppt ";
}
// batas
if (isset($_POST['j_kayu'])) {
	$j_kayu = $_POST['j_kayu'];
}
else{
	echo "kesalahan dari j_kayu ";
}
// batas
if (isset($_POST['jml_kayu'])) {
	$jml_kayu = $_POST['jml_kayu'];
}
else{
	echo "kesalahan dari jml_kayu ";
}
// batas
if (isset($_POST['pemakaian'])) {
	$pemakaian = $_POST['pemakaian'];
}
else{
	echo "kesalahan dari pemakaian ";
}

// include fungsi ubah tanggal
require('../library/ubah_tanggal.php');

require('../library/terbilang.php');

$nama_up = strtoupper($nama);
$nama_up2 = strtoupper($nama2);
$nama_up3 = strtoupper($nama3);

// menghapus data jika lebih dari 3
$data_surat = mysqli_query($db,"SELECT * FROM tb_surat");
$jumlah_surat = mysqli_num_rows($data_surat);
$surat = mysqli_fetch_assoc($data_surat);

if ($pemakaian == "sendiri") {
	$pakai = "";
}elseif ($pemakaian == "dijual") {
	$pakai = " dan dijual kepada";
}

// kondisi jika data kosong
if(empty($surat['id'])){
	$id_surat = '';
}else{
	$id_surat = $surat['id'];
}

// kondisi jika jumlah data lebih dari 3, maka hapus paling awal
if ($jumlah_surat>2) {
	$delete = mysqli_query($db, "DELETE FROM tb_surat WHERE id = $id_surat");
}

// menyiapkan Query MySQL untuk dieksekusi
$query = "INSERT INTO tb_surat (no_surat) VALUES ('$no_surat')";
// mengeksekusi MySQL Query
$insert = mysqli_query($db, $query);
if ($insert == false) {
	echo "Error Dalam Eksekusi Query. <a href='../form-skkb.php'>Kembali</a>";
}

$query_k = mysqli_query($db,"SELECT nama FROM tb_kepdes");
$kepdes = mysqli_fetch_assoc($query_k);

$namaKepdes = strtoupper($kepdes['nama']); 

// include master file
// define('FPDF_FONTPATH','C:\xampp\htdocs\SI_PESDES\library\fpdf\font');
define('FPDF_FONTPATH','/storage/ssd1/301/18576301/public_html/library/fpdf/font');
require_once('../library/fpdf/WriteTag.php');

// penerapan objek
$pdf = new PDF_WriteTag('P','mm',array(215.5,330));
$pdf->SetMargins(25,15,20,20);
$pdf->AddFont('bookman','','bookman-old-style.php');
$pdf->AddFont('bookman','I','ufonts.com_bookman-bt-italic.php');
$pdf->AddFont('bookman','B','ufonts.com_bookman-bold.php');
$pdf->AddFont('bookman','BI','ufonts.com_bookman-bold-italic.php');

// mulai dokumen
$pdf->AddPage();
$pdf->SetStyle("p","times","N",12,"0,0,0",12.5);
$pdf->SetStyle("p2","times","N",12,"0,0,0",0);
$pdf->SetStyle("b","times","B",0,"0,0,0");
// meletakkan gambar
$pdf->Image('../assets/img/logo/logo-kop.png',37,15.7,19.1,24.6);
// juudul
$pdf->Cell(22);
$pdf->SetFont('bookman','B',16);
$pdf->Cell(0,6.8,'PEMERINTAH KABUPATEN SITUBONDO',0,1,'C');
$pdf->Cell(22);
$pdf->Cell(0,6.8,'KECAMATAN ASEMBAGUS',0,1,'C');
$pdf->Cell(22);
$pdf->SetFont('bookman','B',18);
$pdf->Cell(0,6.8,'KANTOR KEPALA DESA BANTAL',0,1,'C');
$pdf->Cell(22);
$pdf->SetFont('bookman','',12);
$pdf->Cell(0,6.8,'Jalan Samir Nomor 10 Telepon Nomor 082301186497',0,1,'C');

// garis kop
$pdf->SetLineWidth(1);
$pdf->Line(25,44,195,44);
$pdf->SetLineWidth(0);
$pdf->Line(25,45,195,45);

// bawah kop surat
$pdf->Ln(7);
$pdf->Cell(107);
$pdf->SetFont('Times','I',12);
$pdf->Cell(60,4,"Formulir AI",0,1,'L');
$pdf->SetFont('Times','',12);
$pdf->Cell(16,5,"Nomor",0,0,'L');
$pdf->Cell(2);
$pdf->Cell(5,5,':',0,0,'L');
$pdf->Cell(92,5,"522.2/$no_surat/431.502.9.10/2022",0,0,'L');
$pdf->Cell(0,5,"Kepada :",0,1,'L');

$pdf->Cell(16,5,'Sifat',0,0,'L');
$pdf->Cell(2);
$pdf->Cell(5,5,':',0,0,'L');
$pdf->Cell(83,5,"Biasa",0,0,'L');
$pdf->Cell(0,5,"Yth. Sdr. Bupati Situbondo",0,1,'L');

$pdf->Cell(16,5,'Lampiran',0,0,'L');
$pdf->Cell(2);
$pdf->Cell(5,5,':',0,0,'L');
$pdf->Cell(92.5,5,"1 Lembar",0,0,'L');
$pdf->Cell(0,5,"Cq. Ka. Dinas Kehutanan ",0,1,'L');

$pdf->Cell(16,5,'Perihal',0,0,'L');
$pdf->Cell(2);
$pdf->Cell(5,5,':',0,0,'L');
$pdf->SetFont('Times','',12);
$pdf->Cell(92,5,"PERMOHONAN IZIN",0,0,'L');
$pdf->Cell(0,5,"Situbondo",0,1,'L');

$pdf->Cell(23);
$pdf->SetFont('Times','U',12);
$pdf->Cell(83,5,"PENEBANGAN KAYU MILIK SENDIRI",0,0,'L');
$pdf->SetFont('Times','',12);
$pdf->Cell(0,5,"Di",0,1,'L');
$pdf->Cell(87);
$pdf->SetFont('Times','U',12);
$pdf->Cell(0,5,"SITUBONDO",0,1,'C');

$pdf->Ln(9);
$pdf->SetFont('Times','',12);
$pdf->WriteTag(0,5,"<p>Berdasarkan Keputusan Bupati Situbondo, pada tanggal 5 Oktober 2000, Nomor 11 tahun 2000, tentang Penebangan Pohon di luar kawasan hutan, dalam Kabupaten Situbondo. Selanjutnya saya mengajukan ijin penebangan kayu dengan data sebagai berikut : </p>",0,"J");

$pdf->Ln(1);
$pdf->Cell(12,5,"1.",0,0,'L');
$pdf->Cell(25,5,'Nama',0,0,'L');
$pdf->Cell(5,5,':',0,0,'L');
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,5,$nama_up,0,1,'L');

$pdf->Cell(12);
$pdf->SetFont('Times','',12);
$pdf->Cell(25,5,'Pekerjaan',0,0,'L');
$pdf->Cell(5,5,':',0,0,'L');
$pdf->Cell(0,5,$pekerjaan,0,1,'L');

$pdf->Cell(12);
$pdf->SetFont('Times','',12);
$pdf->Cell(25,5,'Alamat',0,0,'L');
$pdf->Cell(5,5,':',0,0,'L');
$pdf->MultiCell(0,5,$alamat,0,'J');

$pdf->Cell(12,5,"2.",0,0,'L');
$pdf->WriteTag(0,5,"<p2>Pohon yang akan kami tebang terletak pada tanah dengan :  Atas Nama :  <b>$nama2</b> $alamat2, SPPT No : $no_sppt</p2>",0,'J');

$pdf->Ln(1);
$pdf->Cell(0,5,"Dan rincian kayu sebagai berikut :",0,1,'L');

$pdf->SetFont('Times','B',12);
$pdf->Cell(12.5,7,"No.",1,0,'C');
$pdf->Cell(79,7,"Jenis Kayu / Pohon",1,0,'C');
$pdf->Cell(79,7,"Jumlah Kayu",1,1,'C');

$pdf->SetFont('Times','',12);
$pdf->Cell(12.5,18,"1.",1,0,'C');
$pdf->Cell(79,18,"  $j_kayu",1,0,'L');
$pdf->Cell(79,18,"  $jml_kayu ( ".terbilang($jml_kayu)." ) Pohon",1,1,'L');

$pdf->Ln(2);
$pdf->Cell(12,5,"3.",0,0,'L');
$pdf->WriteTag(0,5,"<p2>Asal kayu tersebut adalah  milik kami sendiri$pakai :</p2>",0,'J');


$pdf->Ln(0);
$pdf->Cell(11);
$pdf->Cell(25,5,'Nama',0,0,'L');
$pdf->Cell(5,5,':',0,0,'L');
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,5,$nama3,0,1,'L');

$pdf->Cell(11);
$pdf->SetFont('Times','',12);
$pdf->Cell(25,5,'Pekerjaan',0,0,'L');
$pdf->Cell(5,5,':',0,0,'L');
$pdf->Cell(0,5,$pekerjaan2,0,1,'L');

$pdf->Cell(11);
$pdf->SetFont('Times','',12);
$pdf->Cell(25,5,'Alamat',0,0,'L');
$pdf->Cell(5,5,':',0,0,'L');
$pdf->MultiCell(0,5,$alamat3,0,'J');

$pdf->Ln(5);
$pdf->Cell(0,5,'Demikian untuk menjadi maklum, mohon dapatnya penyelesaian izin.',0,1,'L');

// ttd
$pdf->Ln(10);
$pdf->SetFont('Times','',11);

$pdf->Cell(115);
$pdf->Cell(55,6,'Bantal, '.$hari.' '.$bulan.' '.$tahun.'',0,1,'C');

$pdf->Cell(57.5,6,'PEMOHON',0,0,'C');
$pdf->Cell(57.5,6,'PPL DESA BANTAL',0,0,'C');
$pdf->Cell(55,6,'Kepala Desa Bantal',0,0,'C');

$pdf->Ln(30);
$pdf->SetFont('Times','BU',11);
$pdf->Cell(57.5,6,$nama_up,0,0,'C');
$pdf->Cell(57.5,6,'....................................',0,0,'C');
$pdf->Cell(55,6,"H. $namaKepdes",0,1,'C');

$pdf->Ln(15);
$pdf->SetFont('Times','',12);
$pdf->Cell(0,6,"1.    Untuk Pemohon",0,1,'L');
$pdf->Cell(0,6,"2.    Untuk Dinas Kehutan",0,1,'L');
$pdf->Cell(0,6,"3.    Untuk Kecamatan",0,1,'L');
$pdf->Cell(0,6,"4.    Untuk Kepala Desa",0,1,'L');
$pdf->Cell(0,6,"5.    Untuk KRPH Setempat",0,1,'L');

$pdf->Output();


?>