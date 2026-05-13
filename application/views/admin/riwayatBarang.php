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
      <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">
                nama_barang : <?php echo $nama_barang; ?>
            </h3>
            <div class="pull-right btn-group">
                <a href="<?php echo base_url('index.php/admin/barang') ?>" class="btn btn-success btn-sm">
                    <div class="fa fa-arrow-left"></div> Kembali
                </a>
                <a href="<?php echo base_url('index.php/admin/barang/printRiwayatBarang/').$id ?>" class="btn btn-primary btn-sm">
                    <div class="fa fa-print"></div> Cetak Data
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped" id="example1">
                    <thead>
                        <tr>
                            <th width="5px">No</th>
                            <th>nama_barang</th>
                            <th>Serial</th>
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