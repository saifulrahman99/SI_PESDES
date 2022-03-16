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
if (isset($_POST['penggunaan'])) {
	$penggunaan = $_POST['penggunaan'];
}
else{
	echo "kesalahan dari penggunaan";
}
// batas
if (isset($_POST['j_usaha'])) {
	$j_usaha = $_POST['j_usaha'];
}
else{
	echo "kesalahan dari j_usaha";
}
// batas
if (isset($_POST['tmpt_ambil'])) {
	$tmpt_ambil = $_POST['tmpt_ambil'];
}
else{
	echo "kesalahan dari tmpt_ambil";
}
// batas
if (isset($_POST['lokasi_ambil'])) {
	$lokasi_ambil = $_POST['lokasi_ambil'];
}
else{
	echo "kesalahan dari lokasi_ambil";
}
// batas
if (isset($_POST['j_alat'])) {
	$j_alat = $_POST['j_alat'];
}
else{
	echo "kesalahan dari j_alat";
}
// batas
if (isset($_POST['jml_alat'])) {
	$jml_alat = $_POST['jml_alat'];
}
else{
	echo "kesalahan dari jml_alat";
}
// batas
if (isset($_POST['fungsi_alat'])) {
	$fungsi_alat = $_POST['fungsi_alat'];
}
else{
	echo "kesalahan dari fungsi_alat";
}
// batas
if (isset($_POST['j_bbm'])) {
	$j_bbm = $_POST['j_bbm'];
}
else{
	echo "kesalahan dari j_bbm";
}
// batas
if (isset($_POST['jml_kebutuhan'])) {
	$jml_kebutuhan = $_POST['jml_kebutuhan'];
}
else{
	echo "kesalahan dari jml_kebutuhan";
}
// batas
if (isset($_POST['lama_operasi'])) {
	$lama_operasi = $_POST['lama_operasi'];
}
else{
	echo "kesalahan dari lama_operasi";
}
// batas
if (isset($_POST['acuan_operasi'])) {
	$acuan_operasi = $_POST['acuan_operasi'];
}
else{
	echo "kesalahan dari acuan_operasi";
}
// batas
if (isset($_POST['konsumsi_bbm'])) {
	$konsumsi_bbm = $_POST['konsumsi_bbm'];
}
else{
	echo "kesalahan dari konsumsi_bbm";
}
// batas
if (isset($_POST['acuan_konsumsi'])) {
	$acuan_konsumsi = $_POST['acuan_konsumsi'];
}
else{
	echo "kesalahan dari acuan_konsumsi";
}
// batas
if (isset($_POST['berlaku'])) {
	$berlaku = $_POST['berlaku'];
}
else{
	echo "kesalahan dari berlaku";
}
// batas
if (isset($_POST['no_penyalur'])) {
	$no_penyalur = $_POST['no_penyalur'];
}
else{
	echo "kesalahan dari no_penyalur";
}

// include fungsi ubah tanggal
require('../library/ubah_tanggal.php');

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


// include master file
// define('FPDF_FONTPATH','C:\xampp\htdocs\SI_PESDES\library\fpdf\font');
define('FPDF_FONTPATH','/storage/ssd1/301/18576301/public_html/library/fpdf/font');
require_once('../library/fpdf/WriteTag.php');

