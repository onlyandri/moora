<?php include 'header.php';?>


<div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">SISTEM PENDUKUNG KEPUTUSAN PEREKRUTAN KARYAWAN METODE MOORA</a>
          </li>
          <li class="breadcrumb-item active">Input Nilai</li>
        </ol>

    
        
      <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Input Nilai</div>
          
      <div class="form-group">
              <label class="control-label col-lg-2">Kode Pelamar</label>
              <div class="col-lg-4">
                <select name="kode_pelamar" class="form-control">
                <?php
                include ("koneksi.php");
                $s=mysqli_query($conn,"select * from Pelamar");
                while($d=mysqli_fetch_assoc($s)){
                ?>
                
                  <option value="<?php echo $d['kode_pelamar'] ?>"><?php echo $d['kode_pelamar'] ?></option>
                <?php
                }
                ?>
                </select>
              
                
              </div>
              
            </div>
            <br />

            <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-address-book"></i>
            Form Input Nilai</div>
          <div class="card-body">
        <form action="kriteria.php" method="POST">
        <div class ="form-grup">
      <form action="kriteria_simpan.php" method="POST">
      <div class ="form-grup">
      <label for="administrasi">ADMINISTRASI</label>
      <input type="text" class="form-control"  id="administrasi" name="adminitrasi">
      </div>
      <div class="form-grup">
      <label for="kesehatan">KESEHATAN</label>
      <input type="text" class="form-control"  id="kesehatan" name="kesehatan">
      </div>
      <div class="form-grup">
      <label for="psikotest">PSIKOTEST</label>
      <input type="number" class="form-control"  id="psikotest" name="psikotest">
      </div>
      <div class="form-grup">
      <label for="technical_test">TECHNICAL TEST</label>
      <input type="text" class="form-control"  id="technical_test" name="technical_test">
      </div>
      <div class="form-grup">
      <label for="interview_user">INTERVIEW USER</label>
      <input type="text" class="form-control"  id="interview_user" name="interview_user">
      </div>
      <div class="form-grup">
      <label for="orientasi_kerja">ORIENASI KERJA</label>
      <input type="text" class="form-control"  id="jenis_kriteria" name="orientasi">
      </div>
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
      </form>
      
          </div>
        </div>

      </div>
      </br>
<?php include 'footer.php';?>
