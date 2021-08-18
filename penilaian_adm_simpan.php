
<?php
include 'koneksi.php';
$tanggal_penilaian			=$_POST['tanggal_penilaian'];
$kode_pelamar				=$_POST['kode_pelamar'];
$id_detail 				=$_POST['id'];

//query update
foreach ($id_detail as $key => $value) {
	$query = mysqli_query($conn,"INSERT INTO `penilaian_adm` (`kode_pelamar`,`id_detail`, `nilai`, `tanggal_adm`) VALUES ('$kode_pelamar', '$value', '".$_POST['jawaban_'.$value]."','$tanggal_penilaian')");
}

$query1 = mysqli_query($conn,"SELECT SUM(nilai) as jumlah from penilaian_adm where kode_pelamar = '$kode_pelamar'");
$query2 = mysqli_query($conn, "SELECT count(id_detail) as bagi from detail_adm");

while($data = mysqli_fetch_assoc($query1) ){
	$jumlah = $data['jumlah'];
}

while($data = mysqli_fetch_assoc($query2) ){
	$pembagi = $data['bagi'];
}
$hasil = $jumlah / $pembagi;

$query3 = mysqli_query($conn,"SELECT * from kriteria");

while ($data = mysqli_fetch_assoc($query3)) {
	if($data['kode_kriteria'] == 'K01'){
		$query = mysqli_query($conn,"INSERT INTO `penilaian` (`tanggal_penilaian`,`kode_pelamar`, `kode_kriteria`, `nilai`) VALUES ('$tanggal_penilaian','$kode_pelamar', 'K01', $hasil)");
	}else{
		$query = mysqli_query($conn,"INSERT INTO `penilaian` (`tanggal_penilaian`,`kode_pelamar`, `kode_kriteria`, `nilai`) VALUES ('$tanggal_penilaian','$kode_pelamar', '".$data['kode_kriteria']."', 1)");
	}
}

header('Location:penilaian_adm.php');
?>