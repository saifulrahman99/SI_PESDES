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
if (isset($_POST['jk'])) {
	$jk = $_POST['jk'];
}
// batas
if (isset($_POST['tgl_kelahiran'])) {
	$tgl_kelahiran = $_POST['tgl_kelahiran'];
}
// batas
if (isset($_POST['nm_ibu'])) {
	$nm_ibu = $_POST['nm_ibu'];
}
// batas
if (isset($_POST['nm_ayah'])) {
	$nm_ayah = $_POST['nm_ayah'];
}


$pecah_tgl = explode('T', $tgl_kelahiran);
$tgl_lahir_new = $pecah_tgl[0];
$jam_lahir = $pecah_tgl[1];
$jam_lahir2 = explode(":", $jam_lahir);

$jam_l = $jam_lahir2[0];
$menit_l = $jam_lahir2[1];

$tgl_lahir = "$tgl_lahir_new";

// echo "$tgl_lahir_new";
require('../library/ubah_tanggal.php');
require('../library/bilang_hari.php');

$sebutH = sebutHari($tgl_lahir_new); 
$nama_up = strtoupper($nama);

$ttl_new = "$hari_lahir $bulan_lahir $tahun_lahir";

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

$pdf->SetLineWidth(0.4);
$pdf->Line(77.8,58.9,143,58.9);

$pdf->SetFont('Times','B',12);
$pdf->Ln(5);
$pdf->Cell(0,0,"Nomor: 474.1/$no_surat/431.513.9.2/$tahun",0,1,'C');

// isi
$pdf->Ln(10);
$pdf->WriteTag(0,6,"<p>Yang bertanda tangan dibawah ini kami Kepala Desa Bantal Kecamatan Asembagus Kabupaten Situbondo, menerangkan dengan sebenarnya bahwa pada :</p>",0,"J");

$pdf->Ln(2);
$pdf->Cell(12.5);
$pdf->Cell(40,8,'Hari / Jam Lahir',0,0,'L');
$pdf->Cell(5,8,':',0,0,'L');
$pdf->SetFont('Times','',12);
$pdf->Cell(0,8,"$sebutH, $jam_l.$menit_l WIB",0,1,'L');

$pdf->Cell(12.5);
$pdf->Cell(40,8,'Tanggal',0,0,'L');
$pdf->Cell(5,8,':',0,0,'L');
$pdf->SetFont('Times','',12);
$pdf->Cell(0,8,"$ttl_new",0,1,'L');

$pdf->Cell(12.5);
$pdf->Cell(40,8,'Tempat',0,0,'L');
$pdf->Cell(5,8,':',0,0,'L');
$pdf->SetFont('Times','',12);
$pdf->Cell(0,8,"Desa Bantal Kec. Asembagus Kab. Situbondo",0,1,'L');

$pdf->Ln(2);
$pdf->Cell(-1);
$pdf->Cell(49,8,'Telah Lahir Seorang Anak',0,0,'L');
$pdf->Cell(5,8,':',0,1,'L');

$pdf->Cell(12.5);
$pdf->Cell(40,8,'Nama',0,0,'L');
$pdf->Cell(5,8,':',0,0,'L');
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,8,"$nama_up",0,1,'L');

$pdf->Cell(12.5);
$pdf->SetFont('Times','',12);
$pdf->Cell(40,8,'Jenis Kelamin',0,0,'L');
$pdf->Cell(5,8,':',0,0,'L');
$pdf->SetFont('Times','',12);
$pdf->Cell(0,8,"$jk",0,1,'L');

$pdf->Ln(2);
$pdf->Cell(-1);
$pdf->Cell(33,8,'Dari Perkawinan',0,0,'L');
$pdf->Cell(5,8,':',0,1,'L');

$pdf->Cell(12.5);
$pdf->SetFont('Times','',12);
$pdf->Cell(40,8,'Nama Ibu',0,0,'L');
$pdf->Cell(5,8,':',0,0,'L');
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,8,strtoupper($nm_ibu),0,1,'L');

$pdf->Cell(12.5);
$pdf->SetFont('Times','',12);
$pdf->Cell(40,8,'Nama Ayah',0,0,'L');
$pdf->Cell(5,8,':',0,0,'L');
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,8,strtoupper($nm_ayah),0,1,'L');

$pdf->Cell(12.5);
$pdf->SetFont('Times','',12);
$pdf->Cell(40,7,'Alamat',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->MultiCell(0,7,"Kampung  $dusun, RT  $rt /  RW $rw, Desa  Bantal,  Kecamatan Asembagus, Kode Pos 68373, Kabupaten Situbondo.",0,'J');

$pdf->Ln(2);
$pdf->WriteTag(0,6,"<p>Demikian Surat Keterangan ini kami buat dengan sebenarnya, untuk digunakan sebagaimana mestinya.</p>",0,"J");

// ttd
$pdf->Ln(10);
$pdf->SetFont('Times','',12);
$pdf->Cell(8);
$pdf->Cell(102,6,'',0,0,'L');
$pdf->Cell(45,6,'Bantal, '.$hari.' '.$bulan.' '.$tahun.'',0,1,'C');
$pdf->Cell(22);
$pdf->Cell(32,6,'Pemohon',0,0,'C');
$pdf->Cell(56,6,'',0,0,'L');
$pdf->Cell(45,6,'Kepala Desa Bantal',0,0,'C');

$pdf->Ln(25);
$pdf->Cell(7);
$pdf->SetFont('Times','BU',12);
$pdf->Cell(62,6,strtoupper($nm_ibu),0,0,'C');
$pdf->Cell(41,6,'',0,0,'L');
$pdf->Cell(45,6,"H. $namaKepdes",0,0,'C');

$pdf->Output();

?>