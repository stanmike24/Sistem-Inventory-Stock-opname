<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Ringkasan Sistem Inventaris</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">
        
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-info"></i> Selamat Datang!</h4>
                    Halo, <strong><?php echo $this->session->userdata('nama'); ?></strong>. Selamat datang kembali di sistem manajemen inventaris.
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-cubes"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jenis Barang</span>
                        <span class="info-box-number"><?php echo $jumlah_barang; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-barcode"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Unit Barang</span>
                        <span class="info-box-number"><?php echo $jumlah_serial; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-building-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Merchant</span>
                        <span class="info-box-number"><?php echo $jumlah_merchant; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-external-link"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Sedang Dipinjam</span>
                        <span class="info-box-number"><?php echo $barang_dipinjam; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-history"></i> Aktivitas Terbaru</h3>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Jenis Transaksi</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Merchant/Unit</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($riwayat_terakhir as $r): ?>
                                <tr>
                                    <td>
                                        <?php if($r->jenis == 'Peminjaman'): ?>
                                            <span class="label label-danger">Peminjaman</span>
                                        <?php else: ?>
                                            <span class="label label-success">Pengembalian</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $r->nama_barang; ?></td>
                                    <td><?php echo $r->jumlah; ?> Unit</td>
                                    <td><?php echo $r->unit; ?></td>
                                    <td><?php echo date('d M Y, H:i', strtotime($r->createDate)); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer text-center">
                        <a href="<?php echo base_url('index.php/admin/riwayat'); // Ganti jika URL riwayat Anda berbeda ?>" class="uppercase">Lihat Semua Riwayat</a>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>