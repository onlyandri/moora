<?php
include 'koneksi.php';

$id= $_POST['id'];
$nama_kriteria = $_POST['nama_kriteria'];
$bobot = $_POST['bobot'];
$jenis_kriteria = $_POST['jenis_kriteria'];

//update data
mysqli_query($conn,"UPDATE kriteria SET nama_kriteria='$nama_kriteria',bobot='$bobot',jenis_kriteria='$jenis_kriteria' where kode_kriteria='$id'");

header("location:kriteria.php");

?>
