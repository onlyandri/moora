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
      <li class="breadcrumb-item active">Form Edit Kriteria</li>
    </ol>

    <!-- Form Edit pengguna -->
    <div class="card mb-3">
      <div class="card-header">
        Form Edit Kriteria
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

            <?php
            include 'koneksi.php';

            $id = $_GET['id'];

            $data = mysqli_query($conn, "SELECT * FROM kriteria WHERE kode_kriteria='$id'");

            while($d=mysqli_fetch_array($data)){
              ?>

              <form method="POST" action="kriteria_ubah.php">

                <div class="form-group">
                  <input type="" class="form-control" name="id" readonly="kode_kriteria" value="<?php echo $d['kode_kriteria']; ?>">
                </div>

                <div class="form-group">
                  <label for="nama_kriteria">Nama Kriteria</label>
                  <input type="text" class="form-control" name="nama_kriteria" value="<?php echo $d['nama_kriteria'];?>">
                </div>
                <div class="form-group">
                  <label for="bobot">Bobot Kriteria</label>
                  <input type="text" class="form-control" name="bobot" value="<?php echo $d['bobot'];?>">
                </div>
                <div class="form-group">
                  <label for="jenis_kriteria">Jenis Kriteria</label>
                  <select class="form-control" name="jenis_kriteria">
                    <option value="<?php echo $d['jenis_kriteria'];?>"><?php echo $d['jenis_kriteria'];?></option>
                    <option value="Benefit">Benefit</option>
                    <option value="Cost">Cost</option>
                  </select>
                </div>


                <div class="float-left">     
                  <button type="submit" class="btn btn-success">Update</button>
                  <button type="submit" class="btn btn-danger value="<?php echo 'pengguna.php';?>">Batal</button>
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