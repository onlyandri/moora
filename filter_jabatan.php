<?php 
include 'koneksi.php';
if(isset($_POST["tgl_akhir"])){

	$tgl_awal = $_POST["tgl_awal"];
	$tgl_akhir = $_POST['tgl_akhir'];

	if($tgl_awal != '' && $tgl_akhir != ''){
		$query = "SELECT * FROM pelamar where tanggal_masuk between '$tgl_awal' and '$tgl_akhir'";
	}else{
		$query = "SELECT * FROM pelamar";
	}

	$output = '';
	

	$result = mysqli_query($conn, $query);

	if(mysqli_num_rows($result)>0){


		while($row = mysqli_fetch_array($result)){
			$output .='

			<tr>
			<td>'. $row["nama_pelamar"] .'</td>
			<td>'. $row["tanggal_masuk"] .'</td>
			<td>'. $row["jabatan"] .'</td>
			<td>'. $row["jenis_kelamin"] .'</td>
			<td>'. $row["tanggal_lahir"] .'</td>
			<td>'. $row["status_perkawinan"] .'</td>
			<td>'. $row["no_hp"] .'</td>
			<td>'. $row["alamat"] .'</td>
			<td>'. $row["pendidikan"] .'</td>
			<td>'. $row["tahun_lulus"] .'</td> 
			<td>'. $row["nilai_ipk"] .'</td>    
			<td>'. $row["pengalaman"] .'</td>             
			<td>
			<a href="pelamar_form_edit.php?id='. $row["kode_pelamar"] .'" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a> 
			<a onclick="return confirm(`apakah anda akan menghapus?`)" href="pelamar_delete.php?id='. $row["kode_pelamar"] .'" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a> 
			</td>
			</tr>
			';
		}
	}
	else
	{
		$output .=`
		<tr>
		<td>tidak ada data</td>
		<tr>

		`;
	}


	echo $output;

}
?>