class myPDF extends PDF_WriteTag{
	function myCell($w,$h,$x,$t){
		$height = $h/3.5;
		$first = $height;
		$second = $height+$height+3;
		$third = $height+$height+$height+$height+1;
		$forth = $height+$height+$height+$height+$height+3.5;
		$five = $height+$height+$height+$height+$height+9;
		$six = $height+$height+$height+$height+$height+$height+11;
		$len = strlen($t);

		if ($len>$w/2) {
			$txt = str_split($t,$w/2.5);
			$this->SetX($x);
			$this->Cell($w,$first,$txt[0],'','','C');
			$this->SetX($x);
			$this->Cell($w,$second,$txt[1],'','','C');
			$hitung_array = count($txt);
			if ($hitung_array == 3) {
				$this->SetX($x);
				$this->Cell($w,$third,$txt[2],'','','C');
			}elseif ($hitung_array == 4) {
				$this->SetX($x);
				$this->Cell($w,$third,$txt[2],'','','C');
				$this->SetX($x);
				$this->Cell($w,$forth,$txt[3],'','','C');
			}elseif ($hitung_array == 5){
				$this->SetX($x);
				$this->Cell($w,$third,$txt[2],'','','C');
				$this->SetX($x);
				$this->Cell($w,$forth,$txt[3],'','','C');
				$this->SetX($x);
				$this->Cell($w,$five,$txt[4],'','','C');
			}elseif ($hitung_array == 6){
				$this->SetX($x);
				$this->Cell($w,$third,$txt[2],'','','C');
				$this->SetX($x);
				$this->Cell($w,$forth,$txt[3],'','','C');
				$this->SetX($x);
				$this->Cell($w,$five,$txt[4],'','','C');
				$this->SetX($x);
				$this->Cell($w,$six,$txt[5],'','','C');
			}
			$this->SetX($x);
			$this->Cell($w,$h,'','',0,'C',0);
		}else{
			$this->SetX($x);
			$this->Cell($w,$h,$t,'',0,'C',0);
		}
	}
}
	// penerapan objek
$pdf=new myPDF('P','mm',array(215.5,330));
$pdf->SetMargins(25,15,20,20);
$pdf->AddFont('bookman','','bookman-old-style.php');
$pdf->AddFont('bookman','I','ufonts.com_bookman-bt-italic.php');
$pdf->AddFont('bookman','B','ufonts.com_bookman-bold.php');
$pdf->AddFont('bookman','BI','ufonts.com_bookman-bold-italic.php');

// mulai dokumen
$pdf->AddPage();
	// Stylesheet
$pdf->SetStyle("p","times","N",12,"0,0,0",10);
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
$pdf->Line(25,44,192,44);
$pdf->SetLineWidth(0);
$pdf->Line(25,45,192,45);

// jenis surat dan nomor surat
$pdf->SetFont('Times','B',12);
$pdf->Ln(14);
$pdf->Cell(0,1,"SURAT REKOMENDASI PEMBELIAN BBM JENIS TERTENTU",0,1,'C');
$pdf->SetStyle("b","times","B",0,"0,0,0");

$pdf->SetLineWidth(0.4);
$pdf->Line(48,58.9,171.9,58.9);

$pdf->SetFont('Times','B',12);
$pdf->Ln(5);
$pdf->Cell(0,0,"Nomor: 541/$no_surat/431.513.9.2/$tahun",0,1,'C');
// isi
$pdf->Ln(10);
$pdf->SetFont('Times','',12);
$pdf->Cell(0,7,'Dasar Hukum :',0,1,'J');

$pdf->SetFont('Times','',12);
$pdf->Cell(8);
$pdf->Cell(40,7,'1.  Undang-Undang Nomor 22 Tahun 2001 tentang Minyak dan Gas Bumi',0,1,'L');
$pdf->Cell(8);
$pdf->Cell(40,7,'2.  Undang-Undang Nomor 32 Tahun 2004 tentang Pemerintah Daerah',0,1,'L');
$pdf->Cell(8);
$pdf->Cell(40,7,'3.  Perpres Nomor 15 Tahun 2012 tentang Harga Jual Eceran dan Konsumen Pengguna JBT',0,1,'L');

$pdf->Ln(3);
$pdf->Cell(0,7,'Dengan ini memberikan Rekomendasi Kepada :',0,1,'J');

$pdf->Ln(1);
$pdf->Cell(40,7,'Nama',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,7,$nama_up,0,1,'L');

