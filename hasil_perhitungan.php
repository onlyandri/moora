<?php include 'header.php';?>
<?php include 'koneksi.php';?>


<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="admin.php">Sistem Pendukung Keputusan</a>
      </li>
      <li class="breadcrumb-item active">Hasil Perhitungan</li>
    </ol>

    <form action="cetak_hasil.php" method="POST">
     <div class="row">   
      <div class="col-md-6">
        <div class="form-group">
          <?php $result = mysqli_query($conn,"SELECT jabatan from pelamar group by jabatan"); ?>
          <select class="form-control select2" style="width: 100%;" name="hasil_jbt" id="hasil_jbt" required>
            <option value="t">--  Semua Jabatan --</option>
            <?php while($row = mysqli_fetch_assoc($result)) : ?>
              <option value="<?php echo $row['jabatan'] ?>"><?php echo $row['jabatan'] ?></option>
            <?php endwhile ?>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i>Cetak laporan</button>
      </div>
      <br/>&nbsp;
    </div>
  </form>



  <!-- DataTables Example -->

  <div id="hsl">
    <?php $qr = mysqli_query($conn, "SELECT * FROM pelamar group by jabatan order by jabatan asc");
    $juara = 'belum ada data';
    $nilaiHasil = 0;
    $no =0;
    while ($dt = mysqli_fetch_assoc($qr)) {
      $no++;
      $data=mysqli_query($conn,"SELECT p.kode_pelamar,p.nama_pelamar, p.jabatan, n.tanggal_penilaian,
        max(case when n.kode_kriteria='K01' then n.nilai end) as 'K01',
        max(case when n.kode_kriteria='K02' then n.nilai end) as 'K02',
        max(case when n.kode_kriteria='K03' then n.nilai end) as 'K03',
        max(case when n.kode_kriteria='K04' then n.nilai end) as 'K04',
        max(case when n.kode_kriteria='K05' then n.nilai end) as 'K05',
        max(case when n.kode_kriteria='K06' then n.nilai end) as 'K06'  
        FROM penilaian n, pelamar p  
        where n.kode_pelamar=p.kode_pelamar and p.jabatan = '".$dt['jabatan']."'
        GROUP BY p.kode_pelamar ORDER BY p.kode_pelamar asc
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


// menentukan pembagi tiap kriteria
      $data=mysqli_query($conn,"SELECT n.kode_kriteria, 
        SUM(n.nilai * n.nilai) as 'nilai'
        FROM penilaian n, pelamar p  
        where n.kode_pelamar=p.kode_pelamar and p.jabatan = '".$dt['jabatan']."'
        GROUP BY n.kode_kriteria
        ");
      $pembagi = $data->fetch_all(MYSQLI_ASSOC);
//print_r($pembagi);
      $tmp = $matrik;
      foreach ($pembagi as $key => $value) {
        foreach ($matrik as $key2 => $value2) {
          $tmp[$key2][$value['kode_kriteria']] = $value2[$value['kode_kriteria']] / sqrt($value['nilai']);

          // print_r(sqrt($value['nilai']).',');
        }
      }
      $normalisasi = $tmp;
// print_r($normalisasi);

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
          List Hasil Perhitungan Posisi Jabatan <?php echo $dt['jabatan'] ?></div>
          <div class="card-body">

        <!--   <a href="cetak_hasil.php" class="btn btn-danger btn-sm"><i class="fas fa-print"></i>Export To PDF</a>

          <br/>&nbsp; -->
          <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0" id="domainsTable<?php echo $no ?>">
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

               // print_r($wij);
               foreach($wij as $d){
                ?>
                <tr>
                  <td><?php echo $d['kode_pelamar']; ?></td>
                  <td><?php echo $d['nama_pelamar']; ?></td>
                  <td><?php echo $d['jabatan']; ?></td>
                  <td><?php echo $d['tanggal_penilaian']; ?></td>
                  <td><?php  echo $d['Y']; ?></td>
                  <td><?php echo $d['rank']; ?></td>
                </tr>
                <?php 
              } 
              ?>




            </tbody>
          </table>

          <?php foreach($wij as $d){

            if($d['rank'] == 1){ ?>

             <p class = "font-weight-bold">Jadi Rekomendasi Perekrutan Karyawan Jabatan <?php echo $dt['jabatan'] ?> Jatuh Kepada <?php echo $d['nama_pelamar'] ?> Dengan Nilai <?php echo substr($d['Y'],0,4) ?></p>

           <?php  } 

         };

         ?>

       </div>

     </div>

   </div>

 <?php } ?>


 <?php 

 $arr = [1,0,2,3,0,4,5,0];

 for($i=0;$i< count($arr);$i++){
  if($arr[$i] == 0){

    for($j = count($arr) - 1; $j > $i ; $j--){
      $arr[$j] = $arr[$j-1];

    }
    $i++;
  }
}

$nums1 = [1,2,3,0,0,0];
$m = 3;
$n = 3;
$nums2 = [2,5,6];

   while($m > 0 && $n > 0){
            
            if($nums1[$m-1] > $nums2[$n-1]){
                $nums1[$m+$n -1] = $nums1[$m-1];
                    $m--;
            }else{
                $nums1[$m+$n-1] = $nums2[$n-1];
                $n--;
            }
        }

        //  while($n>0){
        //     $nums1[$m+$n - 1] = $nums2[$n-1];
        //     $n--;
        // }

        var_dump($nums1);


?>

</div>

</div>
</div>
<script>

</script>
<?php include 'footer.php';?>



<!-- proses hitung -->


