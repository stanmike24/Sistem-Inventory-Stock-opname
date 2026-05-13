  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.3.0
    </div>
    <strong>Copyright &copy; 2025 <a>equal trinity</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="kode kode-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="kode kode-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="kode kode-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="kode kode-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <kode class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </kode>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <kode class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </kode>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <kode class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </kode>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <kode class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </kode>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <kode class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </kode>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <kode class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </kode>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script>
function addSerial(barangId) {
    // Ambil elemen dropdown dan tabel berdasarkan ID barang yang unik
    var dropdown = document.getElementById('serial-dropdown-' + barangId);
    var listBody = document.getElementById('serial-list-' + barangId);

    // Ambil nilai dan teks dari opsi yang dipilih
    var selectedValue = dropdown.value;
    var selectedText = dropdown.options[dropdown.selectedIndex].text;
    
    // Jangan lakukan apa-apa jika tidak ada yang dipilih
    if (!selectedValue) {
        alert('Silakan pilih serial number terlebih dahulu.');
        return;
    }

    // Buat baris baru untuk tabel
    var newRow = document.createElement('tr');
    
    // Buat sel untuk nama serial number
    var cell1 = document.createElement('td');
    cell1.textContent = selectedText;
    
    // Buat input hidden yang akan dikirim ke controller
    var hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = 'selected_serials[]'; // Nama array yang sama seperti sebelumnya
    hiddenInput.value = selectedValue;
    cell1.appendChild(hiddenInput); // Masukkan input ke dalam sel

    // Buat sel untuk tombol hapus
    var cell2 = document.createElement('td');
    cell2.style.width = '50px';
    var removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.className = 'btn btn-danger btn-xs';
    removeButton.innerHTML = '<i class="fa fa-trash"></i>';
    removeButton.onclick = function() {
        // Hapus baris dari tabel
        listBody.removeChild(newRow);
        // Kembalikan opsi ke dropdown
        var option = document.createElement('option');
        option.value = selectedValue;
        option.text = selectedText;
        dropdown.appendChild(option);
    };
    cell2.appendChild(removeButton);

    // Gabungkan sel ke baris, dan baris ke tabel
    newRow.appendChild(cell1);
    newRow.appendChild(cell2);
    listBody.appendChild(newRow);

    // Hapus opsi yang sudah dipilih dari dropdown agar tidak bisa dipilih dua kali
    dropdown.remove(dropdown.selectedIndex);
}

function resetForm(barangId) {
    // Fungsi ini bisa diperluas untuk mereset daftar yang sudah dipilih jika perlu
    // Untuk sekarang, biarkan kosong atau sesuaikan dengan kebutuhan
    var listBody = document.getElementById('serial-list-' + barangId);
    listBody.innerHTML = '';
    // Logika untuk mengembalikan semua item ke dropdown bisa ditambahkan di sini
}
function addSerialKembali(barangId) {
    // Ambil elemen dropdown dan tabel berdasarkan ID unik untuk pengembalian
    var dropdown = document.getElementById('serial-dropdown-kembali-' + barangId);
    var listBody = document.getElementById('serial-list-kembali-' + barangId);

    var selectedValue = dropdown.value;
    var selectedText = dropdown.options[dropdown.selectedIndex].text;
    
    if (!selectedValue) {
        alert('Silakan pilih serial number yang akan dikembalikan.');
        return;
    }

    var newRow = document.createElement('tr');
    var cell1 = document.createElement('td');
    cell1.textContent = selectedText;
    
    // Buat input hidden yang akan dikirim ke controller
    var hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    // Gunakan nama 'returned_serials[]' sesuai yang diharapkan controller
    hiddenInput.name = 'returned_serials[]'; 
    hiddenInput.value = selectedValue;
    cell1.appendChild(hiddenInput);

    var cell2 = document.createElement('td');
    cell2.style.width = '50px';
    var removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.className = 'btn btn-danger btn-xs';
    removeButton.innerHTML = '<i class="fa fa-trash"></i>';
    removeButton.onclick = function() {
        listBody.removeChild(newRow);
        var option = document.createElement('option');
        option.value = selectedValue;
        option.text = selectedText;
        dropdown.appendChild(option);
    };
    cell2.appendChild(removeButton);

    newRow.appendChild(cell1);
    newRow.appendChild(cell2);
    listBody.appendChild(newRow);

    dropdown.remove(dropdown.selectedIndex);
}
</script>

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets') ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets') ?>/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets') ?>/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets') ?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets') ?>/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets') ?>/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets') ?>/dist/js/demo.js"></script>
<!-- PACE -->
<script src="<?php echo base_url('assets') ?>/plugins/pace/pace.min.js"></script>
<!-- page script -->
<script type="text/javascript">
	// To make Pace works on Ajax calls
	$(document).ajaxStart(function() { Pace.restart(); });
    $('.ajax').click(function(){
        $.ajax({url: '#', success: function(result){
            $('.ajax-content').html('<hr>Ajax Request Completed !');
        }});
    });
</script>

<!-- Sweet Alert -->
<script src="<?php echo base_url('assets/sweetalert') ?>/sweetalert.min.js"></script>
<script>
    //Notifikasi
    const flashData = $('.flash-data').data('flashdata');
    if (flashData){
      swal({
        title: "Success!",
        text: flashData,
        icon: "success",
        button: "Ok!",
      });
    }

    //Konfirmasi
    $('.tombol-yakin').on('click', function (e) {
      e.preventDefault();
      const href = $(this).attr('href');
      const isiData = $(this).data('isidata');
      swal({
        title: 'Apakah anda yakin?',
        text: isiData,
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
          if (willDelete) {
            document.location.href = href;
          }
        });
    });
</script>

<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
</body>
</html>
