  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Riwayat Barang
        <small>Riwayat Barang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Riwayat Barang</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Alert -->
      <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan') ?>"></div>

      <!-- Tombol Cetak Data -->
      <!-- Tabel Data -->
      <div class="box box-danger" style="margin-top: 15px">
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped" id="example1">
              <thead>
                <tr>
                  <th width="5px">No</th>
                  <th>nama_barang</th>
                  <th>SN / Imei</th>
                  <th>Jenis</th>
                  <th>Jumlah</th>
                  <th>Waktu</th>
                  <th>Peminjam</th>
                  <th>No Telp</th>
                  <th>Deksripsi</th>
                </tr>
              </thead>
              <tbody>
                <?php  
                $no =1;
                foreach ($riwayat as $rwt) {
                ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $rwt->nama_barang ?></td>
                  <td><?php echo $rwt->kode ?></td>
                  <td>
                    <?php
                      if($rwt->jenis == 'Pengembalian'){
                        echo '<div class="kode kode-success">'.$rwt->jenis.'</div>';
                      } else {
                        echo '<div class="kode kode-danger">'.$rwt->jenis.'</div>';
                      }
                    ?>
                  </td>
                  <td><?php echo $rwt->jumlah ?></td>
                  <td><?php echo date('d-M-Y H:i:s', strtotime($rwt->createDate)) ?></td>
                  <td><?php echo $rwt->unit ?></td>
                  <td><?php echo $rwt->noTlp ?></td>
                  <td><?php echo $rwt->deskripsi ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal Cetak Data -->
  <div class="modal fade" id="cetakData" tabindex="-1" role="dialog" aria-kodeledby="myModalkode">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-kode="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalkode"><div class="fa fa-print"></div> Cetak Data</h4>
        </div>
        <form action="<?php echo base_url('index.php/admin/riwayat/cetak') ?>" method="POST">
          <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <kode>Tanggal awal</kode>
                        <input type="date" class="form-control" name="tgl_awal" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <kode>Tanggal akhir</kode>
                        <input type="date" class="form-control" name="tgl_akhir" required>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
            <button type="submit" class="btn btn-primary"><div class="fa fa-print"></div> Print</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Export Excel -->
  <div class="modal fade" id="exportExcel" tabindex="-1" role="dialog" aria-kodeledby="myModalkode">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-kode="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalkode"><div class="fa fa-download"></div> Export Excel</h4>
        </div>
        <form action="<?php echo base_url('index.php/admin/riwayat/exportExcel') ?>" method="POST">
          <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <kode>Tanggal awal</kode>
                        <input type="date" class="form-control" name="tgl_awal" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <kode>Tanggal akhir</kode>
                        <input type="date" class="form-control" name="tgl_akhir" required>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
            <button type="submit" class="btn btn-primary"><div class="fa fa-download"></div> Export</button>
          </div>
        </form>
      </div>
    </div>
  </div>