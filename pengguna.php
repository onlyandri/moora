<?php include 'header.php';?>


<div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Sistem Pendukung Keputusan</a>
          </li>
          <li class="breadcrumb-item active">Data Pengguna</li>
        </ol>

    
        
      <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-user-circle"></i>
            List Pengguna</div>
          <div class="card-body">
      <a href="pengguna_form.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>Tambah</a>
      <br/>&nbsp;
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Username</th>
                    <th>Sandi Pengguna</th>
                    <th>Nama HRD</th>
                    <th>Aksi</th>
                  </tr>
                </thead>

               
                <tbody>
                  <?php
                  include 'koneksi.php';
                  $data=mysqli_query($conn,"SELECT*FROM ms_pengguna");
              
                  while($d=mysqli_fetch_array($data)){
                    ?>
                  
                  <tr>
                  <td><?php echo $d['username']; ?></td>
                  <td><?php echo $d['sandi_pengguna']; ?></td>
                  <td><?php echo $d['nama_pengguna']; ?></td>
                  <td>
                    <a href="pengguna_form_edit.php?id=<?php echo $d['kode_pengguna'];?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a> 
                    <a onclick="return confirm('apakah anda akan menghapus?')" href="pengguna_delete.php?id=<?php echo $d['kode_pengguna'];?>" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a> 
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
