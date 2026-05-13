<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id')){
            redirect('index.php/welcome');
        }
    }

    public function index()
    {
        $data['title'] = 'Data Merchant';
        // Menggunakan fungsi baru dari model untuk mendapatkan data join
        $data['merchants'] = $this->m_model->get_merchants_with_user()->result();
        // Mengambil daftar user untuk dropdown di modal
        $data['users'] = $this->m_model->get('tb_user')->result();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/merchant', $data);
        $this->load->view('admin/templates/footer');
    }

    public function insert()
    {
        $data = array(
            'id_user'          => $this->input->post('id_user'), // Kolom baru
            'nama_merchant'    => $this->input->post('nama_merchant'),
            'alamat_merchant'  => $this->input->post('alamat_merchant'),
            'telepon_merchant' => $this->input->post('telepon_merchant')
        );

        $this->m_model->insert($data, 'tb_merchant');
        $this->session->set_flashdata('pesan', 'Merchant baru berhasil ditambahkan!');
        redirect('index.php/admin/merchant');
    }

    public function update()
    {
        $id_merchant = $this->input->post('id_merchant');
        $data = array(
            'id_user'          => $this->input->post('id_user'), // Kolom baru
            'nama_merchant'    => $this->input->post('nama_merchant'),
            'alamat_merchant'  => $this->input->post('alamat_merchant'),
            'telepon_merchant' => $this->input->post('telepon_merchant')
        );
        $where = array('id_merchant' => $id_merchant);

        $this->m_model->update($where, $data, 'tb_merchant');
        $this->session->set_flashdata('pesan', 'Data merchant berhasil diubah!');
        redirect('index.php/admin/merchant');
    }

    public function delete($id)
    {
        $where = array('id_merchant' => $id);
        $this->m_model->delete($where, 'tb_merchant');
        $this->session->set_flashdata('pesan', 'Data merchant berhasil dihapus!');
        redirect('index.php/admin/merchant');
    }
}