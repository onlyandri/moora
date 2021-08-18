
<?php
include 'koneksi.php';
$kode_pelamar	=$_POST['kode_pelamar'];
$nama_pelamar	=$_POST['nama_pelamar'];
$tanggal_masuk	=$_POST['tanggal_masuk'];
$jabatan	=$_POST['jabatan'];
$no_ktp	=$_POST['no_ktp'];
$jenis_kelamin	=$_POST['jenis_kelamin'];
$tanggal_lahir	=$_POST['tanggal_lahir'];
$status_perkawinan	=$_POST['status_perkawinan'];
$agama	=$_POST['agama'];
$no_hp	=$_POST['no_hp'];
$alamat	=$_POST['alamat'];
$pendidikan	=$_POST['pendidikan'];
$tahun_lulus=$_POST['tahun_lulus'];
$nilai_ipk	=$_POST['nilai_ipk'];
$pengalaman	=$_POST['pengalaman'];


mysqli_query($conn, "INSERT INTO pelamar VALUES('$kode_pelamar','$nama_pelamar','$tanggal_masuk','$jabatan','$no_ktp','$jenis_kelamin','$tanggal_lahir','$status_perkawinan','$agama','$no_hp','$alamat','$pendidikan','$tahun_lulus','$nilai_ipk','$pengalaman')");

header("location:pelamar.php");
?>