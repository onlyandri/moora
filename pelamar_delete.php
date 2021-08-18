<?php
include 'koneksi.php';

$id=$_GET['id'];


mysqli_query($conn,"DELETE FROM pelamar where kode_pelamar='$id'");

header("location:pelamar.php");
?>