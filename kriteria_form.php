<?php

require('koneksi.php');
require ('header.php');


$sql="SELECT*FROM kriteria";
$result=$conn->query($sql);
?>



<div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">SISTEM PENDUKUNG KEPUTUSAN</a>
          </li>
          <li class="breadcrumb-item active">Kriteria</li>
        </ol>

      
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-list-alt"></i>
            Form Kriteria</div>
          <div class="card-body">
      <form action="kriteria_simpan.php" method="POST">
      <div class ="form-grup">
      <label for="kode_kriteria">Kode Kriteria</label>
      <input type="text" class="form-control" placeholder="Masukan Kode Kriteria" id="kode_kriteria" name="kode_kriteria">
      </div>
      <div class="form-grup">
      <label for="nama_kriteria">Nama Kriteria</label>
      <input type="text" class="form-control" placeholder="Masukan Nama Kriteria" id="nama_kriteria" name="nama_kriteria">
      </div>
      <div class="form-grup">
      <label for="bobot">Bobot</label>
      <input type="number" class="form-control" placeholder="Tentukan Bobot Kriteria" id="bobot" name="bobot">
      </div>
       <div class="form-grup">
      <label for="jenis_kriteria">Jenis Kriteria</label>
      <input type="text" class="form-control" placeholder="Tentukan Jenis Kriteria" id="jenis_kriteria" name="jenis_kriteria">
      </div>
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
      </form>
      
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

      </div>
      <!-- /.container-fluid -->
<?php include 'footer.php';?>