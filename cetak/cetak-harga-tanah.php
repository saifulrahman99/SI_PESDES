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
if (isset($_POST['no_sertifikat'])) {
	$no_sertifikat = $_POST['no_sertifikat'];
}
else{
	echo "kesalahan dari no_sertifikat";
}
// batas
if (isset($_POST['f_surat'])) {
	$f_surat = $_POST['f_surat'];
}
else{
	echo "kesalahan dari f_surat";
}
// batas
if (isset($_POST['luas'])) {
	$luas = $_POST['luas'];
}
else{
	echo "kesalahan dari luas";
}
// batas
if (isset($_POST['penggunaan'])) {
	$penggunaan = $_POST['penggunaan'];
}
else{
	echo "kesalahan dari penggunaan";
}
// batas
if (isset($_POST['b_utara'])) {
	$b_utara = $_POST['b_utara'];
}
else{
	echo "kesalahan dari b_utara";
}
// batas
if (isset($_POST['b_timur'])) {
	$b_timur = $_POST['b_timur'];
}
else{
	echo "kesalahan dari b_timur";
}
// batas
if (isset($_POST['b_selatan'])) {
	$b_selatan = $_POST['b_selatan'];
}
else{
	echo "kesalahan dari b_selatan";
}
// batas
if (isset($_POST['b_barat'])) {
	$b_barat = $_POST['b_barat'];
}
else{
	echo "kesalahan dari b_barat";
}
// batas
if (isset($_POST['harga_t'])) {
	$harga_t = $_POST['harga_t'];
}
else{
	echo "kesalahan dari harga_t";
}
// batas
if (isset($_POST['harga_b'])) {
	$harga_b = $_POST['harga_b'];
}
else{
	echo "kesalahan dari harga_b";
}

// include fungsi ubah tanggal
require('../library/ubah_tanggal.php');

require('../library/terbilang.php');

$nama_up = strtoupper($nama);

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

$format_luas = number_format($luas,0,".",".");
$format_penggunaan = ucfirst($penggunaan);
$bilang_tanah = terbilang($harga_t);
$bilang_bangunan = terbilang($harga_b);

$format_tanah = number_format($harga_t,0,".",".");

// filter ada atau tidaknya nilai harga bangunan
if ($harga_b == "") {
	$format_bangunan = "";
}else{
	$format_bangunan = number_format($harga_b,0,".",".");
}


// include master file
// define('FPDF_FONTPATH','C:\xampp\htdocs\SI_PESDES\library\fpdf\font');
define('FPDF_FONTPATH','/storage/ssd1/301/18576301/public_html/library/fpdf/font');
require_once('../library/fpdf/WriteTag.php');

