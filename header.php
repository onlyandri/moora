<?php  session_start();

if (!isset($_SESSION["nama_pengguna"])) { // jika ada

  header("location: index.php"); 
  exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SISTEM PENDUKUNG KEPUTUSAN PEREKRUTAN KARYAWAN PT.PISMATEX</title>
 <!-- <script type="text/javascript" src="assets/js/jquery-latest.js"></script> 
  <script type="text/javascript" src="assets/js/jquery.tablesorter.min.js"></script> -->
  <link rel="stylesheet" href="./themes/blue/style.css" type="text/css" media="print, projection, screen" />
  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="admin.php">SISTEM PENDUKUNG KEPUTUSAN PEREKRUTAN KARYAWAN PT. PISMATEX</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mr-5">
      
     </li>
     <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['nama_pengguna'] ?> 
        <i class="fas fa-user"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="Logout.php" data-toggle="modal" data-target="#logoutModal">Logout</a>
        <a class="dropdown-item" href="pengguna_form_edit.php?id=<?php echo $_SESSION['kode_pengguna'] ?>">Profile</a>
      </div>
    </li>
  </ul>

</nav>

<div id="wrapper">
  <!-- Sidebar -->
  <ul class="sidebar navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="admin.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pengguna.php">
        <i class="fas fa-user-circle"></i>
        <span>Data Pengguna</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pelamar.php">
          <i class="fas fa-address-book"></i>
          <span>Data Pelamar</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="kriteria.php">
            <i class="fas fa-list-alt"></i>
            <span>Kriteria</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="penilaian_adm.php">
              <i class="fas fa-book-open"></i>
              <span>Penilaian Administrasi</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="penilaian.php">
                <i class="fas fa-pencil-alt"></i>
                <span>Penilaian Keseluruhan</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="hasil_perhitungan.php">
                  <i class="fas fa-calculator"></i>
                  <span>Hasil Perhitungan</span></a>
                </li>
              </ul>






              <div id="content-wrapper">

                <div class="container-fluid">

                  <!-- Scroll to Top Button-->
                  <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                  </a>

                  <!-- Bootstrap core JavaScript-->
       <!--  <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      -->
      <!-- Core plugin JavaScript-->
      <!--  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script> -->

      <!-- Page level plugin JavaScript-->
       <!--  <script src="assets/vendor/chart.js/Chart.min.js"></script>
        <script src="assets/vendor/datatables/jquery.dataTables.js"></script>
        <script src="assets/vendor/datatables/dataTables.bootstrap4.js"></script> -->

        <!-- Custom scripts for all pages-->
        <!-- <script src="assets/js/sb-admin.min.js"></script> -->

        <!-- Demo scripts for this page-->
       <!--  <script src="assets/js/demo/datatables-demo.js"></script>
        <script src="assets/js/demo/chart-area-demo.js"></script> -->