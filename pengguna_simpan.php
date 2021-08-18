 
<?php
include 'koneksi.php';
$kode_pengguna	= $_POST['kode_pelamar'];
$username	= $_POST['username'];
$sandi_pengguna	= $_POST['sandi_pengguna'];
$nama_pengguna	= $_POST['nama_pengguna'];
$sandi =  md5($sandi_pengguna);


mysqli_query($conn, "INSERT INTO ms_pengguna VALUES('$kode_pengguna','$username','$sandi','$nama_pengguna')");

header("location:pengguna.php");
?>