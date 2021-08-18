<?php include 'header.php';?>


<div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Sistem Pendukung Keputusan</a>
          </li>
          <li class="breadcrumb-item active">Kriteria</li>
        </ol>

    
        
      <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-list-alt"></i>
            List Kriteria</div>
          <div class="card-body">
      <!--a href="kriteria_form.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>Tambah</a!-->
      <br/>&nbsp;
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Kode Kriteria</th>
                    <th>Nama Kriteria</th>
                    <th>Bobot</th>
                    <th>Jenis Kriteria</th>
                    <th>Aksi</th>
                  </tr>
                </thead>

               
                <tbody>
                  <?php
                  include 'koneksi.php';
                  $data=mysqli_query($conn,"SELECT*FROM kriteria");
              
                  while($d=mysqli_fetch_array($data)){
                    ?>
                  
                  <tr>
                  <td><?php echo $d['kode_kriteria']; ?></td>
                  <td><?php echo $d['nama_kriteria']; ?></td>
                  <td><?php echo $d['bobot']; ?></td>
                  <td><?php echo $d['jenis_kriteria']; ?></td>
                  <td>
                    <?php if($d['kode_kriteria'] == 'K01') : ?>
                      <a href="detail_adm.php?id=<?php echo $d['kode_kriteria'];?>" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></a> 
                    <?php endif ?>
                    <a href="kriteria_form_edit.php?id=<?php echo $d['kode_kriteria'];?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a> 
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
      
      
<?php include 'footer.php';?>
