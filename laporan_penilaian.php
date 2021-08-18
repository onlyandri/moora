<?php include 'header.php';?>


<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Sistem Pendukung Keputusan</a>
      </li>
      <li class="breadcrumb-item active">Data Hasil Perhitungan</li>
    </ol>

    
    
    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-address-book"></i>
      List Data Hasil Perhitungan</div>
      <div class="container mt-5 mx-auto">
       <div class="card-body mx-auto">
        <form method="POST" action="" class="form-inline mt-3">
         <label for="tanggal_mulai">Tanggal mulai </label>
         <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control mr-2">
         <label for="tanggal_akhir">sampai </label>
         <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control mr-2">
         <button type="submit" name="submit" class="btn btn-primary">Cari</button>
       </form>
       <br/>&nbsp;
       <a href="cetak_hasil.php" class="btn btn-primary btn-sm"><i class="fas fa-print"></i>Export To PDF</a>
       <br/>&nbsp;
       <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                  //foreach($wij as $d){
           ?>
           <tr>
            <td><?php echo $d['kode_pelamar']; ?></td>
            <td><?php echo $d['nama_pelamar']; ?></td>
            <td><?php echo $d['jabatan']; ?></td>
            <td><?php echo $d['tanggal_penilaian']; ?></td>
            <td><?php echo $d['Y']; ?></td>
            <td><?php echo $d['rank']; ?></td>
          </tr>
          <?php  
                      //} 
          ?>
          
          
          
          
        </tbody>
      </table>
      
    </div>
    
  </div>
  
</div>

</div>
</div>


<?php include 'footer.php';?>

