      <?php include 'header.php';?>
      <?php include 'koneksi.php';?>


      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Sistem Pendukung Keputusan</a>
            </li>
            <li class="breadcrumb-item active">Penilaian sub Administrasi</li>
          </ol>
          <!-- DataTables Example -->
          <div class="card mb-3"> 
            <div class="card-header">
              <i class="fas fa-list-alt"></i>
            List Penilaian</div>
            <div class="card-body">
             <div class="row">
              <div class="col-md-4">
               <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambah">
                <i class="fas fa-plus-circle"></i> &nbsp;Tambah Nilai
              </button> 
            </div> 
            <div class="col-md-4">
               <button type="button" class="btn btn-danger" id="hapus" data-toggle="modal" data-target="#modalHapus">
                <i class="fas fa-trash"></i> &nbsp;Hapus Semua Data
              </button> 
            </div> 
          </div>
          <br>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Pelamar</th>
                  <th>Nama Pelamar</th>
                  <th>Jabatan</th>
                  <th>Tanggal Penilaian</th>
                  <?php
                  $id_detail = [];
                  $no=0;
                  $ql = mysqli_query($conn,"SELECT * FROM detail_adm");

                  while($data = mysqli_fetch_assoc($ql)):

                    $no++;

                    $id_detail[$no] = $data['id_detail'];
                    ?>
                    <th><?= $data['nama_detail'] ?></th>
                  <?php endwhile ?>
                  <th>Aksi</th>
                </tr>
              </thead>


              <tbody id="tbl1">
                <?php
                // $data=mysqli_query($conn,"SELECT * from penilaian_adm p join detail_adm d on d.id_detail= p.id_detail join pelamar pl on pl.kode_pelamar = p.kode_pelamar order by p.kode_pelamar");

                $dua = '';

                foreach ($id_detail as $key => $value) {
                  $dua .= "max(case when n.id_detail='$value' then n.nilai end) as '$value',";
                }

                $data=mysqli_query($conn,"SELECT p.kode_pelamar, p.nama_pelamar, p.jabatan, n.tanggal_adm,$dua max(case when n.id_detail='0' then n.nilai end) as '0'
                  FROM penilaian_adm n, pelamar p where n.kode_pelamar=p.kode_pelamar GROUP BY p.kode_pelamar ORDER BY p.kode_pelamar DESC ");
                  //if(mysqli_num_rows($data) > 0){
                $no=1;
                while($d=mysqli_fetch_array($data)){
                  ?>

                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $d['kode_pelamar']; ?></td>
                    <td><?php echo $d['nama_pelamar']; ?></td>
                    <td><?php echo $d['jabatan']; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($d["tanggal_adm"]));  ?></td>
                    <?php foreach ($id_detail as $key => $value) : ?>
                      <td><?php echo $d[$value]; ?></td>
                    <?php endforeach ?>
                    <td>
                      <a href="penilaian_adm_edit.php?id=<?php echo $d['kode_pelamar'];?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a> 
                      <a onclick="return confirm('apakah anda akan menghapus?')" href="penilaian_hapus_adm.php?id=<?php echo $d['kode_pelamar'];?>" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a> 
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

 <!-- <?php  $sql="SELECT * FROM  penilaian_adm";
  $result=mysqli_query($conn,$sql);

  $no = 0;
  $kode = [];

if(mysqli_num_rows($result) > 0){
  while($data = mysqli_fetch_assoc($result) ){

    $kode[$no] = $data['kode_pelamar'];
     $no++;
  }
}
  
?> -->
<div class="modal fade" id="modalTambah">
  <div class="modal-dialog">
    <form class="modal-content" action="penilaian_adm_simpan.php" method="POST">
     <div class="modal-header">
      <h4 class="modal-title">Tambah  Nilai Sub Administrasi</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class ="form-group">
        <label for="kode_pelamar">Kode Pelamar</label>
        <select class="form-control" name="kode_pelamar" id="kode_pelamar">

         <?php
         
         $sql1 = "SELECT * FROM pelamar";

         $result1 = mysqli_query($conn,$sql1);
         $n =0;
         while($data = mysqli_fetch_assoc($result1) ){
          $n++; 
          $kode = $data['kode_pelamar'];

          $ql = mysqli_query($conn,"SELECT * FROM penilaian_adm where kode_pelamar = '$kode'");

          if(mysqli_num_rows($ql) < 1) {
            ?>

            <option value="<?=$data['kode_pelamar'];?>"><?= $data['kode_pelamar']; ?> - <?= $data['nama_pelamar']; ?>  - <?= $data['jabatan']; ?></option>
          <?php } ?>
        <?php } ?>

      </select>
    </div>
    <div class="form-grup">
      <label for="tanggal_penilaian">Tanggal Penilaian</label>
      <input type="date" class="form-control" id="tanggal_penilaian" required="required" name="tanggal_penilaian">
    </div>
    <?php
    $sql="SELECT * FROM detail_adm ";
    $result=mysqli_query($conn,$sql);
    while($data = mysqli_fetch_assoc($result) ){
      ?>
      <div class ="form-group">
        <label for="administrasi"><?= $data['nama_detail'];?></label>
        <input type="hidden" name="id[]" value="<?= $data['id_detail'];?>">
        <select name="jawaban_<?= $data['id_detail'];?>" id="jawaban_<?= $data['id_detail'];?>" class="form-control">
          <?php for($i=1; $i <= 10; $i++){ ?>
            <option value="<?= $i; ?>"><?= $i;?></option>
          <?php } ?>
        </select>
      </div>
      <?php
    }
    ?>
  </div>
  <div class="modal-footer text-right">
    <button type="submit" class="btn btn-info">titi</button> 
  </div>
</form>





</div>
</div>


<?php include 'footer.php';?>
