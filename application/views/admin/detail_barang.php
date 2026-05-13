<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Detail Serial Number
      <small>Untuk Barang: <strong><?php echo htmlspecialchars($barang->nama_barang, ENT_QUOTES, 'UTF-8'); ?></strong></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('index.php/admin/barang'); ?>">Data Barang</a></li>
      <li class="active">Detail Serial Number</li>
    </ol>
  </section>

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

      <div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-plus"></i> Tambah Serial Number (Bisa Banyak Sekaligus)</h3>
    </div>
    <form action="<?php echo base_url('index.php/admin/barang/tambah_serial_batch'); ?>" method="post">
        <div class="box-body">
            <input type="hidden" name="id_barang" value="<?php echo $barang->id; ?>">
            <div class="form-group">
                <label for="list_serial_number" class="col-sm-12">Daftar Serial Number Baru</label>
                <div class="col-sm-12">
                    <textarea class="form-control" name="list_serial_number" id="list_serial_number" rows="6" placeholder="Masukkan atau tempel (paste) daftar serial number di sini.
Pastikan satu serial number per baris." required></textarea>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Semua Serial Number</button>
        </div>
    </form>
</div>

    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-list"></i> Daftar Serial Number</h3>
        <div class="box-tools pull-right">
            <span class="label label-success" style="font-size:14px;">Tersedia: <?php echo $stok_tersedia; ?></span>
            <span class="label label-warning" style="font-size:14px;">Dipinjam: <?php echo $stok_dipinjam; ?></span>
        </div>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="example1">
            <thead>
              <tr>
                <th width="5%">No</th>
                <th>Serial Number</th>
                <th width="20%">Status</th>
                <th>Keterangan</th>
                <th width="15%">Aksi</th>
              </tr>
            </thead>
            <tbody>
    <?php $no = 1; foreach ($list_serial as $serial): ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($serial->serial_number, ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
                <?php 
                    $label_class = 'label-default';
                    if ($serial->status == 'Tersedia') $label_class = 'label-success';
                    if ($serial->status == 'Dipinjam') $label_class = 'label-warning';
                    if ($serial->status == 'Rusak') $label_class = 'label-danger';
                    if ($serial->status == 'Perbaikan') $label_class = 'label-info';
                ?>
                <span class="label <?php echo $label_class; ?>"><?php echo $serial->status; ?></span>
            </td>
            <td><?php echo htmlspecialchars($serial->keterangan, ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
                <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#ubahStatusModal<?php echo $serial->id_serial; ?>">
                    <i class="fa fa-edit"></i> Ubah Status
                </button>
                <a href="<?php echo base_url('index.php/admin/barang/hapus_serial/' . $serial->id_serial . '/' . $barang->id); ?>" class="btn btn-xs btn-danger tombol-yakin" data-isiData="Yakin ingin menghapus serial number '<?php echo htmlspecialchars($serial->serial_number, ENT_QUOTES, 'UTF-8'); ?>'?">
    <i class="fa fa-trash"></i> Hapus
</a>
        </tr> <div class="modal fade" id="ubahStatusModal<?php echo $serial->id_serial; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Ubah Status: <?php echo htmlspecialchars($serial->serial_number, ENT_QUOTES, 'UTF-8'); ?></h4>
                    </div>
                    <form action="<?php echo base_url('index.php/admin/barang/ubah_status_serial'); ?>" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id_serial" value="<?php echo $serial->id_serial; ?>">
                            <input type="hidden" name="id_barang" value="<?php echo $barang->id; // Untuk redirect kembali ?>">

                            <div class="form-group">
                                <label for="status">Pilih Status Baru</label>
                                <select name="status" class="form-control" required>
                                    <option value="Tersedia" <?php echo ($serial->status == 'Tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                                    <option value="Dipinjam" <?php echo ($serial->status == 'Dipinjam') ? 'selected' : ''; ?>>Dipinjam</option>
                                    <option value="Rusak" <?php echo ($serial->status == 'Rusak') ? 'selected' : ''; ?>>Rusak</option>
                                    <option value="Perbaikan" <?php echo ($serial->status == 'Perbaikan') ? 'selected' : ''; ?>>Perbaikan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan (Opsional)</label>
                                <textarea name="keterangan" class="form-control" rows="3" placeholder="Contoh: Dipinjam oleh Budi sejak 25 Juni 2025"><?php echo htmlspecialchars($serial->keterangan, ENT_QUOTES, 'UTF-8'); ?></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php endforeach; ?> </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>