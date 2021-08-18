
<?php
include 'koneksi.php';
$kode_kriteria	=$_POST['kode_kriteria'];
$nama_kriteria	=$_POST['nama_kriteria'];
$bobot	=$_POST['bobot'];
$jenis_kriteria	=$_POST['jenis_kriteria'];

mysqli_query($conn, "INSERT INTO kriteria VALUES('$kode_kriteria','$nama_kriteria','$bobot','$jenis_kriteria')");

header("location:kriteria.php");
?>