
<?php
include 'koneksi.php';
$tanggal_penilaian			=$_POST['tanggal_penilaian'];
$kode_pelamar				=$_POST['kode_pelamar'];
$kode_kriteria 				=$_POST['id'];

//query update
//foreach ($kode_kriteria as $key => $value) {
	//$query = mysqli_query($conn,"UPDATE `penilaian` (`kode_pelamar`, `kode_kriteria`, `nilai`) VALUES ('$kode_pelamar', '$value', '".$_POST['jawaban_'.$value]."')");}

//query update
/*foreach ($kode_kriteria as $key => $value) {
		$query = mysqli_query($conn,"UPDATE penilaian SET tanggal_penilaian='tanggal_penilaian',kode_pelamar='kode_pelamar',kode_kriteria='kode_kriteria','value','".$_POST['jawaban_'.$value]."' WHERE kode_pelamar='kode_pelamar'");*/

//HAPUS DATA LAMA

mysqli_query($conn,"DELETE FROM penilaian_adm where kode_pelamar='$kode_pelamar'");

//memasukan data baru
foreach ($kode_kriteria as $key => $value) {
	$query = mysqli_query($conn,"INSERT INTO `penilaian_adm` (`tanggal_adm`,`kode_pelamar`, `id_detail`, `nilai`) VALUES (NOW(),'$kode_pelamar', '$value', '".$_POST['jawaban_'.$value]."')");
}

header('Location:penilaian_adm.php');
?>