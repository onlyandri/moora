<?php

require('koneksi.php');
require ('header.php');

$sql="SELECT * FROM pelamar ORDER BY kode_pelamar DESC";
$result=mysqli_query($conn,$sql);
?>



<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Perekrutan Penilaian</a>
    </li>
    <li class="breadcrumb-item active"> Penilaian </li>
  </ol>


  <!-- DataTables Example -->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>
    Form Data Penilaian</div>
    <div class="card-body">
      <form action="penilaian_simpan.php" method="POST">
        <div class ="form-group">
          <label for="kode_pelamar">Kode Pelamar</label>
          <select class="form-control" name="kode_pelamar" id="kode_pelamar">
           <?php while($data = mysqli_fetch_assoc($result) ){?>
             <option value="<?=$data['kode_pelamar'];?>"><?= $data['kode_pelamar']; ?> - <?= $data['nama_pelamar']; ?>  - <?= $data['jabatan']; ?></option>
           <?php } ?>
         </select>
       </div>
       <div class="form-grup">
        <label for="tanggal_penilaian">Tanggal Penilaian</label>
        <input type="date" class="form-control" id="tanggal_penilaian" required="required" name="tanggal_penilaian">
      </div>
      <?php
      $sql="SELECT * FROM kriteria ";
      $result=mysqli_query($conn,$sql);
      while($data = mysqli_fetch_assoc($result) ){
        ?>
        <div class ="form-group">
          <label for="administrasi"><?= $data['nama_kriteria'];?></label>
          <input type="hidden" name="id[]" value="<?= $data['kode_kriteria'];?>">
          <select name="jawaban_<?= $data['kode_kriteria'];?>" id="jawaban_<?= $data['kode_kriteria'];?>" class="form-control">
            <?php for($i=1; $i <= 10; $i++){ ?>
              <option value="<?= $i; ?>"><?= $i;?></option>
            <?php } ?>
          </select>
        </div>
        <?php
      }
      ?>
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
    </form>

  </div>
</div>

</div>