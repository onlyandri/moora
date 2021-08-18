<?php
session_start();

$_SESSION['nama_pengguna'] = null;
unset($_SESSION['nama_pengguna']);
session_unset();

session_destroy();

header('location:index.php');

?>