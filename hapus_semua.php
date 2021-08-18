<?php
include 'koneksi.php';

$id=$_GET['id'];


mysqli_query($conn,"DELETE FROM penilaian");
mysqli_query($conn,"DELETE FROM penilaian_adm");

header("location:penilaian_adm.php");
?>