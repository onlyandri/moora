<?php include 'koneksi.php';
session_start(); ?>

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
      <h4>Sistem Pendukung Keputusan Perekrutan Karyawan Baru</h4>
      <h3 class="text-center">PT PISMATEX</h3>
    </div>
  </div>
  <div id="hsl">
    <?php

    $jbt = $_POST['hasil_jbt'];

    if ($jbt == 't') {
      # code...
      $qr = mysqli_query($conn, "SELECT * FROM pelamar group by jabatan order by jabatan asc");
    }else{
      $qr = mysqli_query($conn, "SELECT * FROM pelamar where jabatan = '$jbt' group by jabatan order by jabatan asc");
    }
    $juara = 'belum ada data';
    $nilaiHasil = '';
    while ($dt = mysqli_fetch_assoc($qr)) {
      $data=mysqli_query($conn,"SELECT p.kode_pelamar,p.nama_pelamar, p.jabatan, n.tanggal_penilaian,
        max(case when n.kode_kriteria='K01' then n.nilai end) as 'K01',
        max(case when n.kode_kriteria='K02' then n.nilai end) as 'K02',
        max(case when n.kode_kriteria='K03' then n.nilai end) as 'K03',
        max(case when n.kode_kriteria='K04' then n.nilai end) as 'K04',
        max(case when n.kode_kriteria='K05' then n.nilai end) as 'K05',
        max(case when n.kode_kriteria='K06' then n.nilai end) as 'K06'  
        FROM penilaian n, pelamar p  
        where n.kode_pelamar=p.kode_pelamar and p.jabatan = '".$dt['jabatan']."'
        GROUP BY p.kode_pelamar ORDER BY p.kode_pelamar DESC
        ");
      $matrik = $data->fetch_all(MYSQLI_ASSOC);
//print_r($matrik);

// ambil kriteria
      $data=mysqli_query($conn,"SELECT * FROM kriteria");
      $kriteria = $data->fetch_all(MYSQLI_ASSOC);
      $tmp = [];
      foreach ($kriteria as $key => $value) {
        $tmp[$value['kode_kriteria']] = $value;
      }
      $kriteria = $tmp;
//print_r($kriteria);

// menentukan pembagi tiap kriteria
      $data=mysqli_query($conn,"SELECT n.kode_kriteria, 
        SUM(n.nilai * n.nilai) as 'nilai'
        FROM penilaian n, pelamar p  
        where n.kode_pelamar=p.kode_pelamar 
        GROUP BY n.kode_kriteria
        ");
      $pembagi = $data->fetch_all(MYSQLI_ASSOC);
//print_r($pembagi);
      $tmp = $matrik;
      foreach ($pembagi as $key => $value) {
        foreach ($matrik as $key2 => $value2) {
          $tmp[$key2][$value['kode_kriteria']] = $value2[$value['kode_kriteria']] / $value['nilai'];
        }
      }
      $normalisasi = $tmp;
//print_r($normalisasi);

// normalisasi
      $tmp = $normalisasi;
      foreach ($kriteria as $key => $value) {
        foreach ($normalisasi as $key2 => $value2) {
          $tmp[$key2][$value['kode_kriteria']] = $value2[$value['kode_kriteria']] * $value['bobot'];
        }
      }
      $wij = $tmp;
      foreach ($wij as $key => $value) {
        $jml_benefit = 0;
        $jml_cost = 0;
        foreach ($kriteria as $key2 => $value2) {
          if($value2['jenis_kriteria'] == 'Benefit'){
            $jml_benefit += $value[$value2['kode_kriteria']];
          }

          if($value2['jenis_kriteria'] == 'Cost'){
            $jml_cost += $value[$value2['kode_kriteria']];
          }
        }
        $wij[$key]['MAX'] = $jml_benefit;
        $wij[$key]['MIN'] = $jml_cost;
        $wij[$key]['Y'] = $jml_benefit - $jml_cost;
        $wij[$key]['rank'] = 0;
      }


//print_r($wij);
// perankingan
      $index = 0;
      for($i = 1; $i <= count($wij); $i++){
        $max = 0;
        foreach($wij as $key => $value){
          if($max < $value['Y'] & $value['rank'] == '0'){
            $max = $value['Y'];
            $index = $key;
          }
        }
        $wij[$index]['rank'] = $i;
      }
      ?>

      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-user-circle"></i>
          Hasil Perhitungan Posisi Jabatan <?php echo $dt['jabatan'] ?></div>
          <div class="card-body">

        <!--   <a href="cetak_hasil.php" class="btn btn-danger btn-sm"><i class="fas fa-print"></i>Export To PDF</a>

          <br/>&nbsp; -->
          <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Kode Pelamar</th>
                  <th>Nama Pelamar</th>
                  <th>Jabatan</th>
                  <th>Tanggal Penilaian</th>
                  <th>Hasil</th> 
                  <th>Rangking</th>
                </tr>
              </thead>


              <tbody>
               <?php
                  // include 'koneksi.php';
                  // $data=mysqli_query($conn,"SELECT*FROM ms_hasilnilai");

                  // while($d=mysqli_fetch_array($data)){
               foreach($wij as $d){
                ?>
                <tr>
                  <td><?php echo $d['kode_pelamar']; ?></td>
                  <td><?php echo $d['nama_pelamar']; ?></td>
                  <td><?php echo $d['jabatan']; ?></td>
                  <td><?php echo $d['tanggal_penilaian']; ?></td>
                  <td><?php echo substr($d['Y'],0,4); ?></td>
                  <td><?php echo $d['rank']; ?></td>
                </tr>
            <?php } 
              ?>




            </tbody>
          </table>

           <?php foreach($wij as $d){

            if($d['rank'] == 1){ ?>

                   <p class = "font-weight-bold">Jadi Rekomendasi Perekrutan Karyawan Jabatan <?php echo $dt['jabatan'] ?> Jatuh Kepada <?php echo $d['nama_pelamar'] ?> Dengan Nilai <?php echo substr($d['Y'],0,4) ?></p>

              <?php  } 

         } ?>
        </div>

      </div>

    </div>

  <?php } ?>

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