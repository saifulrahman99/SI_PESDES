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
if (isset($_POST['no_kk'])) {
	$no_kk = $_POST['no_kk'];
}
else{
	echo "kesalahan dari no_kk";
}
// batas
if (isset($_POST['kp_kk'])) {
	$kp_kk = $_POST['kp_kk'];
}
else{
	echo "kesalahan dari kp_kk";
}
// batas
// batas
if (isset($_POST['alamat_pindah'])) {
	$alamat_pindah = $_POST['alamat_pindah'];
}
else{
	echo "kesalahan dari alamat_pindah";
}
// batas
// batas
if (isset($_POST['jml_pindah'])) {
	$jml_pindah = $_POST['jml_pindah'];
}
else{
	echo "kesalahan dari jml_pindah";
}
// batas
// batas
if (isset($_POST['jenis'])) {
	$jenis = $_POST['jenis'];
}
else{
	echo "kesalahan dari jenis";
}
// batas

// include fungsi ubah tanggal
require('../library/ubah_tanggal.php');
require('../library/terbilang.php');

$nama_up = strtoupper($nama);
$nama_kp_up = strtoupper($kp_kk);

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
	echo "Error Dalam Eksekusi Query. <a href='../form-skkb.php'>Kembali</a>";
}

$query_k = mysqli_query($db,"SELECT nama FROM tb_kepdes");
$kepdes = mysqli_fetch_assoc($query_k);

$namaKepdes = strtoupper($kepdes['nama']); 

if ($jenis == "ANTAR DUSUN, RT/RW DALAM SATU DESA/KELURAHAN") {
	$judul_surat = "ANTAR DUSUN, RT/RW DALAM SATU DESA/KELURAHAN";
}elseif ($jenis == "ANTAR KECAMATAN DALAM SATU KABUPATEN/KOTA") {
	$judul_surat = "ANTAR KECAMATAN DALAM SATU KABUPATEN/KOTA";
}elseif ($jenis == "ANTAR KABUPATEN/KOTA DALAM SATU PROVINSI") {
	$judul_surat = "ANTAR KABUPATEN/KOTA DALAM SATU PROVINSI";
}elseif ($jenis == "ANTAR KABUPATEN/KOTA ATAU ANTAR PROVINSI") {
	$judul_surat = "ANTAR KABUPATEN/KOTA ATAU ANTAR PROVINSI";
}

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

// Stylesheet
$pdf->SetStyle("p","times","N",12,"0,0,0",12.5);

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
$pdf->Cell(0,4.5,"SURAT KETERANGAN",0,1,'C');
$pdf->SetFont('Times','BU',12);
$pdf->Cell(0,4.5,$judul_surat,0,1,'C');

$pdf->SetFont('Times','B',12);
$pdf->Ln(3);
$pdf->Cell(0,0,"Nomor: 471.21/$no_surat/431.513.9.2/$tahun",0,1,'C');

$pdf->Ln(10);
$pdf->SetFont('Times','',12);
$pdf->WriteTag(0,7,"<p>Yang bertanda tangan di bawah ini, menerangkan Permohonan Pindah Penduduk WNI dengan data sebagai berikut :</p>",0,'J');

$pdf->Ln(1);
$pdf->Cell(5);
$pdf->Cell(6,7,'1.',0,0,'L');
$pdf->Cell(56,7,'NIK',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,$nik,0,1,'L');

$pdf->Cell(5);
$pdf->SetFont('Times','',12);
$pdf->Cell(6,7,'2.',0,0,'L');
$pdf->Cell(56,7,'Nama Lengkap',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,7,$nama_up,0,1,'L');

$pdf->Cell(5);
$pdf->SetFont('Times','',12);
$pdf->Cell(6,7,'3.',0,0,'L');
$pdf->Cell(56,7,'Nomor Kartu Keluarga',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,$no_kk,0,1,'L');

$pdf->Cell(5);
$pdf->Cell(6,7,'4.',0,0,'L');
$pdf->Cell(56,7,'Nama Kepala Keluarga',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,7,$nama_kp_up,0,1,'L');

$pdf->Cell(5);
$pdf->SetFont('Times','',12);
$pdf->Cell(6,7,'5.',0,0,'L');
$pdf->Cell(56,7,'Alamat Sekarang',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->MultiCell(0,7,"Kampung $dusun, RT  $rt / RW $rw, Desa Bantal, Kecamatan Asembagus Kode Pos 68373, Kabupaten Situbondo, Provinsi Jawa Timur.",0,'J');
$pdf->Cell(5);
$pdf->Cell(6,7,'6.',0,0,'L');
$pdf->Cell(56,7,'Alamat Tujuan',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pindah_up = ucwords($alamat_pindah);
$pdf->MultiCell(0,7,"$pindah_up.",0,'J');

$pdf->Cell(5);
$pdf->Cell(6,7,'7.',0,0,'L');
$pdf->Cell(56,7,'Jumlah Keluarga Yang Pindah',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');

$bilang_orang = terbilang($jml_pindah);
$pdf->Cell(0,7,"$jml_pindah ($bilang_orang) Orang",0,1,'L');

$pdf->Ln(3);
$pdf->Cell(0,7,"Adapun Permohonan Pindah Penduduk WNI yang bersangkutan sebagaimana terlampir.",0,1,'L');

$pdf->WriteTag(0,7,"<p>Demikian Surat Pengantar Pindah ini dibuat agar digunakan sebagaimana mestinya.</p>",0,'J');

// ttd
$pdf->Ln(12);
$pdf->SetFont('Times','',12);
$pdf->Cell(30);
$pdf->Cell(78,6,'',0,0,'L');
$pdf->Cell(45,6,'Bantal, '.$hari.' '.$bulan.' '.$tahun.'',0,1,'C');
$pdf->Cell(30);
$pdf->Cell(78,6,'',0,0,'L');
$pdf->Cell(45,6,'Kepala Desa Bantal',0,0,'C');
$pdf->Ln(25);
$pdf->Cell(17);
$pdf->SetFont('Times','BU',12);
$pdf->Cell(91,6,'',0,0,'C');
$pdf->Cell(45,6,"H. $namaKepdes",0,1,'C');


$pdf->Ln(20);
$pdf->SetFont('Times','',12);
$pdf->Cell(0,6,'Keterangan  :',0,0,'L');
$pdf->Ln(10);
$pdf->Cell(0,6,'Surat Pengantar ini dibawa oleh pemohon dan diarsipkan di Kecamatan',0,0,'L');

$pdf->Output();

?>