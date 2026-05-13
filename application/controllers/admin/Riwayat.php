<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat extends CI_Controller {

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
        $data['title'] = 'Riwayat';
        $data['riwayat'] = $this->m_model->get('tb_riwayat')->result();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/riwayat', $data);
        $this->load->view('admin/templates/footer');
    }

    public function delete($id)
    {
        $where = array('id' => $id );

        $riwayatBarang = $this->m_model->get_where($where, 'tb_riwayat')->result();

        foreach ($riwayatBarang as $rBrg) {
            $dataRiwayat = array(
                'nama_barang'      => $rBrg->nama_barang,
                'jenis'     => $rBrg->jenis,
                'jumlah'    => $rBrg->jumlah
            );

            $whereBarang = array('nama_barang' => $rBrg->nama_barang);

            $barang = $this->m_model->get_where($whereBarang, 'tb_barang')->result();

            foreach ($barang as $brg) {
                $dataBarang = array(
                    'stok' => $brg->stok
                );
            }

            if($rBrg->jenis == 'Masuk'){
                $updateStok = array(
                    'stok' => $brg->stok - $rBrg->jumlah
                );
            } else {
                $updateStok = array(
                    'stok' => $brg->stok + $rBrg->jumlah
                );
            }
        }

        $this->m_model->delete($where, 'tb_riwayat');
        $this->m_model->update($whereBarang, $updateStok, 'tb_barang');
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus!');
        redirect('index.php/admin/riwayat');
    }

    public function update()
    {
        $id = $this->input->post('id');
        $jenis = $this->input->post('jenis');
        $jumlah = $this->input->post('jumlah');

        $where = array('id' => $id );
        
        $data = array(
            'jenis' => $jenis,
            'jumlah' => $jumlah, 
        );

        $this->m_model->update($where, $data, 'tb_riwayat');
        $this->session->set_flashdata('pesan', 'Data berhasil diubah!');
        redirect('index.php/admin/riwayat');
    }

    public function cetak()
    {
        $tgl_awal   = $this->input->POST('tgl_awal');
        $tgl_akhir  = $this->input->POST('tgl_akhir');

        $convertTglAwal = date('Y-m-d H:i:s', strtotime($tgl_awal . '00:01'));
        $convertTglAkhir = date('Y-m-d H:i:s', strtotime($tgl_akhir . '23:59'));

        $data['tgl_awal']   = $tgl_awal;
        $data['tgl_akhir']  = $tgl_akhir;

        $data['title'] = 'Cetak Riwayat Barang';
        $data['cetakData'] = $this->db->query("SELECT * FROM tb_riwayat WHERE createDate BETWEEN '".$convertTglAwal."' AND '".$convertTglAkhir."' ")->result();
        $data['jumlah'] = $this->db->query("SELECT COUNT(id) AS jumlahData FROM tb_riwayat WHERE createDate BETWEEN '".$convertTglAwal."' AND '".$convertTglAkhir."' ")->result();

        $this->load->view('admin/cetakRiwayatBarangCustom', $data);
    }

    public function exportExcel()
    {
        $tgl_awal   = $this->input->POST('tgl_awal');
        $tgl_akhir  = $this->input->POST('tgl_akhir');

        $convertTglAwal = date('Y-m-d H:i:s', strtotime($tgl_awal . '00:01'));
        $convertTglAkhir = date('Y-m-d H:i:s', strtotime($tgl_akhir . '23:59'));

        $data['tgl_awal']   = $tgl_awal;
        $data['tgl_akhir']  = $tgl_akhir;

        $data['title'] = 'Cetak Riwayat Barang';
        $data['cetakData'] = $this->db->query("SELECT * FROM tb_riwayat WHERE createDate BETWEEN '".$convertTglAwal."' AND '".$convertTglAkhir."' ")->result();
        $data['jumlah'] = $this->db->query("SELECT COUNT(id) AS jumlahData FROM tb_riwayat WHERE createDate BETWEEN '".$convertTglAwal."' AND '".$convertTglAkhir."' ")->result();

        $this->load->view('admin/exportExcel', $data);
    }
}