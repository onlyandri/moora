<?php

require('koneksi.php');
require ('header.php');
?>



<div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">SISTEM PENDUKUNG KEPUTUSAN</a>
          </li>
          <li class="breadcrumb-item active">Penilaian</li>
        </ol>

      
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-list-alt"></i>
            Form Edit Penilaian
            <?php
                include 'koneksi.php';
                $data=mysqli_query($conn,"SELECT p.kode_pelamar, p.nama_pelamar, n.kode_kriteria, n.nilai,
                    FROM penilaian n LEFT JOIN pelamar p ON n.kode_pelamar=p.kode_pelamar where p.kode_pelamar='".$kode_pelamar."' GROUP BY n.kode_kriteria");
                while($d = mysqli_fetch_assoc($data) ){
                  $nama_pelamar = $d['nama_pelamar'];
                }
                
                ?>                  
          <div class="card-body">
            <div class="table-responsive">
              <form method="POST" action="penilaian_ubah.php">
               <div class ="form-group">
                    <label for="kode_pelamar">Kode Pelamar</label>
                    <input type="text" value="<?= $nama_pelamar;?>" disabled="disabled" class="form-control"/>
                    <input type="hidden" name="kode_pelamar" value="<?= $kode_pelamar;?>">
                </div>
          </div>
          <div class="card-body">
      <?php
      $sql="SELECT * FROM kriteria k LEFT JOIN penilaian p ON p.kode_kriteria=k.kode_kriteria WHERE kode_pelamar='".$_GET['id']."'";
      $result=mysqli_query($conn,$sql);
      while($data = mysqli_fetch_assoc($result) ){
      ?>
      <div class ="form-group">
        <label for="administrasi"><?= $data['nama_kriteria'];?></label>
        <input type="hidden" name="id[]" value="<?= $data['kode_kriteria'];?>">
        <select name="jawaban_<?= $data['kode_kriteria'];?>" id="jawaban_<?= $data['kode_kriteria'];?>" class="form-control">
          <?php for($i=1; $i <= 10; $i++){ ?>
            <option value="<?= $i; ?>" <?= $i == $data['nilai'] ? 'selected' : '';?>><?= $i;?></option>
            <?php } ?>
        </select>
      </div>
      <?php
    }
    ?>
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
      <button type="submit" class="btn btn-danger value="<?php echo 'pengguna.php';?>">Batal</button>
      </form>
      
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

      </div>
      <!-- /.container-fluid -->
<?php include 'footer.php';?>