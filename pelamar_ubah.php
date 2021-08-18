<?php
include 'koneksi.php';

$id= $_POST['id'];
$nama_pelamar = $_POST['nama_pelamar'];
$tanggal_masuk = $_POST['tanggal_masuk'];
$jabatan = $_POST['jabatan'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$status_perkawinan = $_POST['status_perkawinan'];
$no_hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];
$pendidikan = $_POST['pendidikan'];
$tahun_lulus = $_POST['tahun_lulus'];
$nilai_ipk = $_POST['nilai_ipk'];
$pengalaman = $_POST['pengalaman'];

//update data
mysqli_query($conn,"UPDATE pelamar SET nama_pelamar='$nama_pelamar',tanggal_masuk='$tanggal_masuk',jabatan='$jabatan',jenis_kelamin='$jenis_kelamin',tanggal_lahir='$tanggal_lahir',status_perkawinan='$status_perkawinan',no_hp='$no_hp',alamat='$alamat',pendidikan='$pendidikan',tahun_lulus='$tahun_lulus',nilai_ipk='$nilai_ipk' where kode_pelamar='$id'");

header("location:pelamar.php");

?>
