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
if (isset($_POST['luas'])) {
	$luas = $_POST['luas'];
}
else{
	echo "kesalahan dari luas";
}

$nama_up = strtoupper($nama);
require('../library/ubah_tanggal.php');

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


$query_kepdes = "SELECT * FROM tb_kepdes";
$result_kepdes = mysqli_query($db,$query_kepdes);
$kepdes = mysqli_fetch_assoc($result_kepdes);

$namaKepdes = strtoupper($kepdes['nama']);

$format_luas = number_format($luas,0,".",".");

// include master file
// define('FPDF_FONTPATH','C:\xampp\htdocs\SI_PESDES\library\fpdf\font');
define('FPDF_FONTPATH','/storage/ssd1/301/18576301/public_html/library/fpdf/font');
require_once('../library/fpdf/fpdf.php');

// penerapan objek
$pdf = new FPDF('P','mm',array(215.5,330));
$pdf->SetMargins(25,15,20,20);
$pdf->AddFont('bookman','','bookman-old-style.php');
$pdf->AddFont('bookman','I','ufonts.com_bookman-bt-italic.php');
$pdf->AddFont('bookman','B','ufonts.com_bookman-bold.php');
$pdf->AddFont('bookman','BI','ufonts.com_bookman-bold-italic.php');

// mulai dokumen
$pdf->AddPage();
// meletakkan gambar
$pdf->Image('../assets/img/logo/logo-kop.png',37,16,19.2,24.6);
// judul
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
$pdf->Line(25,44,192.5,44);
$pdf->SetLineWidth(0);
$pdf->Line(25,45,192.5,45);

// jenis surat dan nomor surat
$pdf->SetFont('Times','B',12);
$pdf->Ln(13);
$pdf->Cell(0,1,"SURAT KETERANGAN",0,1,'C');

$pdf->SetLineWidth(0.4);
$pdf->Line(77.5,58.4,143,58.4);

$pdf->SetFont('Times','B',12);
$pdf->Ln(5);
$pdf->Cell(0,0,"Nomor: 593.2/$no_surat/431.513.9.2/$tahun",0,1,'C');

// isi
$pdf->Ln(10);
$pdf->Cell(10);
$pdf->SetFont('Times','',12);
$pdf->Cell(0,7,'Yang bertanda tangan dibawah ini :',0,1,'J');

$pdf->Ln(1);
$pdf->Cell(12.5);
$pdf->Cell(40,7,'Nama',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,7,$namaKepdes,0,1,'L');

$pdf->Cell(12.5);
$pdf->SetFont('Times','',12);
$pdf->Cell(40,7,'Jabatan',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->SetFont('Times','',12);
$pdf->Cell(0,7,'Kepala Desa Bantal',0,1,'L');
$pdf->Cell(57.7);
$pdf->Cell(0,7,'Kecamatan Asembagus Kabupaten Situbondo',0,1,'L');

$pdf->Ln(3);
$pdf->Cell(10);
$pdf->SetFont('Times','',12);
$pdf->Cell(0,7,'Menerangkan bahwa :',0,1,'J');
$pdf->Ln(1);
$pdf->Cell(12.5);
$pdf->Cell(40,7,'Nama',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,7,$nama_up,0,1,'L');

$pdf->Cell(12.5);
$pdf->SetFont('Times','',12);
$pdf->Cell(40,7,'Pekerjaan',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,$pekerjaan,0,1,'L');

$pdf->Cell(12.5);
$pdf->Cell(40,7,'Nomor dan Tgl. KTP',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,$nik,0,1,'L');

$pdf->Cell(12.5);
$pdf->Cell(40,7,'Alamat',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->MultiCell(0,7,"Kampung  $dusun, RT  $rt / RW $rw, Desa Bantal, Kecamatan Asembagus, Kabupaten Situbondo, Jawa Timur.",0,'L');

$pdf->Cell(12.5);
$pdf->Cell(40,7,'Menggarap Tanah',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');

$pdf->SetFont('Times','',12);
$pdf->Cell(38,7,"Milik sendiri : Seluas",0,0,'L');
$pdf->SetFont('Times','U',12);
$pdf->Cell(5,7,'+',0,0,'L');
$pdf->SetFont('Times','',12);
$pdf->Cell(5,7,"$format_luas M2",0,1,'L');
$pdf->Cell(57.7);
$pdf->Cell(0,7,"Lokasi Desa Bantal",0,1,'L');

$pdf->Ln(8);
$pdf->Cell(25);
$pdf->SetFont('Times','',12);
$pdf->Cell(0,7,'Demikian Surat Keterangan ini dibuat dengan sebenarnya dan dapat dipergunakan',0,1,'L');
$pdf->Cell(10);
$pdf->Cell(0,7,'sebagaimana mestinya.',0,1,'L');

// ttd
$pdf->Ln(12);
$pdf->SetFont('Times','',12);
$pdf->Cell(8);
$pdf->Cell(102,6,'',0,0,'L');
$pdf->Cell(45,6,'Bantal, '.$hari.' '.$bulan.' '.$tahun.'',0,1,'C');
$pdf->Cell(22);
$pdf->Cell(88,6,'Yang bersangkutan',0,0,'L');
$pdf->Cell(45,6,'Kepala Desa Bantal',0,0,'C');

$pdf->Ln(25);
$pdf->Cell(7);
$pdf->SetFont('Times','BU',12);
$pdf->Cell(65,6,$nama_up,0,0,'C');
$pdf->Cell(38,6,'',0,0,'L');
$pdf->Cell(45,6,"H. $namaKepdes",0,0,'C');
$pdf->Output();
?>