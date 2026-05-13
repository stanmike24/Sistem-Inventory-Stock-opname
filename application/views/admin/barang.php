  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Barang
        <small>Data Barang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Barang</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php if ($this->session->flashdata('pesan')): ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Sukses!</h4>
        <?php echo $this->session->flashdata('pesan'); ?>
      </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('pesan_error')): ?>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Error!</h4>
        <?php echo $this->session->flashdata('pesan_error'); ?>
      </div>
    <?php endif; ?>
    
    <div class="btn btn-danger" data-toggle="modal" data-target="#tambahData">
        <div class="fa fa-plus"></div> Tambah Data
    </div>


        <!-- Tombol Cetak Data -->
        <a href="<?php echo base_url('index.php/admin/barang/printStokBarang') ?>" class="btn btn-primary">
            <div class="fa fa-print"></div> Cetak Data
        </a>

        <!-- Tabel Data -->
        <div class="box box-danger" style="margin-top: 15px">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="example1">
                        <thead>
                            <tr>
                                <th width="5px">No</th>
                                <th>nama_barang</th>
                                <th>Sisa Stok</th>
                                <th>Tempat</th>
                                <th>Penginput</th>
                                <th>Deskripsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php
        $no = 1;
        foreach ($barang as $brg) {
    ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $brg->nama_barang; ?></td>
            <td><?php echo $brg->stok; ?></td>
            <td><?php echo $brg->tempat; ?></td>
            <td><?php echo $brg->nama_penginput; ?></td>
            <td><?php echo $brg->deskripsi; ?></td>
            <td>
                <a href="<?php echo base_url('index.php/admin/barang/detail/').$brg->id; ?>" class="btn btn-info btn-xs" title="Lihat Detail Serial Number">
                    <i class="fa fa-eye"></i> Detail
                </a>
                <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#kelola<?= $brg->id ?>" title="Kelola Peminjaman">
    <i class="fa fa-plus-square"></i> Kelola
</button>

<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#kembali<?= $brg->id ?>" title="Proses Pengembalian">
    <i class="fa fa-undo"></i> Pengembalian
</button>
                
                
                <a href="<?php echo base_url('index.php/admin/barang/riwayat/').$brg->id ; ?>" class="btn btn-primary btn-xs" title="Lihat Riwayat">
                    <i class="fa fa-history"></i> Riwayat
                </a>

                <a href="<?php echo base_url('index.php/admin/barang/delete/').$brg->id; ?>" class="btn btn-danger btn-xs tombol-yakin" data-isiData="Ingin menghapus data ini!" title="Hapus Data">
                    <i class="fa fa-trash"></i> Hapus
                </a>
                
                <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?php echo $brg->id; ?>" title="Edit Data Barang">
                    <i class="fa fa-edit"></i> Edit
                </button>
            </td>
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

  <!-- Modal Tambah Data -->
  <div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-kodeledby="myModalkode">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-kode="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalkode"><div class="fa fa-plus"></div> Tambah Data</h4>
        </div>
        <form action="<?php echo base_url('index.php/admin/barang/insert') ?>" method="POST">
          <div class="modal-body">
            <div class="form-group">
                <kode>nama_barang</kode>
                <input type="datetime" class="form-control" name="nama_barang" placeholder="nama_barang" required>
            </div>
             <div class="form-group">
                <kode>Tempat</kode>
                <input type="text" class="form-control" name="tempat" placeholder="Tempat" required>
            </div>  
<div class="form-group">
  <kode>Penginput</kode>
  <input type="text" value="<?= $this->session->userdata('nama') ?>" class="form-control" placeholder="nama" readonly>
  <input type="hidden" name="nama" value="<?= $this->session->userdata('nama') ?>">
</div>
            <div class="form-group">
                <kode>Deskripsi</kode>
                <input type="text" class="form-control" name="deskripsi" placeholder="deskripsi" required>
            </div>  
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
            <button type="submit" class="btn btn-primary"><div class="fa fa-save"></div> Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit Data -->
  <?php foreach ($barang as $brg) { ?>
    <?php
                foreach ($manajemenUser as $usr) 
            ?>
    <div class="modal fade" id="editData<?php echo $brg->id ?>" tabindex="-1" role="dialog" aria-kodeledby="myModalkode">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-kode="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalkode"><div class="fa fa-edit"></div> Edit Data</h4>
                </div>
                <form action="<?php echo base_url('index.php/admin/barang/update') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <kode>nama_barang</kode>
                        <input type="hidden" name="id" value="<?php echo $brg->id; ?>">
                        <input type="text" class="form-control" name="nama_barang" placeholder="nama_barang" value="<?php echo $brg->nama_barang; ?>" required>
                    </div>
                    <div class="form-group">
                        <kode>Tempat</kode>
                        <input type="text" class="form-control" name="tempat" placeholder="Tempat" value="<?php echo $brg->tempat; ?>" required>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                <kode>Penginput</kode>
                                <input type="hidden" name="id" value="<?php echo $brg->id; ?>">
                                <input type="text" class="form-control" name="nama" value="<?= $brg->nama ?>" readonly>
                            </div>
                        </div>
                    <div class="form-group">
                        <kode>Deskripsi</kode>
                        <input type="text" class="form-control" name="deskripsi" placeholder="deskripsi" value="<?php echo $brg->deskripsi; ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
                    <button type="submit" class="btn btn-primary"><div class="fa fa-save"></div> update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
  <?php } ?>

<?php foreach ($barang as $brg) { ?>
<div class="modal fade" id="kelola<?= $brg->id ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document"> <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-exchange"></i> Kelola Peminjaman Barang</h4>
            </div>
            <form action="<?php echo base_url('index.php/admin/barang/insert_kelola') ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $brg->id; ?>">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" value="<?= $brg->nama_barang ?>" readonly>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Pilih Serial Number yang Tersedia:</label>
                                <select class="form-control" id="serial-dropdown-<?= $brg->id ?>">
                                    <option value="">-- Pilih Serial Number --</option>
                                    <?php if (!empty($available_serials[$brg->id])): ?>
                                        <?php foreach ($available_serials[$brg->id] as $serial): ?>
                                            <option value="<?php echo htmlspecialchars($serial->serial_number, ENT_QUOTES, 'UTF-8'); ?>">
                                                <?php echo htmlspecialchars($serial->serial_number, ENT_QUOTES, 'UTF-8'); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>&nbsp;</label>
                            <button type="button" class="btn btn-success btn-block" onclick="addSerial(<?= $brg->id ?>)">
                                <i class="fa fa-plus"></i> Tambah ke Daftar
                            </button>
                        </div>
                    </div>

                    <hr>
                    <label>Daftar Serial Number yang Akan Dipinjam:</label>
                    <table class="table table-bordered table-condensed">
                        <tbody id="serial-list-<?= $brg->id ?>">
                            </tbody>
                    </table>
                    <input type="hidden" name="jenis" value="Peminjaman">
                    <div class="form-group">
    <label>Pilih Peminjam (Merchant)</label>
    <select name="id_merchant" class="form-control" required>
        <option value="">-- Pilih Merchant --</option>
        <?php foreach($merchants as $m): ?>
            <option value="<?php echo $m->id_merchant; ?>"><?php echo $m->nama_merchant; ?></option>
        <?php endforeach; ?>
    </select>
</div>
                    <div class="form-group">
                        <label>Deskripsi/Catatan (Opsional)</label>
                        <input type="text" class="form-control" name="deskripsi" placeholder="Contoh: Untuk event di luar kota">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default" onclick="resetForm(<?= $brg->id ?>)">Reset</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="kembali<?= $brg->id ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document"> <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-undo"></i> Form Pengembalian Barang</h4>
            </div>
            <form action="<?php echo base_url('index.php/admin/barang/proses_pengembalian') ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $brg->id; ?>">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" value="<?= $brg->nama_barang ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Pilih Serial Number yang Dikembalikan dan Tentukan Kondisinya:</label>
                        <div style="max-height: 250px; overflow-y: auto; border: 1px solid #ddd; padding: 10px;">
                            <table class="table table-condensed">
                                <?php if (!empty($borrowed_serials[$brg->id])): ?>
                                    <?php foreach ($borrowed_serials[$brg->id] as $serial): ?>
                                        <tr>
                                            <td style="width: 20px;">
                                                <input type="checkbox" name="returned_serials[]" value="<?php echo htmlspecialchars($serial->serial_number, ENT_QUOTES, 'UTF-8'); ?>">
                                            </td>
                                            <td>
                                                <strong><?php echo htmlspecialchars($serial->serial_number, ENT_QUOTES, 'UTF-8'); ?></strong><br>
                                                <small class="text-muted">(<?php echo htmlspecialchars($serial->keterangan, ENT_QUOTES, 'UTF-8'); ?>)</small>
                                            </td>
                                            <td style="width: 200px;">
                                                <label class="radio-inline">
                                                    <input type="radio" name="kondisi[<?php echo htmlspecialchars($serial->serial_number, ENT_QUOTES, 'UTF-8'); ?>]" value="Bagus" checked> Bagus
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="kondisi[<?php echo htmlspecialchars($serial->serial_number, ENT_QUOTES, 'UTF-8'); ?>]" value="Rusak"> Rusak
                                                </label>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td><p class="text-info">Tidak ada serial number yang sedang dipinjam untuk barang ini.</p></td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                    
                    <div class="form-group">
    <label>Pilih Pengembali (Merchant)</label>
    <select name="id_merchant" class="form-control" required>
        <option value="">-- Pilih Merchant --</option>
        <?php foreach($merchants as $m): ?>
            <option value="<?php echo $m->id_merchant; ?>"><?php echo $m->nama_merchant; ?></option>
        <?php endforeach; ?>
    </select>
</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Proses Pengembalian</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>