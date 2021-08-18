
<?php
include 'koneksi.php';
$nama_detail	= $_POST['nama_detail'];
//$nilai	=$_POST['nilai'];
mysqli_query($conn, "INSERT INTO detail_adm VALUES('','K01','$nama_detail')");

header("location:detail_adm.php?id=K01");
?>