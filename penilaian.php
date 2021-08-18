      <?php include 'header.php';?>
      <?php include 'koneksi.php';?>


      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Sistem Pendukung Keputusan</a>
            </li>
            <li class="breadcrumb-item active">Penilaian</li>
          </ol>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-list-alt"></i>
            List Penilaian</div>
            <div class="card-body">
              <div class="row">
                <div class="col-md">
                  <!-- <a href="penilaian_form.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>Tambah</a> -->
                </div>
              <!--   <div class="col-md">
                  <?php $result = mysqli_query($conn,"SELECT jabatan from pelamar group by jabatan"); ?>
                 <select class="form-control select2" style="width: 100%;" name="penilai" id="penilai" required>
                  <option value="t">-- pilih jabatan --</option>
                  <?php while($row = mysqli_fetch_assoc($result)) : ?>
                    <option value="<?php echo $row['jabatan'] ?>"><?php echo $row['jabatan'] ?></option>
                  <?php endwhile ?>
                </select>
              </div> -->
              <br/>&nbsp;
            </div>
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Pelamar</th>
                    <th>Nama Pelamar</th>
                    <th>Jabatan</th>
                    <th>Tanggal Penilaian</th>
                    <th>Administrasi</th>
                    <th>Kesehatan</th>
                    <th>Psikotest</th>
                    <th>Technical Test</th>
                    <th>Interview User</th>
                    <th>Orientasi Kerja</th>
                     <th>Aksi</th>
                  </tr>
                </thead>
 

                <tbody id="tbl1">
                  <?php
                  include 'koneksi.php';
                  $data=mysqli_query($conn,"SELECT p.kode_pelamar, p.nama_pelamar, p.jabatan, n.tanggal_penilaian,
                    max(case when n.kode_kriteria='K01' then n.nilai end) as 'K01',
                    max(case when n.kode_kriteria='K02' then n.nilai end) as 'K02',
                    max(case when n.kode_kriteria='K03' then n.nilai end) as 'K03',
                    max(case when n.kode_kriteria='K04' then n.nilai end) as 'K04',
                    max(case when n.kode_kriteria='K05' then n.nilai end) as 'K05',
                    max(case when n.kode_kriteria='K06' then n.nilai end) as 'K06'
                    FROM penilaian n, pelamar p  where n.kode_pelamar=p.kode_pelamar GROUP BY p.kode_pelamar ORDER BY p.kode_pelamar DESC ");
                  //if(mysqli_num_rows($data) > 0){
                  $no=1;
                  while($d=mysqli_fetch_array($data)){
                    ?>

                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['kode_pelamar']; ?></td>
                      <td><?php echo $d['nama_pelamar']; ?></td>
                      <td><?php echo $d['jabatan']; ?></td>
                      <td><?php echo date('d-m-Y', strtotime($d["tanggal_penilaian"]));  ?></td>
                      <td><?php echo substr($d['K01'],0,4); ?></td>
                      <td><?php echo $d['K02']; ?></td>
                      <td><?php echo $d['K03']; ?></td>
                      <td><?php echo $d['K04']; ?></td>
                      <td><?php echo $d['K05']; ?></td>
                      <td><?php echo $d['K06']; ?></td>
                      <td>
                        <a href="penilaian_form_edit.php?id=<?php echo $d['kode_pelamar'];?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a> 
                        <a onclick="return confirm('apakah anda akan menghapus?')" href="penilaian_hapus.php?id=<?php echo $d['kode_pelamar'];?>" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a> 
                      </td>
                    </tr>
                    <?php  
                  } 
                    //}
                  ?>


                </tbody>
              </table>

            </div>

          </div>

        </div>

      </div>
    </div>


    <?php include 'footer.php';?>
