
<?php
include 'koneksi.php';
$tanggal_penilaian			=$_POST['tanggal_penilaian'];
$kode_pelamar				=$_POST['kode_pelamar'];
$kode_kriteria 				=$_POST['id'];

//query update
foreach ($kode_kriteria as $key => $value) {
	$query = mysqli_query($conn,"INSERT INTO `penilaian` (`tanggal_penilaian`,`kode_pelamar`, `kode_kriteria`, `nilai`) VALUES ('$tanggal_penilaian','$kode_pelamar', '$value', '".$_POST['jawaban_'.$value]."')");
}

header('Location:penilaian.php');
?>