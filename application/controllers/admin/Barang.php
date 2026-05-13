<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id')){
            redirect('index.php/welcome');
        } else {
            if($this->session->userdata('level') != 'Admin'){
                redirect('index.php/user/dashboard');
            }
        }
    }

public function index()
{
    $data['title'] = 'Data Barang';

    // --- PERUBAHAN DI SINI: Menggunakan fungsi baru untuk mengambil data barang ---
    $data['barang'] = $this->m_model->get_barang_with_user()->result();
    // --- AKHIR PERUBAHAN ---

    $this->db->order_by('id_merchant', 'DESC');
    $data['merchants'] = $this->db->get('tb_merchant')->result();

    $data['available_serials'] = array();
    $data['borrowed_serials'] = array();

    foreach ($data['barang'] as $brg) {
        $data['available_serials'][$brg->id] = $this->m_model->get_available_serials($brg->id)->result();
        $data['borrowed_serials'][$brg->id] = $this->m_model->get_borrowed_serials($brg->id)->result();
    }

    $this->load->view('admin/templates/header', $data);
    $this->load->view('admin/templates/sidebar');
    $this->load->view('admin/barang', $data); 
    $this->load->view('admin/templates/footer');
}
    public function delete($id)
    {
        $where = array('id' => $id );

        $this->m_model->delete($where, 'tb_barang');
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus!');
        redirect('index.php/admin/barang');
    }

    public function insert()
    {
        date_default_timezone_set('Asia/Jakarta');
        
        // Ambil nama barang dari form untuk divalidasi
        $nama_barang = $this->input->post('nama_barang');

        // --- VALIDASI DUPLIKAT NAMA BARANG ---
        $this->db->where('nama_barang', $nama_barang);
        $check = $this->db->get('tb_barang');

        if ($check->num_rows() > 0) {
            // Jika nama barang sudah ada, kirim pesan error dan kembali
            $this->session->set_flashdata('pesan_error', 'Gagal menambahkan! Nama barang "<strong>' . $nama_barang . '</strong>" sudah terdaftar.');
            redirect('index.php/admin/barang');
        }
        // --- AKHIR VALIDASI ---

        // Jika validasi lolos, lanjutkan proses penyimpanan
        $id_user_input = $this->session->userdata('id');
        $data = array(
            'nama_barang'   => $nama_barang,
            'stok'          => 0,
            'tempat'        => $this->input->post('tempat'),
            'deskripsi'     => $this->input->post('deskripsi'),
            'createDate'    => date('Y-m-d H:i:s'),
            'id_user_input' => $id_user_input
        );

        $this->m_model->insert($data, 'tb_barang');
        $this->session->set_flashdata('pesan', 'Data barang baru berhasil ditambahkan!');
        redirect('index.php/admin/barang');
    }

