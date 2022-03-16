<?php

function sebutHari($hari){

	if ($hari == ""){
		return " ";
	}else{
		$sebut = strtotime($hari);
		$sebutHari = date('l',$sebut);

		if (empty($sebutHari)) {
			// code...
		}else{

			switch ($sebutHari) {

				case 'Monday':
				$sebutHari = "Senin";	
				break;

				case 'Tuesday':
				$sebutHari = "Selasa";	
				break;

				case 'Wednesday':
				$sebutHari = "Rabu";	
				break;

				case 'Thursday':
				$sebutHari = "Kamis";	
				break;

				case 'Friday':
				$sebutHari = "Jum'at";	
				break;

				case 'Saturday':
				$sebutHari = "Sabtu";	
				break;

				case 'Sunday':
				$sebutHari = "Minggu";	
				break;

			}
		}
		return $sebutHari;
	}
}

?>