$pdf->SetFont('Times','',12);
$pdf->Cell(40,7,'Alamat',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->MultiCell(0,7,"Kampung  $dusun, RT  $rt /  RW $rw, Desa  Bantal,  Kecamatan Asembagus, Kabupaten Situbondo.",0,'L');

$pdf->SetFont('Times','',12);
$pdf->Cell(40,7,'Konsumen Pengguna',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,$penggunaan,0,1,'L');

$pdf->SetFont('Times','',12);
$pdf->Cell(40,7,'Jenis Usaha/Kegiatan',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,ucwords($j_usaha),0,1,'L');

$pdf->Cell(8);
$pdf->Cell(40,7,'1.	 Berdasarkan hasil verifikasi, Kebutuhan BBM digunakan untuk sarana sebagai berikut :',0,1,'L');

// garis kolom horizontal
$pdf->SetLineWidth(0);
$pdf->Line(25,152.7,203,152.7);
$pdf->Line(25,170,203,170);
$pdf->Line(25,192,203,192);
$pdf->Line(25,197,203,197);

// garis kolom vertikal
$pdf->SetLineWidth(0);
$pdf->Line(25,152.7,25,197);
$pdf->Line(34,152.7,34,192);
$pdf->Line(50,152.7,50,192);
$pdf->Line(65,152.7,65,192);
$pdf->Line(88,152.7,88,192);
$pdf->Line(112,152.7,112,192);
$pdf->Line(138,152.7,138,192);
$pdf->Line(160,152.7,160,197);
$pdf->Line(203,152.7,203,197);


$h = 17;

$w = 10;
$x = $pdf->GetX();
$pdf->myCell($w,$h,$x,'No');

$x = $pdf->GetX();
$y = $pdf->GetY();
$w = 15;
$pdf->SetY($y+3);
$pdf->myCell($w,$h,$x,'Jenis Alat');

$x = $pdf->GetX();
$w = 15;
$pdf->myCell($w,$h,$x,'Jumlah Alat');

$x = $pdf->GetX();
$y = $pdf->GetY();
$w = 23;
$pdf->SetY($y-5);
$pdf->myCell($w,$h,$x,'Fungsi Alat');

$x = $pdf->GetX();
$y = $pdf->GetY();
$w = 25;
$pdf->SetY($y+5);
$pdf->myCell($w,$h,$x,'BBM Jenis Tertentu');

$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetY($y-2);
$w = 25;
$pdf->myCell($w,$h,$x,'Kebutuhan BBM Jenis Tertentu');

$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetY($y+2);
$pdf->SetX($x-80);
$w = 23;
$pdf->myCell($w,$h,$x,"Jam/ Hari Operasi");

$x = $pdf->GetX();
$y = $pdf->GetY();
$w = 40;
$pdf->SetY($y-3);
$pdf->SetX($x);
$pdf->MultiCell($w,4,'Konsumsi BBM Jenis Tertentu Liter per(Jam/Hari/Minggu/Bulan)',0,'C');
$pdf->Ln();


$h = 20;

$x = $pdf->GetX();
$y = $pdf->GetY();
$w = 10;
$pdf->SetY($y-1.2);
$pdf->myCell($w,$h,$x,'1.');

$x = $pdf->GetX();
$pdf->SetY($y-1);
$pdf->SetX($x);
$w = 15;
$pdf->MultiCell($w,4.2,$j_alat,'','C');

$x = 50;
$pdf->SetY($y-1.5);
$pdf->SetX($x);
$w = 15;
$pdf->myCell($w,$h,$x,"$jml_alat Buah");

$w = 23;
// $pdf->SetFont('Times','',11);
$pdf->MultiCell($w,4.2,$fungsi_alat,'','C');

$x = 87;
$pdf->SetFont('Times','',12);
$pdf->SetX($x);
$pdf->SetY($y-1.2);
$w = 25;
$pdf->myCell($w,$h,$x,strtoupper($j_bbm));

$x = $pdf->GetX();
$w = 25;
$pdf->myCell($w,$h,$x,"$jml_kebutuhan Liter");

$x = $pdf->GetX();
$w = 23;
$pdf->myCell($w,$h,$x,"$lama_operasi $acuan_operasi");

$x = $pdf->GetX();
$w = 40;
$pdf->myCell($w,$h,$x,"$konsumsi_bbm $acuan_konsumsi");
$pdf->Ln();



$x = $pdf->GetX();
$h = 5;
$w = 138;
$pdf->myCell($w,$h,$x,"Jumlah");

$x = $pdf->GetX();
$w = 40;
$pdf->myCell($w,$h,$x,"");
$pdf->Ln();

$pdf->Cell(8);
$pdf->Cell(40,6,'2.   Diberikan alokasi volume Bensin (Gasoline) RON BB/Minyak Solar (Gas Oil) :',0,1,'L');

$pdf->Cell(15);
$pdf->SetFont('Arial','',12);
$pdf->Cell(5,5,chr(149),0,0,'L');
$pdf->SetFont('Times','',12);
$pdf->Cell(50,5,"Sejumlah",0,0,'L');
$pdf->Cell(5,5,":",0,0,'L');
$pdf->Cell(40,5,"$jml_kebutuhan Liter (".ucfirst($j_bbm).")",0,1,'L');

$pdf->Cell(15);
$pdf->SetFont('Arial','',12);
$pdf->Cell(5,5,chr(149),0,0,'L');
$pdf->SetFont('Times','',12);
$pdf->Cell(50,5,"Tempat Pengambilan",0,0,'L');
$pdf->Cell(5,5,":",0,0,'L');
$pdf->Cell(40,5,ucwords($tmpt_ambil),0,1,'L');

$pdf->Cell(15);
$pdf->SetFont('Arial','',12);
$pdf->Cell(5,5,chr(149),0,0,'L');
$pdf->SetFont('Times','',12);
$pdf->Cell(50,5,"Nomor Lembaga Penyalur",0,0,'L');
$pdf->Cell(5,5,":",0,0,'L');
$pdf->Cell(40,5,$no_penyalur,0,1,'L');

$pdf->Cell(15);
$pdf->SetFont('Arial','',12);
$pdf->Cell(5,5,chr(149),0,0,'L');
$pdf->SetFont('Times','',12);
$pdf->Cell(50,5,"Lokasi",0,0,'L');
$pdf->Cell(5,5,":",0,0,'L');
$pdf->Cell(40,5,ucwords($lokasi_ambil),0,1,'L');

$pdf->Cell(8);
$pdf->Cell(40,6,"3.   Masa berlaku Surat Rekomendasi sampai dengan $hari_berlaku $bulan_berlaku $tahun_berlaku",0,1,'L');

$pdf->Cell(8);
$pdf->Cell(6.5,6,"4.",0,0,'L');
$pdf->MultiCell(0,6,"Apabila penggunaan surat rekomendasi ini tidak sebagaimana mestinya, maka akan dicabut dan ditindaklanjuti dengan proses hukum sesuai dengan ketentuan dan peraturan perundang-undangan. ",0,'J');


// ttd
$pdf->Ln(10);
$pdf->SetFont('Times','',12);
$pdf->Cell(8);
$pdf->Cell(102,6,'',0,0,'L');
$pdf->Cell(45,6,'Bantal, '.$hari.' '.$bulan.' '.$tahun.'',0,1,'C');
$pdf->Cell(22);
$pdf->Cell(88,6,'',0,0,'L');
$pdf->Cell(45,6,'Kepala Desa Bantal',0,0,'C');

$pdf->Ln(25);
$pdf->Cell(7);
$pdf->SetFont('Times','BU',12);
$pdf->Cell(65,6,'',0,0,'C');
$pdf->Cell(38,6,'',0,0,'L');
$pdf->Cell(45,6,"H. $namaKepdes",0,0,'C');
$pdf->Output();

?>
