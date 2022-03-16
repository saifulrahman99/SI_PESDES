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
if (isset($_POST['nik'])) {
	$nik = $_POST['nik'];
}
else{
	echo "kesalahan dari nik";
}
// batas
if (isset($_POST['nama'])) {
	$nama = $_POST['nama'];
}
else{
	echo "kesalahan dari nama ";
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
if (isset($_POST['pekerjaan'])) {
	$pekerjaan = $_POST['pekerjaan'];
}
else{
	echo "kesalahan dari pekerjaan";
}
// batas
if (isset($_POST['agama'])) {
	$agama = $_POST['agama'];
}
else{
	echo "kesalahan dari agama";
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
if (isset($_POST['perkawinan'])) {
	$perkawinan = $_POST['perkawinan'];
}
else{
	echo "kesalahan dari perkawinan";
}
// batas
if (isset($_POST['ket_wn'])) {
	$ket_wn = $_POST['ket_wn'];
}
else{
	echo "kesalahan dari ket_wn";
}
// batas
if (isset($_POST['jk'])) {
	$jk = $_POST['jk'];
}
else{
	echo "kesalahan dari jk";
}

// include fungsi ubah tanggal
require('../library/ubah_tanggal.php');

$nama_up = strtoupper($nama);
$ttl_new = ''.$hari_lahir.' '.$bulan_lahir.' '.$tahun_lahir.'';

// menghapus data jika lebih dari 3
$data_surat = mysqli_query($db,"SELECT * FROM tb_surat");
$jumlah_surat = mysqli_num_rows($data_surat);
$surat = mysqli_fetch_assoc($data_surat);

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
	echo "Error Dalam Eksekusi Query.";
}

$query_k = mysqli_query($db,"SELECT nama FROM tb_kepdes");
$kepdes = mysqli_fetch_assoc($query_k);

$namaKepdes = strtoupper($kepdes['nama']); 

// include master file
// define('FPDF_FONTPATH','C:\xampp\htdocs\SI_PESDES\library\fpdf\font');
define('FPDF_FONTPATH','/storage/ssd1/301/18576301/public_html/library/fpdf/font');
require_once('../library/fpdf/WriteTag.php');

$pdf =new PDF_WriteTag('P','mm',array(215.5,330));
$pdf->SetMargins(25,15,20,20);
$pdf->AddFont('bookman','','bookman-old-style.php');
$pdf->AddFont('bookman','I','ufonts.com_bookman-bt-italic.php');
$pdf->AddFont('bookman','B','ufonts.com_bookman-bold.php');
$pdf->AddFont('bookman','BI','ufonts.com_bookman-bold-italic.php');

// mulai dokumen
$pdf->AddPage();
$pdf->SetStyle("p","times","N",12,"0,0,0",9);
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

// jenis surat dan nomor surat
$pdf->SetFont('Times','B',12);
$pdf->Ln(14);
$pdf->Cell(0,1,"SURAT KETERANGAN",0,1,'C');

$pdf->SetLineWidth(0.2);
$pdf->Line(77,59,143,59);

$pdf->SetFont('Times','B',12);
$pdf->Ln(5);
$pdf->Cell(0,0,"Nomor: 470/$no_surat/431.513.9.2/$tahun",0,1,'C');

// isi
$pdf->Ln(10);
$pdf->Cell(5);
$pdf->SetFont('Times','',12);
$pdf->Cell(0,7,'Yang bertanda tangan dibawah ini :',0,1,'J');

$pdf->Ln(1);
$pdf->Cell(8);
$pdf->Cell(40,7,'Nama',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,7,$namaKepdes,0,1,'L');

$pdf->Cell(8);
$pdf->SetFont('Times','',12);
$pdf->Cell(40,7,'Jabatan',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->SetFont('Times','',12);
$pdf->Cell(0,7,'Kepala Desa Bantal',0,1,'L');
$pdf->Cell(53.2);
$pdf->Cell(0,7,'Kecamatan Asembagus Kabupaten Situbondo',0,1,'L');

$pdf->Ln(3);
$pdf->Cell(5);
$pdf->Cell(0,6,'Menerangkan bahwa : ');

$pdf->Ln(7);
$pdf->Cell(8);
$pdf->Cell(40,7,'N a m a',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,7,$nama_up,0,1,'L');

$pdf->Cell(8);
$pdf->SetFont('Times','',12);
$pdf->Cell(40,7,'Jenis Kelamin',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,$jk,0,1,'L');

$pdf->Cell(8);
$pdf->Cell(40,7,'Tempat, tgl.Lahir',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,"$tmpt_lahir, $ttl_new",0,1,'L');

$pdf->Cell(8);
$pdf->Cell(40,7,'A g a m a',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,$agama,0,1,'L');

$pdf->Cell(8);
$pdf->Cell(40,7,'Kewarganegaraan',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,$ket_wn,0,1,'L');

$pdf->Cell(8);
$pdf->Cell(40,7,'Pekerjaan',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,$pekerjaan,0,1,'L');

$pdf->Cell(8);
$pdf->Cell(40,7,'Status Perkawinan',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,$perkawinan,0,1,'L');


$pdf->Cell(8);
$pdf->Cell(40,7,'A l a m a t',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->MultiCell(0,7,"Kampung  $dusun, RT  $rt /  RW $rw, Desa  Bantal,  Kecamatan Asembagus, Kabupaten Situbondo.",0,'L');

$pdf->Cell(8);
$pdf->Cell(40,7,'N I K',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,$nik,0,1,'L');

$pdf->Cell(8);
$pdf->Cell(40,7,'Keterangan',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->MultiCell(0,7,"Tersebut di atas benar-benar Penduduk Desa Bantal Kecamatan Asembagus, dan berdomisili dialamat tersebut diatas.",0,'J');

$pdf->Ln(2);
$pdf->WriteTag(0,7,"<p>Demikian Surat Keterangan ini kami buat dengan sebenarnya dan agar digunakan sebagaimana mestinya.</p>",0,'J');

// ttd
$pdf->Ln(10);
$pdf->SetFont('Times','',12);
$pdf->Cell(102);
$pdf->Cell(45,6,'Bantal, '.$hari.' '.$bulan.' '.$tahun.'',0,1,'C');
$pdf->Cell(102);
$pdf->Cell(45,6,'Kepala Desa Bantal',0,0,'C');

$pdf->Ln(25);
$pdf->Cell(7);
$pdf->SetFont('Times','BU',12);
$pdf->Cell(95);
$pdf->Cell(45,6,"H. $namaKepdes",0,0,'C');

$pdf->Output();
?>