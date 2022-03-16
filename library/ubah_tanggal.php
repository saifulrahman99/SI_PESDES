<?php
// tanggal Hari Ini
$tanggal = date('d-m-Y');
$tgl = explode("-", $tanggal);
$hari = $tgl[0]; 
$bulan = $tgl[1];
$tahun = $tgl[2];
switch ($bulan) {
	case '01':
	$bulan = "Januari";
	break;
	case '02':
	$bulan = "Februari";
	break;
	case '03':
	$bulan = "Maret";
	break;
	case '04':
	$bulan = "April";
	break;
	case '05':
	$bulan = "Mei";
	break;
	case '06':
	$bulan = "Juni";
	break;
	case '07':
	$bulan = "Juli";
	break;
	case '08':
	$bulan = "Agustus";
	break;
	case '09':
	$bulan = "September";
	break;
	case '10':
	$bulan = "Oktober";
	break;
	case '11':
	$bulan = "November";
	break;
	case '12':
	$bulan = "Desember";
	break;
	
}

// tanggal lahir Orang Yang Bersangkutan
if (isset($tgl_lahir)) {

	$tgl_lahir = explode("-", $tgl_lahir);
	$tahun_lahir = $tgl_lahir[0];
	$bulan_lahir = $tgl_lahir[1];
	$hari_lahir = $tgl_lahir[2];

	switch ($bulan_lahir) {
		case '01':
		$bulan_lahir = "Januari";
		break;
		case '02':
		$bulan_lahir = "Februari";
		break;
		case '03':
		$bulan_lahir = "Maret";
		break;
		case '04':
		$bulan_lahir = "April";
		break;
		case '05':
		$bulan_lahir = "Mei";
		break;
		case '06':
		$bulan_lahir = "Juni";
		break;
		case '07':
		$bulan_lahir = "Juli";
		break;
		case '08':
		$bulan_lahir = "Agustus";
		break;
		case '09':
		$bulan_lahir = "September";
		break;
		case '10':
		$bulan_lahir = "Oktober";
		break;
		case '11':
		$bulan_lahir = "November";
		break;
		case '12':
		$bulan_lahir = "Desember";
		break;
		
	}
}

if (isset($tgl_lahir2)) {

	$tgl_lahir2 = explode("-", $tgl_lahir2);
	$tahun_lahir2 = $tgl_lahir2[0];
	$bulan_lahir2 = $tgl_lahir2[1];
	$hari_lahir2 = $tgl_lahir2[2];

	switch ($bulan_lahir2) {
		case '01':
		$bulan_lahir2 = "Januari";
		break;
		case '02':
		$bulan_lahir2 = "Februari";
		break;
		case '03':
		$bulan_lahir2 = "Maret";
		break;
		case '04':
		$bulan_lahir2 = "April";
		break;
		case '05':
		$bulan_lahir2 = "Mei";
		break;
		case '06':
		$bulan_lahir2 = "Juni";
		break;
		case '07':
		$bulan_lahir2 = "Juli";
		break;
		case '08':
		$bulan_lahir2 = "Agustus";
		break;
		case '09':
		$bulan_lahir2 = "September";
		break;
		case '10':
		$bulan_lahir2 = "Oktober";
		break;
		case '11':
		$bulan_lahir2 = "November";
		break;
		case '12':
		$bulan_lahir2 = "Desember";
		break;
		
	}
}


// jangka berlaku surat BMM
if (isset($berlaku)) {

	$berlaku = explode("-", $berlaku);
	$tahun_berlaku = $berlaku[0];
	$bulan_berlaku = $berlaku[1];
	$hari_berlaku = $berlaku[2];

	switch ($bulan_berlaku) {
		case '01':
		$bulan_berlaku = "Januari";
		break;
		case '02':
		$bulan_berlaku = "Februari";
		break;
		case '03':
		$bulan_berlaku = "Maret";
		break;
		case '04':
		$bulan_berlaku = "April";
		break;
		case '05':
		$bulan_berlaku = "Mei";
		break;
		case '06':
		$bulan_berlaku = "Juni";
		break;
		case '07':
		$bulan_berlaku = "Juli";
		break;
		case '08':
		$bulan_berlaku = "Agustus";
		break;
		case '09':
		$bulan_berlaku = "September";
		break;
		case '10':
		$bulan_berlaku = "Oktober";
		break;
		case '11':
		$bulan_berlaku = "November";
		break;
		case '12':
		$bulan_berlaku = "Desember";
		break;
		
	}
}

// jangka mati surat BMM
if (isset($mati)) {

	$mati = explode("-", $mati);
	$tahun_mati = $mati[0];
	$bulan_mati = $mati[1];
	$hari_mati = $mati[2];

	switch ($bulan_mati) {
		case '01':
		$bulan_mati = "Januari";
		break;
		case '02':
		$bulan_mati = "Februari";
		break;
		case '03':
		$bulan_mati = "Maret";
		break;
		case '04':
		$bulan_mati = "April";
		break;
		case '05':
		$bulan_mati = "Mei";
		break;
		case '06':
		$bulan_mati = "Juni";
		break;
		case '07':
		$bulan_mati = "Juli";
		break;
		case '08':
		$bulan_mati = "Agustus";
		break;
		case '09':
		$bulan_mati = "September";
		break;
		case '10':
		$bulan_mati = "Oktober";
		break;
		case '11':
		$bulan_mati = "November";
		break;
		case '12':
		$bulan_mati = "Desember";
		break;
		
	}
}
?>