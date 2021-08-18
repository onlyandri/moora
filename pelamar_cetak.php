<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>    
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin.css" rel="stylesheet">
  <title>Sistem Pendukung Keputusan PT Pismatex</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center" style="margin:50px; ">
        <h4>DATA PELAMAR KARYAWAN BARU</h4>
        <h3 class="text-center">PT PISMATEX</h3>
      </div>
    </div>
    <div id="hsl">

      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-user-circle"></i>
        Data Pelamar</div>
        <div class="card-body">

        <!--   <a href="cetak_hasil.php" class="btn btn-danger btn-sm"><i class="fas fa-print"></i>Export To PDF</a>

          <br/>&nbsp; -->
          <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
             <thead>
              <tr>
                <th>Nama Pelamar</th>
                <th>Tanggal Masuk</th>
                <th>Jabatan</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Status Perkawinan</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Pendidikan</th>
                <th>Tahun Lulus</th>
                <th>Nilai/IPK</th>
                <th>Pengalaman</th>
              </tr>
            </thead>
            <tbody>
              <?php
              session_start();
              include "koneksi.php";
              $tgl_awal = $_POST['tanggal_mulai'];
              $tgl_akhir = $_POST['tanggal_akhir'];
              if ($tgl_awal != '' && $tgl_akhir != '') {

                $tgl_awal=date('Y-m-d', strtotime($_POST["tanggal_mulai"]));
                $tgl_akhir=date('Y-m-d', strtotime($_POST["tanggal_akhir"]));


                $sql="SELECT * from pelamar where tanggal_masuk between '".$tgl_awal."' and '".$tgl_akhir."' order by kode_pelamar asc";

              }else {
                $sql="select * from pelamar order by kode_pelamar asc";
              }

              $hasil=mysqli_query($conn,$sql);
              $no=0;
              while ($data = mysqli_fetch_array($hasil)) {
                $no++;
                ?>
                <tr>
                 <td><?=$data['nama_pelamar']?></td>
                 <td><?php echo date('d-m-Y', strtotime($data["tanggal_masuk"]));  ?></td>
                 <td><?=$data['jabatan']?></td>
                 <td><?=$data['jenis_kelamin']?></td>
                 <td><?php echo date('d-m-Y', strtotime($data["tanggal_lahir"]));  ?></td>
                 <td><?=$data['status_perkawinan']?></td>
                 <td><?=$data['no_hp']?></td>
                 <td><?=$data['alamat']?></td>
                 <td><?=$data['pendidikan']?></td>
                 <td><?=$data['tahun_lulus']?></td>
                 <td><?=$data['nilai_ipk']?></td>
                 <td><?=$data['pengalaman']?></td>
               </tr>
               <?php
             }
             ?>
           </tbody>
         </table>
       </div>

     </div>

   </div>

 </div>
 <div class="row mt-5">
  <div class="col-md-8">

  </div>
  <div class="col-md-4" style="bottom:20%;">
    <P>BATANG, <?=date('d M Y')?></P>
    <P>HRD PT.PISMATEX</P>
    <P>&nbsp</P>
    <p class="mt-5"><?php echo $_SESSION['nama_pengguna'] ?></p>
  </div>
</div>
</div>
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="assets/sweet-alert/sweet-alert.min.js"></script>
<script src="assets/sweet-alert/sweet-alert.init.js"></script>

<!-- Page level plugin JavaScript-->
<script src="assets/vendor/chart.js/Chart.min.js"></script>
<script src="assets/vendor/datatables/jquery.dataTables.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="assets/js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<script src="assets/js/demo/datatables-demo.js"></script>
<script src="assets/js/demo/chart-bar-demo.js"></script>
<script type="text/javascript">

 $(document).ready(function(){

   window.print();

 })

 window.onafterprint = function(){window.history.back()}
</script>
</body>
</html>