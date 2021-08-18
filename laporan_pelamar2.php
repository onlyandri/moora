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
      List Pelamar</div>
      <div class="container mt-5 mx-auto">
       <div class="card-body mx-auto">
        <form method="POST" action="" class="form-inline mt-3">
         <label for="tanggal_mulai">Tanggal mulai </label>
         <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control mr-2">
         <label for="tanggal_akhir">sampai </label>
         <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control mr-2">

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
        <button type="submit" name="submit" class="btn btn-primary">Cari</button>
      </form>
      <br/>&nbsp;
      <a target="_blank" href="pelamar_cetak.php?tanggal_mulai=<?php echo $tanggal_mulai; ?>&tanggal_akhir=<?php
      echo $tanggal_akhir; ?>" class="btn btn-sm btn-danger"><i class="glyphicon
      glyphicon-print"></i> Export To PDF</a>
      <br/>&nbsp;
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable">
          <thead>
            <tr>
              <th>Nama Pelamar</th>
              <th>Tanggal Masuk</th>
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
          <?php