<?php
include 'koneksi.php';

$id=$_GET['id'];


mysqli_query($conn,"DELETE FROM penilaian where kode_pelamar='$id'");
mysqli_query($conn,"DELETE FROM penilaian_adm where kode_pelamar='$id'");

header("location:penilaian_adm.php");
?>