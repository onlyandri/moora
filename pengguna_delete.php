<?php
include 'koneksi.php';

$id=$_GET['id'];


mysqli_query($conn,"DELETE FROM ms_pengguna where kode_pengguna='$id'");

header("location:pengguna.php");
?>