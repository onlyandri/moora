<?php
include 'header.php';
?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Sistem Pendukung Keputusan</a>
          </li>
          <li class="breadcrumb-item active">Form Edit Pengguna</li>
        </ol>

        <!-- Form Edit pengguna -->
        <div class="card mb-3">
          <div class="card-header">
            Form Edit pengguna
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <?php
                include 'koneksi.php';

                $id = $_GET['id'];

                $data = mysqli_query($conn, "SELECT * FROM ms_pengguna WHERE kode_pengguna='$id'");

                while($d=mysqli_fetch_array($data)){
                  ?>
                
                  <form method="POST" action="pengguna_ubah.php">
                
                      <div class="form-group">
                        <input type="hidden" class="form-control" name="id" readonly="kode_pengguna" value="<?php echo $d['kode_pengguna']; ?>">
                      </div>

                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $d['username'];?>">

                      <div class="form-group">
                        <label for="sandi_pengguna">Sandi Pengguna</label>
                        <input type="text" class="form-control" placeholder="masukan sandi baru" name="sandi_pengguna" value="" required="">
                      </div>
                       <div class="form-group">
                        <label for="nama_pengguna">Nama Pengguna</label>
                        <input type="text" class="form-control" name="nama_pengguna" value="<?php echo $d['nama_pengguna'];?>">
                      </div>


                    
                      <div class="float-left">     
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a type="button" href="admin.php" class="btn btn-danger">Batal</a>
                      </div>
          
                      </form>

                      <?php
                    }
                    ?>
                        
           </table>
            </div>
          </div>
       

        </div>

 <?php include "footer.php"?>