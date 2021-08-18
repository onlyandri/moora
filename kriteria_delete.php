<?php
include 'koneksi.php';

$id=$_GET['id'];


mysqli_query($conn,"DELETE FROM kriteria where kode_kriteria='$id'");

header("location:kriteria.php");
?>