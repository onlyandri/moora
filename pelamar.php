<?php include 'header.php';?>
<?php include 'koneksi.php';?>


<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs--> 
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Sistem Pendukung Keputusan</a>
      </li>
      <li class="breadcrumb-item active">Data Pelamar</li>
    </ol>

    

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-address-book"></i>
      List Pelamar</div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <a href="pelamar_form.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>Tambah</a>
            <a href="laporan_pelamar.php" class="btn btn-primary btn-sm"><i class="fas fa-address-book"></i>Laporan</a>
          </div>     
          <div class="col-md-6">
            <?php $result = mysqli_query($conn,"SELECT jabatan from pelamar group by jabatan"); ?>
            <select class="form-control select2" style="width: 100%;" name="jbt" id="jbt" required>
              <option value="t">-- pilih jabatan --</option>
              <?php while($row = mysqli_fetch_assoc($result)) : ?>
                <option value="<?php echo $row['jabatan'] ?>"><?php echo $row['jabatan'] ?></option>
              <?php endwhile ?>
            </select>
          </div>
          <br/>&nbsp;
        </div>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable">
            <thead>
              <tr>
                <th>Nama Pelamar</th>
                <th>Tanggal Masuk</th>
                <th>Jabatan</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Status Perkawinan</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Pendidikan</th>
                <th>Tahun Lulus</th>
                <th>Nilai/IPK</th>
                <th>Pengalaman</th>
                <th>Aksi</th>
              </tr>
            </thead>


            <tbody id="tbl">
              <?php
              include 'koneksi.php';
              $data=mysqli_query($conn,"SELECT*FROM pelamar");
              
              while($d=mysqli_fetch_array($data)){
                ?>

                <tr>
                  <td><?php echo $d['nama_pelamar']; ?></td>
                  <td><?php echo date('d-m-Y', strtotime($d["tanggal_masuk"]));  ?></td>
                  <td><?php echo $d['jabatan']; ?></td>
                  <td><?php echo $d['jenis_kelamin']; ?></td>
                  <td><?php echo date('d-m-Y', strtotime($d["tanggal_lahir"]));  ?></td>
                  <td><?php echo $d['status_perkawinan']; ?></td>
                  <td><?php echo $d['no_hp']; ?></td>
                  <td><?php echo $d['alamat']; ?></td>
                  <td><?php echo $d['pendidikan']; ?></td>
                  <td><?php echo $d['tahun_lulus']; ?></td> 
                  <td><?php echo $d['nilai_ipk']; ?></td>    
                  <td><?php echo $d['pengalaman']; ?></td>             
                  <td>
                    <a href="pelamar_form_edit.php?id=<?php echo $d['kode_pelamar'];?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a> 
                    <a onclick="return confirm('apakah anda akan menghapus?')" href="pelamar_delete.php?id=<?php echo $d['kode_pelamar'];?>" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a> 
                  </td>
                </tr>
                <?php  
              } 
              ?>


            </tbody>
          </table>

        </div>

      </div>

    </div>

  </div>
</div>


<?php include 'footer.php';?>
