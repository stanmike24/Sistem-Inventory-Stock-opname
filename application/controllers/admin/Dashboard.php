<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Pastikan user sudah login (sesuaikan dengan sistem Anda)
        if(!$this->session->userdata('id')){
            redirect('index.php/welcome');
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        // --- MENGAMBIL DATA UNTUK KOTAK STATISTIK ---
        // Ganti 'tb_barang', 'tb_serial_number', dll. sesuai nama tabel Anda
        
        // Menghitung jumlah jenis barang
        $data['jumlah_barang'] = $this->db->count_all('tb_barang');
        
        // Menghitung jumlah total unit fisik (serial number)
        $data['jumlah_serial'] = $this->db->count_all('tb_serial_number');
        
        // Menghitung jumlah merchant
        $data['jumlah_merchant'] = $this->db->count_all('tb_merchant');
        
        // Menghitung jumlah barang yang statusnya 'Dipinjam'
        $this->db->where('status', 'Dipinjam');
        $data['barang_dipinjam'] = $this->db->count_all_results('tb_serial_number');
        // --- SELESAI MENGAMBIL DATA STATISTIK ---


        // --- MENGAMBIL 5 RIWAYAT TRANSAKSI TERAKHIR ---
        $this->db->order_by('createDate', 'DESC');
        $this->db->limit(5);
        $data['riwayat_terakhir'] = $this->db->get('tb_riwayat')->result();
        // --- SELESAI MENGAMBIL RIWAYAT ---

        // Mengirim semua data ke view
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/dashboard', $data); // View ini yang akan kita percantik
        $this->load->view('admin/templates/footer');
    }
}