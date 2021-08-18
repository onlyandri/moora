<?php
session_start();

require('koneksi.php');
	
//ambil data dari form login
$Username =$_POST['Username'];
$Password = md5($_POST["Password"]);

//cek username dan password pada tabel ms_pengguna
$sql= "SELECT * FROM ms_pengguna WHERE username='$Username' AND sandi_pengguna='$Password'";
$result = $conn->query($sql);

if ($result->num_rows > 0){
	$row = $result->fetch_assoc();
	//buat sesi
	$_SESSION['nama_pengguna']= $row['nama_pengguna'];
	$_SESSION['kode_pengguna']= $row['kode_pengguna'];
	header("Location:admin.php");
} else {

header("Location:index.php");
}
$conn->close();


?>