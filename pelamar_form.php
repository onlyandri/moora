<?php

require('koneksi.php');
require ('header.php');


//$sql="SELECT*FROM pelamar";
//$result=$conn->query($sql);

$query_tambah ="SELECT max(kode_pelamar) as idMaks FROM pelamar";
$hasil = mysqli_query($conn,$query_tambah);
$data = mysqli_fetch_array($hasil);
$nim = $data['idMaks'];

$noUrut = (int) substr($nim, 2, 3);
$noUrut++;

$char = "P";

$IDbaru = $char . sprintf("%03s", $noUrut);

?>



<div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Sistem Pendukung Keputusan</a>
          </li>
          <li class="breadcrumb-item active">Pelamar</li>
        </ol>

      
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-address-book"></i>
            Form Data Pelamar</div>
          <div class="card-body">
      <form action="pelamar_simpan.php" method="POST">
      <div class ="form-grup">
      <label for="kode_pelamar">Kode Pelamar</label>
      <input type="text" class="form-control" name="kode_pelamar" value="<?php echo $IDbaru;?>" readonly> 
      </div>
      <div class="form-grup">
      <label for="nama_pelamar">Nama Pelamar</label>
      <input type="text" class="form-control" placeholder="Masukan Nama Anda" required="required" id="nama_pelamar" name="nama_pelamar">
      </div>
      <div class="form-grup">
      <label for="tanggal_masuk">Tanggal Masuk</label>
      <input type="date" class="form-control" placeholder="" id="tanggal_masuk" required="required" name="tanggal_masuk">
      </div>
      <div class="form-grup">
      <label for="jabatan">Jabatan</label>
      <select class="form-control" name="jabatan" id="jabatan" required="required">
      <option>---Jabatan yang dilamar--</option>
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
      <div class="form-grup">
      <label for="tanggal_lahir">Tanggal Lahir</label>
      <input type="date" class="form-control" placeholder="Masukan Tanggal Lahir Anda" required="required" id="tanggal_lahir" name="tanggal_lahir">
      </div>
      <div class="form-grup">
      <label for="status_perkawinan">Status Perkawinan</label>
      <input type="text" class="form-control" placeholder="Status Perkawinan" required="required" id="status_perkawinan" name="status_perkawinan">
      </div>
      <div class="form-grup">
      <label for="no_hp">Nomor HP</label>
      <input type="text" class="form-control" placeholder="Masukan Nomor HP" required="required" id="no_hp" name="no_hp">
      </div>
      <div class="form-grup">
      <label for="alamat">Alamat</label>
      <input type="textarea" class="form-control" placeholder="Masukan Alamat Anda" required="required" id="alamat" name="alamat">
      </div>
      <div class="form-grup">
      <label for="pendidikan">Pendidikan</label>
      <input type="text" class="form-control" placeholder="Pendidikan Anda" required="required" id="pendidikan" name="pendidikan">
      </div>
      <div class="form-grup">
      <label for="tahun_lulus">Tahun Lulus</label>
      <input type="number" class="form-control" placeholder="Tahun Lulus" required="required" id="tahun_lulus" name="tahun_lulus">
      </div>
      <div class="form-grup">
      <label for="nilai_ipk">Nilai/IPK</label>
      <input type="text" class="form-control" placeholder="Masukan Nilai/IPK Anda" required="required" id="nilai_ipk" name="nilai_ipk">
      </div>
      <div class="form-grup">
      <label for="pengalaman">Pengalaman</label>
      <input type="number" class="form-control" placeholder="Pengalaman Bekerja" required="required" id="pengalaman" name="pengalaman">
      </div>
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
      </form>
      
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->
<?php include 'footer.php';?>