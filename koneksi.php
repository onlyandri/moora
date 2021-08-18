<?php

//siapkan variabel untuk koneksi ke database server 
$servername = "localhost";
$username_db="root";
$password_db ="";
$database_name="pw2_5p52";

//buat koneksi ke server database
$conn = new mysqli($servername, $username_db, $password_db, $database_name);

//periksa koneksi 
if($conn->connect_error){
	die("Koneksi Gagal:".$conn->connect_error);
	}
?>