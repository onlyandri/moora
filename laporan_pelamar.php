<?php include 'header.php';?>


<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Sistem Pendukung Keputusan</a>
      </li>
      <li class="breadcrumb-item active">Data Pelamar</li>
    </ol>
    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-address-book"></i>
      Laporan Data Pelamar</div>
      <div class="container mt-5 mx-auto">
       <div class="card-body mx-auto">
        <form method="POST" action="pelamar_cetak.php" class="form-inline mt-3">
         <label for="tanggal_mulai" class="mr-2">Tanggal mulai </label>
         <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control mr-2">
         <label for="tanggal_akhir" class="mr-2">sampai </label>
         <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control mr-2">
         <script src="assets/vendor/jquery/jquery.min.js"></script>
         <script type="text/javascript">

          $(function(){


            $(".datepicker").datepicker({
              format: 'dd-mm-yyyy',
              autoclose: true,
              todayHighlight: false,
            });


            $("#tanggal_mulai").on('changeDate', function(selected) {
              var startDate = new Date(selected.date.valueOf());
              $("#tanggal_akhir").datepicker('setStartDate', startDate);
              if($("#tanggal_mulai").val() > $("#tanggal_akhir").val()){
                $("#tanggal_akhir").val($("#tanggal_mulai").val());
              }
            });

          }); 

        </script>
        <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-print"></i> Export To PDF</button>
      </form>
      <br/>&nbsp;
      <br/>&nbsp;

      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable">
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
          <tbody id="tbl">

            <?php

            include "koneksi.php";

            $sql="select * from pelamar order by kode_pelamar asc";

            $hasil=mysqli_query($conn,$sql);
            $no=0;
            while ($data = mysqli_fetch_array($hasil)) {
              $no++;
              ?>

              <tr>
                <td><?php echo $data['nama_pelamar']; ?></td>
                <td><?php echo date('d-m-Y', strtotime($data["tanggal_masuk"]));  ?></td>
                <td><?php echo $data['jabatan']; ?></td>
                <td><?php echo $data['jenis_kelamin']; ?></td>
                <td><?php echo date('d-m-Y', strtotime($data["tanggal_lahir"]));  ?></td>
                <td><?php echo $data['status_perkawinan']; ?></td>
                <td><?php echo $data['no_hp']; ?></td>
                <td><?php echo $data['alamat']; ?></td>
                <td><?php echo $data['pendidikan']; ?></td>
                <td><?php echo $data['tahun_lulus']; ?></td> 
                <td><?php echo $data['nilai_ipk']; ?></td>    
                <td><?php echo $data['pengalaman']; ?></td>             
                
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
</div>


<?php include 'footer.php';?>
