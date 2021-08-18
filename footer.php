


<!-- Sticky Footer -->
</div>
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin keluar?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Silakan pilih logout untuk keluar</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalHapus">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus semua data ?</p>
        <p class="text-red">Jika anda menghapus ini juga akan menghapus semua data dari penilaian keseluruhan </p>
      </div>
      <div class="modal-footer text-right">
        <a class="btn btn-info" id="hapus2">Ya, hapus !</a>
      </div>
    </div>
  </div>
</div>



<footer class="sticky-footer">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright © SISTEM PENDUKUNG KEPUTUSAN PEREKRUTAN KARYAWAN BARU PT. PISMATEX</span>
    </div>
  </div>
</footer>
<!-- Bootstrap core JavaScript-->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="assets/sweet-alert/sweet-alert.min.js"></script>
<script src="assets/sweet-alert/sweet-alert.init.js"></script>

<!-- Page level plugin JavaScript-->
<script src="assets/vendor/chart.js/Chart.min.js"></script>
<script src="assets/vendor/datatables/jquery.dataTables.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="assets/js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<script src="assets/js/demo/datatables-demo.js"></script>
<script src="assets/js/demo/chart-bar-demo.js"></script>

<script type="text/javascript">

    $(document).on('click', '#hapus', function () {
    var url = "hapus_semua.php";
    $('#hapus2').attr('href', url)
  })

      $('#tanggal_akhir').on('change',function(){ //ketika form cari diatas diisikan huruf maka akan mencari kereta
      var tgl_awal = $('#tanggal_mulai').val();
      var tgl_akhir = $(this).val();// mengambil nilai dari yang diinputkan

      $.ajax({
        url:"filter_jabatan.php", 
        method :"POST", 
        data:{tgl_awal:tgl_awal,tgl_akhir:tgl_akhir},
        success:function(data){ 
          $('#tbl').html(data);
        }
      });

    });

      $('#tanggal_mulai').on('change',function(){ //ketika form cari diatas diisikan huruf maka akan mencari kereta
      var tgl_akhir = $('#tanggal_akhir').val();
      var tgl_awal = $(this).val();// mengambil nilai dari yang diinputka

      $.ajax({
        url:"filter_jabatan.php", 
        method :"POST", 
        data:{tgl_awal:tgl_awal,tgl_akhir:tgl_akhir},
        success:function(data){ 
          $('#tbl').html(data);
        }
      });

    });


      $('#hasil_jbt').on('change',function(){ //ketika form cari diatas diisikan huruf maka akan mencari kereta

      var jbt = $(this).val();// mengambil nilai dari yang diinputkan
      $.ajax({
        url:"proses_perhitungan.php", 
        method :"POST", 
        data:{jbt:jbt},
        success:function(data){ 
          $('#hsl').html(data);
        }
      });

    });
  </script>


</body>

</html>