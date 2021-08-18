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
          <li class="breadcrumb-item active">Form Edit Pelamar</li>
        </ol>

        <!-- Form Edit pelamar -->
        <div class="card mb-3">
          <div class="card-header">
            Form Edit Pelamar
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <?php
                include 'koneksi.php';

                $id = $_GET['id'];

                $data = mysqli_query($conn, "SELECT * FROM pelamar WHERE kode_pelamar='$id'");

                while($d=mysqli_fetch_array($data)){
                  ?>
                
                  <form method="POST" action="pelamar_ubah.php">
                
                      <div class="form-group">
                        <input type="text" class="form-control" name="id" readonly="kode_pelamar" value="<?php echo $d['kode_pelamar']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="nama_pelamar">Nama Pelamar</label>
                        <input type="text" class="form-control" name="nama_pelamar" value="<?php echo $d['nama_pelamar'];?>">
                      </div>
                      <div class="form-group">
                        <label for="tanggal_masuk">Tanggal Masuk</label>
                        <input type="date" class="form-control" name="tanggal_masuk" value="<?php echo $d['tanggal_masuk'];?>">
                      </div>
                        <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select class="form-control" name="jabatan" id="jabatan">
                        <option value="<?php echo $d['jabatan'];?>"><?php echo $d['jabatan'];?></option>
                        <option value="General Manager">General Manager</option>
                        <option value="Dept Head">Dept Head</option>
                        <option value="Sub Dept Head">Sub Dept Head</option>
                        <option value="Section Head">Section Head</option>
                        <option value="Grup Leader">Grup Leader</option>
                        <option value="Staff">Staff</option>
                        <option value="Admin">Admin</option>
                         <option value="Operator">Operator</option>
                         <option value="Help Desk">Help Desk</option>
                        </select>
                        </div>
                       <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                        <div class="form-check-inline">
                        <label class="form-check-label" for="radio1">
                        <input type="radio" class="form-check-input" id="radio1" name="jenis_kelamin" value="Laki-laki" checked> Laki - Laki
                        </label>
                         </div>
                         <div class="form-check-inline">
                        <label class="form-check-label" for="radio2">
                         <input type="radio" class="form-check-input" id="radio2" name="jenis_kelamin" value="Perempuan"> Perempuan
                        </label>
                       </div>
                        </div>
                           </div>
                       <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" value="<?php echo $d['tanggal_lahir'];?>">
                      </div>
                       <div class="form-group">
                        <label for="status_perkawinan">Status Perkawinan</label>
                        <input type="text" class="form-control" name="status_perkawinan" value="<?php echo $d['status_perkawinan'];?>">
                      </div>
                       <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" class="form-control" name="no_hp" value="<?php echo $d['no_hp'];?>">
                      </div>
                       <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="textarea" class="form-control" name="alamat" value="<?php echo $d['alamat'];?>">
                      </div>
                       <div class="form-group">
                        <label for="pendidikan">Pendidikan</label>
                        <input type="text" class="form-control" name="pendidikan" value="<?php echo $d['pendidikan'];?>">
                      </div>
                       <div class="form-group">
                        <label for="tahun_lulus">Tahun Lulus</label>
                        <input type="number" class="form-control" name="tahun_lulus" value="<?php echo $d['tahun_lulus'];?>">
                      </div>
                       <div class="form-group">
                        <label for="nilai_ipk">Nilai/IPK</label>
                        <input type="text" class="form-control" name="nilai_ipk" value="<?php echo $d['nilai_ipk'];?>">
                      </div>
                       <div class="form-group">
                        <label for="pengalaman">Pengalaman</label>
                        <input type="number" class="form-control" name="pengalaman" value="<?php echo $d['pengalaman'];?>">
                      </div>
                      <div class="float-left">     
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="submit" class="btn btn-danger value="<?php echo 'pelamar.php';?>">Batal</button>
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