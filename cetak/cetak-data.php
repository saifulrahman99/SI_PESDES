<?php
require_once('../assets/koneksi.php');

 // convert file ke bentuk excel
    header("Content-type:application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data_Penduduk_Desa_Bantal.xls");

?>

<table border="1">
	<h1 align="center">Data Penduduk Desa Bantal</h1>
	<thead>
		<tr>
			<th>No</th>
			<th>NIK</th>
			<th >Nama</th>
			<th>NO KK</th>
			<th>Dusun</th>
			<th>RT</th>
			<th>RW</th>
			<th>Tempat Lahir</th>
			<th >Tanggal Lahir</th>
			<th>JK</th>
			<th >SHDK</th>
			<th>Agama</th>
			<th >Pendidikan</th>
			<th >Pekerjaan</th>
			<th >Nama Ayah</th>
			<th >Nama Ibu</th>
		</tr>
	</thead>

	<tbody>
		<?php

		$query= "SELECT * FROM tb_penduduk";
		$result=mysqli_query($db, $query);
							// foreach
		$i=1;
		foreach ($result as $penduduk) {
			?>
			<tr>
				<td><?php echo $i++?></td>
				<td><?php echo "'{$penduduk['nik']}"?></td>
				<td ><?php echo $penduduk['nama']?></td>
				<td><?php echo "'{$penduduk['no_kk']}"?></td>
				<td ><?php echo $penduduk['dusun']?></td>
				<td><?php echo "'{$penduduk['rt']}"?></td>
				<td><?php echo "'{$penduduk['rw']}"?></td>
				<td ><?php echo $penduduk['tmpt_lahir']?></td>
				<td><?php echo $penduduk['tgl_lahir']?></td>
				<td ><?php echo $penduduk['jk']?></td>
				<td ><?php echo $penduduk['shdk']?></td>
				<td ><?php echo $penduduk['agama']?></td>
				<td ><?php echo $penduduk['pendidikan']?></td>
				<td ><?php echo $penduduk['pekerjaan']?></td>
				<td ><?php echo $penduduk['nm_ayah']?></td>
				<td ><?php echo $penduduk['nm_ibu']?></td>
			</tr>

		<?php } ?>
	</tbody>
</table>
