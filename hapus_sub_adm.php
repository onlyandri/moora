<?php 
include 'koneksi.php';
$id = $_GET['id'];
//$nilai	=$_POST['nilai'];
mysqli_query($conn, "DELETE FROM detail_adm WHERE id_detail = $id");

header("location:detail_adm.php?id=K01");

 ?>