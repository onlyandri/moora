<?php include 'header.php';?>


<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Sistem Pendukung Keputusan</a>
      </li>
      <li class="breadcrumb-item active">detail kriteria adminsitrasi</li>
    </ol>

    

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-list-alt"></i>
      List detail administrasi</div>
      <div class="card-body">
       <div class="row">
        <div class="col-md-6">
         <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambah">
          <i class="fas fa-plus-circle"></i> &nbsp;Tambah Sub administrasi
        </button> 
      </div> 
    </div>
    <!--a href="kriteria_form.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>Tambah</a!-->
    <br/>&nbsp;
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Kode detail</th>
            <th>kode Kriteria</th>
            <th>nama detail administrasi</th>
            <th>Aksi</th>
          </tr>
        </thead>


        <tbody>
          <?php
          include 'koneksi.php';
          $id = $_GET['id'];

          $data=mysqli_query($conn,"SELECT * FROM detail_adm where id_kriteria = '$id'");

          while($d=mysqli_fetch_array($data)){
            ?>

            <tr>
              <td><?php echo $d['id_detail']; ?></td>
              <td><?php echo $d['id_kriteria']; ?></td>
              <td><?php echo $d['nama_detail']; ?></td>
              <td>
                <a href="hapus_sub_adm.php?id=<?php echo $d['id_detail'];?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a> 
                <!--a onclick="return confirm('apakah anda akan menghapus?')" href="kriteria_delete.php?id=<?php echo $d['kode_kriteria'];?>" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a!--> 
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


<div class="modal fade" id="modalTambah">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="tambah_adm.php">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Status Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nama Kriteria Detail Administrasi</label>
          <input type="text" name="nama_detail" class="form-control" placeholder="Nama detail" required>
        </div>
      </div>
      <div class="modal-footer text-right">
        <button type="submit" class="btn btn-info">Tambah</button> 
      </div>
    </form>
  </div>
</div>


<?php include 'footer.php';?>