if ($f_surat == "fbiasa") {
	
	// penerapan objek
	$pdf =new PDF_WriteTag('P','mm',array(215.5,330));
	$pdf->SetMargins(25,15,20,20);
	$pdf->AddFont('bookman','','bookman-old-style.php');
	$pdf->AddFont('bookman','I','ufonts.com_bookman-bt-italic.php');
	$pdf->AddFont('bookman','B','ufonts.com_bookman-bold.php');
	$pdf->AddFont('bookman','BI','ufonts.com_bookman-bold-italic.php');

// mulai dokumen
	$pdf->AddPage();
	$pdf->SetStyle("p","times","N",12,"0,0,0",9);
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

// jenis surat dan nomor surat
	$pdf->SetFont('Times','B',12);
	$pdf->Ln(14);
	$pdf->Cell(0,1,"SURAT KETERANGAN",0,1,'C');

	$pdf->SetLineWidth(0.4);
	$pdf->Line(77,58.9,143,58.9);

	$pdf->SetFont('Times','B',12);
	$pdf->Ln(5);
	$pdf->Cell(0,0,"Nomor: 590/$no_surat/431.513.9.2/$tahun",0,1,'C');
// isi
	$pdf->Ln(10);
	$pdf->Cell(12);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(0,7,'Yang bertanda tangan dibawah ini :',0,1,'J');

	$pdf->Ln(1);
	$pdf->Cell(14.5);
	$pdf->Cell(40,7,'Nama',0,0,'L');
	$pdf->Cell(5,7,':',0,0,'L');
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(0,7,$namaKepdes,0,1,'L');

	$pdf->Cell(14.5);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(40,7,'Jabatan',0,0,'L');
	$pdf->Cell(5,7,':',0,0,'L');
	$pdf->SetFont('Times','',12);
	$pdf->Cell(0,7,'Kepala Desa Bantal',0,1,'L');
	$pdf->Cell(59.6);
	$pdf->Cell(0,7,'Kecamatan Asembagus Kabupaten Situbondo',0,1,'L');
	
	$pdf->Ln(3);
	$pdf->Cell(12);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(0,7,'Menerangkan bahwa sebidang tanah :',0,1,'J');

	$pdf->Ln(1);
	$pdf->Cell(14.5);
	$pdf->Cell(46,7,'Sertifikat Hak Milik Nomor',0,0,'L');
	$pdf->Cell(3);
	$pdf->Cell(5,7,':',0,0,'L');
	$pdf->SetFont('Times','',12);
	$pdf->Cell(0,7,$no_sertifikat,0,1,'L');

	$pdf->Cell(14.5);
	$pdf->Cell(40,7,'Luas Persil',0,0,'L');
	$pdf->Cell(9);
	$pdf->Cell(5,7,':',0,0,'L');
	$pdf->SetFont('Times','',12);
	$pdf->Cell(0,7,"$format_luas M2",0,1,'L');

	$pdf->Cell(14.5);
	$pdf->Cell(40,7,'Letak Obyek Pajak',0,0,'L');
	$pdf->Cell(9);
	$pdf->Cell(5,7,':',0,0,'L');
	$pdf->SetFont('Times','',12);
	$pdf->Cell(0,7,'Desa Bantal Kec. Asembagus',0,1,'L');

	$pdf->Cell(14.5);
	$pdf->Cell(40,7,'Atas Nama',0,0,'L');
	$pdf->Cell(9);
	$pdf->Cell(5,7,':',0,0,'L');
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(0,7,$nama_up,0,1,'L');

	$pdf->Cell(14.5);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(40,7,'Alamat',0,0,'L');
	$pdf->Cell(9);
	$pdf->Cell(5,7,':',0,0,'L');
	$pdf->MultiCell(0,7,"Kampung  $dusun RT:$rt  RW:$rw, Desa  Bantal,  Kecamatan Asembagus, Kabupaten Situbondo.",0,'L');

	$pdf->Cell(14.5);
	$pdf->Cell(40,7,'Keterangan',0,0,'L');
	$pdf->Cell(9);
	$pdf->Cell(5,7,':',0,0,'L');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,7,"Taksiran harga tanah tersebut diatas saat ini kurang lebih senilai Rp. $format_tanah/M2 ($bilang_tanah Rupiah) permeter persegi.",0,'J');	

	$text1 = "<p>Demikian Surat Keterangan ini kami buat dengan sebenar-benarnya agar dapat dipergunakan sebagaimana mestinya.</p>";
	$pdf->Ln(3);
	$pdf->WriteTag(0,7,$text1,0,"J");

	// ttd
	$pdf->Ln(10);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(8);
	$pdf->Cell(95,6,'',0,0,'L');
	$pdf->Cell(45,6,'Dibuat di : Bantal, '.$hari.' '.$bulan.' '.$tahun.'',0,1,'C');
	$pdf->Cell(22);
	$pdf->Cell(80,6,'',0,0,'L');
	$pdf->Cell(45,6,'Kepala Desa Bantal',0,0,'C');

	$pdf->Ln(25);
	$pdf->Cell(7);
	$pdf->SetFont('Times','BU',12);
	$pdf->Cell(65,6,'',0,0,'C');
	$pdf->Cell(30,6,'',0,0,'L');
	$pdf->Cell(45,6,"H. $namaKepdes",0,0,'C');

	$pdf->Output();


}elseif ($f_surat == "flengkap" ) {
	
	// penerapan objek
	$pdf = new PDF_WriteTag('P','mm',array(215.5,330));
	$pdf->SetMargins(25,15,20,20);
	$pdf->AddFont('bookman','','bookman-old-style.php');
	$pdf->AddFont('bookman','I','ufonts.com_bookman-bt-italic.php');
	$pdf->AddFont('bookman','B','ufonts.com_bookman-bold.php');
	$pdf->AddFont('bookman','BI','ufonts.com_bookman-bold-italic.php');

// mulai dokumen
	$pdf->AddPage();
	$pdf->SetStyle("p","times","N",12,"0,0,0",10);
	$pdf->SetStyle("p2","times","N",12,"0,0,0",15);
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

// jenis surat dan nomor surat
	$pdf->SetFont('Times','B',12);
	$pdf->Ln(14);
	$pdf->Cell(0,1,"SURART KETERANGAN",0,1,'C');

	$pdf->SetLineWidth(0.4);
	$pdf->Line(77,58.9,143,58.9);

	$pdf->SetFont('Times','B',12);
	$pdf->Ln(5);
	$pdf->Cell(0,0,"Nomor: 590/$no_surat/431.513.9.2/$tahun",0,1,'C');
// isi
	$pdf->Ln(10);
	$pdf->Cell(13.7);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(0,7,'Yang bertanda tangan dibawah ini :',0,1,'J');

	$pdf->Ln(1);
	$pdf->Cell(16);
	$pdf->Cell(40,7,'Nama',0,0,'L');
	$pdf->Cell(5,7,':',0,0,'L');
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(0,7,$namaKepdes,0,1,'L');

	$pdf->Cell(16);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(40,7,'Jabatan',0,0,'L');
	$pdf->Cell(5,7,':',0,0,'L');
	$pdf->Cell(0,7,'Kepala Desa Bantal',0,1,'L');
	$pdf->Cell(61.3);
	$pdf->Cell(0,7,'Kecamatan Asembagus Kabupaten Situbondo',0,1,'L');

	$pdf->Ln(1);
	$pdf->Cell(5);
	$text1 = "<p>Menerangkan dengan sebenarnya, bahwa tanah/persil dengan bukti hak/pemilikan berupa</p>";
	$pdf->WriteTag(0,7,$text1,0,'J');

	$pdf->Ln(1);
	$pdf->Cell(0,7,'Sertifikat Hak Milik (SHM) :',0,1,'L');
	$pdf->Cell(16);
	
	$pdf->SetFont('Times','',12);
	$pdf->Cell(40,7,'Nomor/Tanggal SHM',0,0,'L');
	$pdf->Cell(5,7,':',0,0,'L');
	$pdf->Cell(0,7,$no_sertifikat,0,1,'L');

	$pdf->Cell(16);
	$pdf->Cell(40,7,'Atas Nama',0,0,'L');
	$pdf->Cell(5,7,':',0,0,'L');
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(0,7,$nama_up,0,1,'L');

	$pdf->Cell(16);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(40,7,'Letak Persil',0,0,'L');
	$pdf->Cell(5,7,':',0,0,'L');
	$pdf->MultiCell(0,7,"Kampung $dusun RT $rt RW $rw Desa Bantal, Kecamatan Asembagus, Kabupaten Situbondo.",0,'J');

	$pdf->Cell(16);
	$pdf->Cell(40,7,'Luas Persil',0,0,'L');
	$pdf->Cell(5,7,':',0,0,'L');
	$pdf->SetFont('Times','',12);
	$pdf->Cell(0,7,"$format_luas M2",0,1,'L');	

	$pdf->Cell(16);
	$pdf->Cell(40,7,'Penggunaan Persil',0,0,'L');
	$pdf->Cell(5,7,':',0,0,'L');
	$pdf->SetFont('Times','',12);
	$pdf->Cell(0,7,"$format_penggunaan",0,1,'L');

	$pdf->Ln(2);
	$pdf->Cell(0,7,'Dengan batas-batas sebagai berikut :',0,1,'L');	

	$pdf->Cell(16);
	$pdf->Cell(40,7,'Batas Utara',0,0,'L');
	$pdf->Cell(5,7,':',0,0,'L');
	$pdf->SetFont('Times','',12);
	$pdf->Cell(0,7,"$b_utara",0,1,'L');

	$pdf->Cell(16);
	$pdf->Cell(40,7,'Batas Timur',0,0,'L');
	$pdf->Cell(5,7,':',0,0,'L');
	$pdf->SetFont('Times','',12);
	$pdf->Cell(0,7,"$b_timur",0,1,'L');

	$pdf->Cell(16);
	$pdf->Cell(40,7,'Batas Selatan',0,0,'L');
	$pdf->Cell(5,7,':',0,0,'L');
	$pdf->SetFont('Times','',12);
	$pdf->Cell(0,7,"$b_selatan",0,1,'L');

	$pdf->Cell(16);
	$pdf->Cell(40,7,'Batas Barat',0,0,'L');
	$pdf->Cell(5,7,':',0,0,'L');
	$pdf->SetFont('Times','',12);
	$pdf->Cell(0,7,"$b_barat",0,1,'L');
	
	$pdf->Ln(2);
	$pdf->Cell(0,7,'Taksasi harga per M2 menurut kondisi pasar saat ini :',0,1,'L');

	$pdf->Cell(16);
	$pdf->Cell(40,7,'1.   Tanah Sebesar',0,0,'L');
	$pdf->Cell(5,7,'',0,0,'L');
	$pdf->SetFont('Times','',12);
	$pdf->MultiCell(0,7,"Rp. $format_tanah/M2 ($bilang_tanah Rupiah) Permeter Persegi",0,'L');

	$pdf->Cell(16);
	$pdf->Cell(40,7,'2.   Bangunan Sebesar',0,0,'L');
	$pdf->Cell(5,7,'',0,0,'L');
	$pdf->SetFont('Times','',12);

	if ($harga_b == "") {

		$pdf->MultiCell(0,7,"Rp.",0,'L');		
	}else{
		$pdf->MultiCell(0,7,"Rp. $format_bangunan ($bilang_bangunan Rupiah)",0,'L');
	}

	$pdf->Ln(4);
	$text2 = "<p2>Demikian Surat Keterangan ini kami buat dengan sebenar-benarnya agar dapat dipergunakan sebagaimana mestinya.</p2>";
	$pdf->WriteTag(0,7,$text2,0,'J');

	// ttd
	$pdf->Ln(10);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(8);
	$pdf->Cell(95,6,'',0,0,'L');
	$pdf->Cell(45,6,'Dibuat di : Bantal, '.$hari.' '.$bulan.' '.$tahun.'',0,1,'C');
	$pdf->Cell(22);
	$pdf->Cell(80,6,'',0,0,'L');
	$pdf->Cell(45,6,'Kepala Desa Bantal',0,0,'C');

	$pdf->Ln(25);
	$pdf->Cell(7);
	$pdf->SetFont('Times','BU',12);
	$pdf->Cell(65,6,'',0,0,'C');
	$pdf->Cell(30,6,'',0,0,'L');
	$pdf->Cell(45,6,"H. $namaKepdes",0,0,'C');

	$pdf->Output();

}
?>