  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets') ?>/dist/img/avatar4.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama') ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>

        <li>
    <a href="<?php echo base_url('index.php/admin/dashboard') ?>">
        <i class="fa fa-dashboard"></i> <span>Home</span>
    </a>
</li>

        <li class="treeview">
          <a href="<?php echo base_url('index.php/admin/barang') ?>">
            <i class="fa fa-book"></i> <span>Data Barang</span>
          </a>
        </li>

<li>
    <a href="<?php echo base_url('index.php/admin/merchant') ?>">
        <i class="fa fa-building"></i> <span>Data Merchant</span>
    </a>
</li>
        <li class="treeview">
          <a href="<?php echo base_url('index.php/admin/riwayat') ?>">
            <i class="fa fa-history"></i> <span>Riwayat Peminjaman</span>
          </a>
        </li>

        <li class="treeview">
          <a href="<?php echo base_url('index.php/admin/laporan') ?>">
            <i class="fa fa-table"></i> <span>Laporan</span>
          </a>
        </li>

        <li class="treeview">
          <a href="<?php echo base_url('index.php/admin/manajemenUser') ?>">
            <i class="fa fa-group"></i> <span>Manajemen User</span>
            <span class="pull-right-container">
              <span class="kode kode-danger pull-right">
                <?php
                  $jumlahUser = $this->db->query('SELECT id FROM tb_user')->num_rows();
                  echo $jumlahUser . " User";
                ?>
              </span>
            </span>
          </a>
        </li>

        <li class="treeview">
          <a href="<?php echo base_url('index.php/admin/profile') ?>">
            <i class="fa fa-user"></i> <span>Profile</span>
          </a>
        </li>

        <li class="treeview">
          <a href="<?php echo base_url('index.php/welcome/logout') ?>" class="tombol-yakin" data-isiData="Ingin keluar dari sistem ini!">
            <i class="fa fa-sign-out"></i> <span>Sign Out</span>
          </a>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>