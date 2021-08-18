<?php
include 'koneksi.php';


require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
ob_start(); 
?>
<!DOCTYPE html>
<html>
<head>
 <title>SISTEM PENDUKUNG KEPUTUSAN PEREKRUTAN KARYAWAN BARU PADA PT. PISMATEX</title>
</head>
<body>
 <div align="center">
  <h2 align="center">DATA PELAMAR</h2>
  <h2 align="center">PT. PISMATEX</h2>
  <table align="center" width="60%" border="1">
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
    </tr>
   </thead>
   <tbody>
    <?php
                  include 'koneksi.php';
                  $data=mysqli_query($conn,"SELECT*FROM pelamar");
              
                  while($d=mysqli_fetch_array($data)){
                    ?>
    <tr>
     <td><?=$d['nama_pelamar']?></td>
     <td><?=$d['tanggal_masuk']?></td>
     <td><?=$d['jabatan']?></td>
     <td><?=$d['jenis_kelamin']?></td>
     <td><?=$d['tanggal_lahir']?></td>
     <td><?=$d['status_perkawinan']?></td>
     <td><?=$d['no_hp']?></td>
     <td><?=$d['alamat']?></td>
     <td><?=$d['pendidikan']?></td>
     <td><?=$d['tahun_lulus']?></td>
     <td><?=$d['nilai_ipk']?></td>
     <td><?=$d['pengalaman']?></td>
    </tr>
    <?php
    }
    ?>
   </tbody>
  </table>
 </div>
</body>
</html>
<?php
 $html = ob_get_contents(); 
 ob_end_clean();
 $mpdf->AddPage('L'); // Adds a new page in Landscape orientation
 $mpdf->WriteHTML(utf8_encode($html));
 $mpdf->Output();
?>