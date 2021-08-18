<?php

require('koneksi.php');
require ('header.php');

$idp = $_GET['id'];
$quer = mysqli_query($conn,"SELECT * FROM PELAMAR WHERE kode_pelamar = '$idp'");

while($data = mysqli_fetch_assoc($quer)){
  $nm = $data['nama_pelamar'];
};


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
      Form Edit Penilaian <?php echo $nm ?></div>
      <div class="card-body">
        <form action="penilaian_ubah.php" method="POST">
          <label for="administrasi">Nama Pelamar</label>
          <input type="text" value="<?= $nm ?>" class="form-control" readonly>
          <label for="administrasi">Kode Pelamar</label>
          <input type="text" name="kode_pelamar" value="<?= $_GET['id'];?>" class="form-control" readonly>
          <?php
          $sql="SELECT * FROM kriteria k LEFT JOIN penilaian p ON p.kode_kriteria=k.kode_kriteria WHERE kode_pelamar='".$_GET['id']."'";
          $result=mysqli_query($conn,$sql);
          while($data = mysqli_fetch_assoc($result) ){

            if($data['kode_kriteria'] == 'K01'){

              ?>
              <div class ="form-group">
                <label for="administrasi">Nilai <?= $data['nama_kriteria'];?></label>
                <input type="hidden" name="id[]" value="<?= $data['kode_kriteria'];?>">
                <input type="text" name="jawaban_<?= $data['kode_kriteria'];?>" id="jawaban_<?= $data['kode_kriteria'];?>" value="<?= $data['nilai'];?>" class="form-control" readonly>

              </div>
            <?php } else{
 
              ?>
              <div class ="form-group">
                <label for="administrasi">Nilai <?= $data['nama_kriteria'];?></label>
                <input type="hidden" name="id[]" value="<?= $data['kode_kriteria'];?>">
                <select name="jawaban_<?= $data['kode_kriteria'];?>" id="jawaban_<?= $data['kode_kriteria'];?>" class="form-control">
                  <?php for($i=0; $i <= 10; $i++){ ?>
                    <option value="<?= $i; ?>" <?= $i == $data['nilai'] ? 'selected' : '';?>><?= $i;?></option>
                  <?php } ?>
                </select>
              </div>
            <?php }
          }
          ?>
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
          <button type="submit" class="btn btn-danger value="<?php echo 'pengguna.php';?>">Batal</button>
        </form>

      </div>
    </div>

  </div>
  <!-- /.container-fluid -->
  <?php include 'footer.php';?>