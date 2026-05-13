<div class="content-wrapper">
    <section class="content-header">
        <h1>Data Merchant <small>Kelola Data Merchant</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Merchant</li>
        </ol>
    </section>

    <section class="content">
        <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('pesan') ?>"></div>
        <div class="btn btn-danger" data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Tambah Merchant</div>

        <div class="box box-danger" style="margin-top: 15px">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="example1">
                        <thead>
                            <tr>
                                <th width="5px">No</th>
                                <th>Nama Merchant</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>User Penanggung Jawab (PIC)</th> <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($merchants as $m) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $m->nama_merchant; ?></td>
                                    <td><?php echo $m->alamat_merchant; ?></td>
                                    <td><?php echo $m->telepon_merchant; ?></td>
                                    <td><?php echo $m->nama_user ? $m->nama_user : '-'; ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?php echo $m->id_merchant; ?>"><i class="fa fa-edit"></i> Edit</button>
                                        <a href="<?php echo base_url('index.php/admin/merchant/delete/').$m->id_merchant; ?>" class="btn btn-danger btn-xs tombol-yakin" data-isiData="Ingin menghapus merchant ini?"><i class="fa fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="tambahData" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Merchant</h4>
            </div>
            <form action="<?php echo base_url('index.php/admin/merchant/insert') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group"><label>Nama Merchant</label><input type="text" class="form-control" name="nama_merchant" required></div>
                    <div class="form-group"><label>Alamat</label><textarea class="form-control" name="alamat_merchant" rows="3"></textarea></div>
                    <div class="form-group"><label>Telepon</label><input type="text" class="form-control" name="telepon_merchant"></div>
                    <div class="form-group">
                        <label>Pilih User Penanggung Jawab (PIC)</label>
                        <select name="id_user" class="form-control">
                            <option value="">-- Tidak Ada --</option>
                            <?php foreach($users as $user): ?>
                                <option value="<?php echo $user->id; ?>"><?php echo $user->nama; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($merchants as $m) { ?>
<div class="modal fade" id="editData<?php echo $m->id_merchant ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Merchant</h4>
            </div>
            <form action="<?php echo base_url('index.php/admin/merchant/update') ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_merchant" value="<?php echo $m->id_merchant; ?>">
                    <div class="form-group"><label>Nama Merchant</label><input type="text" class="form-control" name="nama_merchant" value="<?php echo $m->nama_merchant; ?>" required></div>
                    <div class="form-group"><label>Alamat</label><textarea class="form-control" name="alamat_merchant" rows="3"><?php echo $m->alamat_merchant; ?></textarea></div>
                    <div class="form-group"><label>Telepon</label><input type="text" class="form-control" name="telepon_merchant" value="<?php echo $m->telepon_merchant; ?>"></div>
                    <div class="form-group">
                        <label>Pilih User Penanggung Jawab (PIC)</label>
                        <select name="id_user" class="form-control">
                            <option value="">-- Tidak Ada --</option>
                            <?php foreach($users as $user): ?>
                                <option value="<?php echo $user->id; ?>" <?php echo ($user->id == $m->id_user) ? 'selected' : ''; ?>>
                                    <?php echo $user->nama; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>