public function insert_kelola()
{
    date_default_timezone_set('Asia/Jakarta');

    // 1. Ambil data dari form (perhatikan id_merchant)
    $id_barang        = $this->input->post('id');
    $id_merchant      = $this->input->post('id_merchant'); // Menerima ID, bukan nama
    $selected_serials = $this->input->post('selected_serials');
    $deskripsi        = $this->input->post('deskripsi');

    if (empty($selected_serials)) {
        $this->session->set_flashdata('pesan_error', 'Tidak ada serial number yang dipilih!');
        redirect('index.php/admin/barang');
    }

    // 2. Ambil detail merchant dari database berdasarkan ID
    $merchant = $this->m_model->get_where(['id_merchant' => $id_merchant], 'tb_merchant')->row();

    // 3. Hitung jumlah dan siapkan data untuk riwayat
    $jumlah_dipinjam = count($selected_serials);
    $serial_string   = implode(', ', $selected_serials);

    foreach ($selected_serials as $sn) {
        $where_serial = ['serial_number' => $sn, 'id_barang' => $id_barang];
        $data_update_serial = [
            'status' => 'Dipinjam',
            'keterangan' => "Dipinjam oleh: " . $merchant->nama_merchant // Gunakan nama merchant
        ];
        $this->m_model->update($where_serial, $data_update_serial, 'tb_serial_number');
    }

    $sisa_serial_tersedia = $this->m_model->get_available_serials($id_barang)->num_rows();
    $this->m_model->update(['id' => $id_barang], ['stok' => $sisa_serial_tersedia], 'tb_barang');

    $barang = $this->m_model->get_where(['id' => $id_barang], 'tb_barang')->row();
    $data_riwayat = array(
        'nama_barang' => $barang->nama_barang,
        'kode'        => $serial_string,
        'jumlah'      => $jumlah_dipinjam,
        'jenis'       => 'Peminjaman',
        'createDate'  => date('Y-m-d H:i:s'),
        'unit'        => $merchant->nama_merchant,    // 4. Gunakan nama & telepon
        'noTlp'       => $merchant->telepon_merchant, // dari merchant yang sudah diambil
        'deskripsi'   => $deskripsi,
    );
    $this->m_model->insert($data_riwayat, 'tb_riwayat');

    $this->session->set_flashdata('pesan', 'Transaksi peminjaman berhasil! Stok telah disesuaikan.');
    redirect('index.php/admin/barang');
}

    public function update()
    {
        $id     = $_POST['id'];
        $nama_barang   = $_POST['nama_barang'];
        $stok   = $_POST['stok'];
        $tempat = $_POST['tempat'];
        $deskripsi = $_POST['deskripsi'];

        $data = array(
            'nama_barang'   => $nama_barang,
            'stok'   => $stok,
            'tempat' => $tempat,
            'deskripsi' => $deskripsi,
        );

        $where = array('id' => $id);

        $this->m_model->update($where, $data, 'tb_barang');
        $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
        redirect('index.php/admin/barang');
    }

    public function riwayat($id)
    {
        $where = array('id' => $id);

        $ambilnama_barang = $this->m_model->get_where($where, 'tb_barang')->result();
        foreach ($ambilnama_barang as $ablKd) {
            $nama_barangBarang = $ablKd->nama_barang;
        }

        $data['nama_barang'] = $nama_barangBarang;
        $wherenama_barang = array('nama_barang' => $nama_barangBarang);
        $data['riwayat'] = $this->m_model->get_where($wherenama_barang, 'tb_riwayat')->result();
        $data['id'] = $id;
        $data['title'] = 'Riwayat Barang : ' . $nama_barangBarang;
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/riwayatBarang', $data);
        $this->load->view('admin/templates/footer');
    }

    public function printStokBarang()
    {
       $data['barang'] = $this->m_model->get('tb_barang')->result();
       $data['title'] = 'Cetak Stok Barang';

       $this->load->view('admin/cetakStokBarang', $data);
    }

    public function printRiwayatBarang($id)
    {
       $where = array('id' => $id);

       $ambilnama_barang = $this->m_model->get_where($where, 'tb_barang')->result();
       foreach ($ambilnama_barang as $ablKd) {
        $nama_barangBarang = $ablKd->nama_barang;
       }

       $data['nama_barang'] = $nama_barangBarang;
       $wherenama_barang = array('nama_barang' => $nama_barangBarang);
       $data['riwayat'] = $this->m_model->get_where($wherenama_barang, 'tb_riwayat')->result();
       $data['jumlah'] = $this->m_model->get_where($wherenama_barang, 'tb_riwayat')->num_rows();
       $data['title'] = 'Cetak Riwayat Stok Barang : ' . $nama_barangBarang;
       $data['id'] = $id;
       
       $this->load->view('admin/cetakRiwayatBarang', $data);
    }
    public function proses_pengembalian()
{
    date_default_timezone_set('Asia/Jakarta');

    $id_barang        = $this->input->post('id');
    $id_merchant      = $this->input->post('id_merchant'); // Menerima ID, bukan nama
    $returned_serials = $this->input->post('returned_serials');
    $kondisi_serials  = $this->input->post('kondisi');

    if (empty($returned_serials)) {
        $this->session->set_flashdata('pesan_error', 'Tidak ada serial number yang dipilih untuk dikembalikan!');
        redirect('index.php/admin/barang');
    }

    // Ambil detail merchant dari database
    $merchant = $this->m_model->get_where(['id_merchant' => $id_merchant], 'tb_merchant')->row();

    $stok_bertambah = 0;

    foreach ($returned_serials as $sn) {
        $kondisi = isset($kondisi_serials[$sn]) ? $kondisi_serials[$sn] : 'Bagus';
        $status_baru = ($kondisi == 'Bagus') ? 'Tersedia' : 'Rusak';

        if ($status_baru == 'Tersedia') {
            $stok_bertambah++;
        }

        $where_serial = ['serial_number' => $sn, 'id_barang' => $id_barang];
        $data_update_serial = ['status' => $status_baru, 'keterangan' => 'Dikembalikan oleh ' . $merchant->nama_merchant . ' (Kondisi: ' . $kondisi . ')'];
        $this->m_model->update($where_serial, $data_update_serial, 'tb_serial_number');
    }

    if ($stok_bertambah > 0) {
        $barang = $this->m_model->get_where(['id' => $id_barang], 'tb_barang')->row();
        $stok_baru = $barang->stok + $stok_bertambah;
        $this->m_model->update(['id' => $id_barang], ['stok' => $stok_baru], 'tb_barang');
    }

    $jumlah_kembali = count($returned_serials);
    $serial_string = implode(', ', $returned_serials);
    $barang = $this->m_model->get_where(['id' => $id_barang], 'tb_barang')->row();
    $data_riwayat = array(
        'nama_barang' => $barang->nama_barang,
        'kode'        => $serial_string,
        'jumlah'      => $jumlah_kembali,
        'jenis'       => 'Pengembalian',
        'createDate'  => date('Y-m-d H:i:s'),
        'unit'        => $merchant->nama_merchant,     // Gunakan nama & telepon
        'noTlp'       => $merchant->telepon_merchant,  // dari merchant yg sudah diambil
        'deskripsi'   => "$jumlah_kembali barang dikembalikan. ($stok_bertambah Bagus, " . ($jumlah_kembali - $stok_bertambah) . " Rusak)",
    );
    $this->m_model->insert($data_riwayat, 'tb_riwayat');

    $this->session->set_flashdata('pesan', 'Transaksi pengembalian berhasil dicatat!');
    redirect('index.php/admin/barang');
}
public function detail($id_barang)
    {
        // 1. Ambil data barang utama (untuk judul, dll)
        $data['barang'] = $this->m_model->get_where(['id' => $id_barang], 'tb_barang')->row();

        // Jika barang utama tidak ditemukan, kembalikan ke halaman daftar
        if (empty($data['barang'])) {
            $this->session->set_flashdata('pesan_error', 'Data barang tidak ditemukan!');
            redirect('index.php/admin/barang');
        }

        // 2. Ambil semua serial number yang terkait dengan barang ini dari model
        $data['list_serial'] = $this->m_model->get_serial_by_barang_id($id_barang)->result();

        // 3. Hitung jumlah stok berdasarkan status untuk ditampilkan di header halaman detail
        $data['stok_tersedia'] = 0;
        $data['stok_dipinjam'] = 0;
        foreach ($data['list_serial'] as $serial) {
            if ($serial->status == 'Tersedia') {
                $data['stok_tersedia']++;
            } else if ($serial->status == 'Dipinjam') {
                $data['stok_dipinjam']++;
            }
        }

        // 4. Set judul halaman dan muat view
        $data['title'] = 'Detail Serial Number';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/detail_barang', $data);
        $this->load->view('admin/templates/footer');
    }
    /**
     * Fungsi untuk memproses penambahan banyak serial number sekaligus
     * dari textarea, sudah terintegrasi dengan update stok.
     */
    public function tambah_serial_batch()
{
    // 1. Ambil data dari form
    $id_barang = $this->input->post('id_barang');
    $list_serial_string = $this->input->post('list_serial_number');

    // 2. Ambil data stok saat ini
    $barang = $this->m_model->get_where(['id' => $id_barang], 'tb_barang')->row();
    if (!$barang) {
        $this->session->set_flashdata('pesan_error', 'ID Barang tidak valid!');
        redirect('index.php/admin/barang');
    }
    $stok_sekarang = $barang->stok;

    // 3. Siapkan array untuk laporan hasil
    $berhasil_disimpan = [];
    $gagal_karena_duplikat = [];
    
    // 4. Proses setiap baris dari textarea
    $serial_numbers = preg_split('/\\r\\n|\\r|\\n/', $list_serial_string);
    foreach ($serial_numbers as $sn) {
        $serial_bersih = trim($sn);

        // Lewati jika baris kosong
        if (empty($serial_bersih)) {
            continue;
        }

        // --- VALIDASI DUPLIKAT DIMULAI DI SINI ---
        $this->db->where('serial_number', $serial_bersih);
        $jumlah_ditemukan = $this->db->count_all_results('tb_serial_number');

        if ($jumlah_ditemukan > 0) {
            // Jika ditemukan > 0, berarti sudah ada. Masukkan ke daftar gagal.
            $gagal_karena_duplikat[] = $serial_bersih;
        } else {
            // Jika tidak ditemukan, simpan data baru.
            $data = [
                'id_barang'     => $id_barang,
                'serial_number' => $serial_bersih,
                'status'        => 'Tersedia'
            ];
            $this->m_model->insert($data, 'tb_serial_number');
            
            // Tambahkan ke daftar berhasil dan update hitungan stok
            $berhasil_disimpan[] = $serial_bersih;
            $stok_sekarang++;
        }
        // --- VALIDASI DUPLIKAT SELESAI ---
    }

    // 5. Update stok akhir di tb_barang jika ada yang berhasil disimpan
    if (count($berhasil_disimpan) > 0) {
        $this->m_model->update(['id' => $id_barang], ['stok' => $stok_sekarang], 'tb_barang');
    }
    
    // 6. Buat pesan notifikasi yang detail
    $pesan_sukses = '';
    $pesan_error = '';

    if (!empty($berhasil_disimpan)) {
        $pesan_sukses = '<strong>' . count($berhasil_disimpan) . ' serial number berhasil ditambahkan:</strong> ' . implode(', ', $berhasil_disimpan) . '.';
    }

    if (!empty($gagal_karena_duplikat)) {
        $pesan_error = '<strong>' . count($gagal_karena_duplikat) . ' serial number gagal karena sudah terdaftar:</strong> ' . implode(', ', $gagal_karena_duplikat) . '.';
    }

    // Atur notifikasi flashdata
    if (!empty($pesan_sukses)) {
        $this->session->set_flashdata('pesan', $pesan_sukses);
    }
    if (!empty($pesan_error)) {
        // Jika sudah ada pesan sukses, gabungkan. Jika tidak, buat baru.
        $pesan_sebelumnya = $this->session->flashdata('pesan_error');
        $this->session->set_flashdata('pesan_error', $pesan_sebelumnya . '<br>' . $pesan_error);
    }
    
    redirect('index.php/admin/barang/detail/' . $id_barang);
}
    public function ubah_status_serial()
    {
        // Ambil data dari form modal
        $id_serial = $this->input->post('id_serial');
        $id_barang = $this->input->post('id_barang');
        $status_baru = $this->input->post('status');
        $keterangan = $this->input->post('keterangan');

        // Ambil data lama untuk perbandingan update stok
        $serial_lama = $this->m_model->get_where(['id_serial' => $id_serial], 'tb_serial_number')->row();
        if (!$serial_lama) {
            $this->session->set_flashdata('pesan_error', 'Serial number tidak ditemukan!');
            redirect('index.php/admin/barang/detail/' . $id_barang);
        }
        $status_lama = $serial_lama->status;
        
        $barang = $this->m_model->get_where(['id' => $id_barang], 'tb_barang')->row();
        $stok_sekarang = $barang->stok;

        // Tentukan apakah stok perlu ditambah atau dikurangi
        if ($status_lama == 'Tersedia' && $status_baru != 'Tersedia') {
            $stok_sekarang--;
        } elseif ($status_lama != 'Tersedia' && $status_baru == 'Tersedia') {
            $stok_sekarang++;
        }

        // Update status serial number di database
        $data_update_serial = ['status' => $status_baru, 'keterangan' => $keterangan];
        $where_serial = ['id_serial' => $id_serial];
        $this->m_model->update($where_serial, $data_update_serial, 'tb_serial_number');

        // Update stok di tb_barang
        $this->m_model->update(['id' => $id_barang], ['stok' => $stok_sekarang], 'tb_barang');

        $this->session->set_flashdata('pesan', 'Status serial number berhasil diubah dan stok telah diupdate!');
        redirect('index.php/admin/barang/detail/' . $id_barang);
    }
    /**
     * Fungsi untuk menghapus satu data serial number berdasarkan ID-nya.
     * Versi ini sudah terintegrasi dengan update stok otomatis.
     */
    public function hapus_serial($id_serial, $id_barang)
    {
        // Cek status serial number SEBELUM dihapus untuk penyesuaian stok
        $where_serial = array('id_serial' => $id_serial);
        $serial = $this->m_model->get_where($where_serial, 'tb_serial_number')->row();
        
        if ($serial) {
            // Jika yang dihapus adalah stok tersedia, kurangi stok di tb_barang
            if ($serial->status == 'Tersedia') {
                $barang = $this->m_model->get_where(['id' => $id_barang], 'tb_barang')->row();
                $stok_baru = $barang->stok - 1;
                $this->m_model->update(['id' => $id_barang], ['stok' => $stok_baru], 'tb_barang');
            }
        }

        // Lakukan proses delete serial number
        $this->m_model->delete($where_serial, 'tb_serial_number');

        $this->session->set_flashdata('pesan', 'Serial number berhasil dihapus dan stok telah disesuaikan!');
        redirect('index.php/admin/barang/detail/' . $id_barang);
    }
}