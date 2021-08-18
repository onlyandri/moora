<?php
include 'koneksi.php';

$id= $_POST['id'];
$username = $_POST['username'];
$sandi_pengguna = md5($_POST['sandi_pengguna']);
$nama_pengguna = $_POST['nama_pengguna'];


//update data
mysqli_query($conn,"UPDATE ms_pengguna SET username='$username',sandi_pengguna='$sandi_pengguna',nama_pengguna='$nama_pengguna' where kode_pengguna='$id'");

header("location:pengguna.php");

?>
