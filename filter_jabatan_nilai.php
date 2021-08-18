<?php 
include 'koneksi.php';
if(isset($_POST["jbt"])){

	$jb = $_POST["jbt"];

	if($jb !== "t"){
		$query = "SELECT p.kode_pelamar, p.nama_pelamar, p.jabatan, n.tanggal_penilaian,
		max(case when n.kode_kriteria='K01' then n.nilai end) as 'K01',
		max(case when n.kode_kriteria='K02' then n.nilai end) as 'K02',
		max(case when n.kode_kriteria='K03' then n.nilai end) as 'K03',
		max(case when n.kode_kriteria='K04' then n.nilai end) as 'K04',
		max(case when n.kode_kriteria='K05' then n.nilai end) as 'K05',
		max(case when n.kode_kriteria='K06' then n.nilai end) as 'K06'  
		FROM penilaian n, pelamar p  where n.kode_pelamar=p.kode_pelamar GROUP BY p.kode_pelamar ORDER BY p.kode_pelamar DESC ";
	}else{
		$query = "SELECT p.kode_pelamar, p.nama_pelamar, p.jabatan, n.tanggal_penilaian,
		max(case when n.kode_kriteria='K01' then n.nilai end) as 'K01',
		max(case when n.kode_kriteria='K02' then n.nilai end) as 'K02',
		max(case when n.kode_kriteria='K03' then n.nilai end) as 'K03',
		max(case when n.kode_kriteria='K04' then n.nilai end) as 'K04',
		max(case when n.kode_kriteria='K05' then n.nilai end) as 'K05',
		max(case when n.kode_kriteria='K06' then n.nilai end) as 'K06'  
		FROM penilaian n, pelamar p  where n.kode_pelamar=p.kode_pelamar and p.jabatan = '$jb' GROUP BY p.kode_pelamar ORDER BY p.kode_pelamar DESC";
	}

	$output = '';
	$no = 0;
	$result = mysqli_query($conn, $query);

	if(mysqli_num_rows($result)>0){


		while($row = mysqli_fetch_array($result)){
			$no++;
			$output .='

			<tr>
			<td>'. $no .'</td>
			<td>'. $row["kode_pelamar"] .'</td>
			<td>'. $row["nama_pelamar"] .'</td>
			<td>'. $row["jabatan"] .'</td>
			<td>'. $row["tanggal_penilaian"] .'</td>
			<td>'. $row["K01"] .'</td>
			<td>'. $row["K02"] .'</td>
			<td>'. $row["K03"] .'</td>
			<td>'. $row["K04"] .'</td>
			<td>'. $row["K05"] .'</td>
			<td>'. $row["K06"] .'</td>
			<td>
			<a href="penilaian_form_edit.php?id='. $row["kode_pelamar"] .'" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a> 
			<a onclick="return confirm(`apakah anda akan menghapus?`)" href="penilaian_hapus.php?id='. $row["kode_pelamar"] .'" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a> 
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
