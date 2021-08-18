<?php

require('koneksi.php');
require ('header.php');


$query_tambah ="SELECT max(kode_pengguna) as idMaks FROM ms_pengguna";
$hasil = mysqli_query($conn,$query_tambah);
$data = mysqli_fetch_array($hasil);
$nim = $data['idMaks'];

$noUrut = (int) substr($nim, 3, 4);
$noUrut++;

$char = "HRD";

$IDbaru = $char . sprintf("%03s", $noUrut);
?>



<div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Sistem Pendukung Keputusan</a>
          </li>
          <li class="breadcrumb-item active">Pengguna</li>
        </ol>

      
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-user-circle"></i>
            Form Data Pengguna</div>
          <div class="card-body">
		  <form action="pengguna_simpan.php" method="POST">
		  <div class ="form-grup">
		  <label for="kode_pelamar">NIK</label> 
      <input type="text" class="form-control" name="kode_pelamar" value="<?php echo $IDbaru;?>" readonly> 
		  </div>
      <div class="form-grup">
      <label for="Username">Username</label>
      <input type="text" class="form-control" placeholder="Masukan Username anda" required="required" id="username" name="username">
      </div>
		  <div class="form-grup">
		  <label for="sandi_pengguna">Sandi Pengguna</label>
		  <input type="text" class="form-control" placeholder="Masukan Sandi" required="required" id="sandi_pengguna" name="sandi_pengguna">
		  </div>
      <div class="form-grup">
      <label for="nama_pengguna">Nama HRD</label>
      <input type="text" class="form-control" placeholder="Masukan Nama Pengguna" required="required" id="nama_pengguna" name="nama_pengguna">
      </div>
		  <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
		  </form>
		  
          </div>
          
        </div>

      </div>
      <!-- /.container-fluid -->
<?php include 'footer.php';?>