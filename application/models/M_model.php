<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_model extends CI_Model {

    public function get_where($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function insert($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function get($table)
    {
        $this->db->ORDER_BY('id', 'DESC');
        return $this->db->get($table);
    }

    public function delete($where, $table)
    {
        $this->db->delete($table, $where);
    }

    public function update($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

     public function get_serial_by_barang_id($id_barang)
    {
        $this->db->from('tb_serial_number');
        $this->db->where('id_barang', $id_barang);
        $this->db->order_by('status', 'ASC'); // Mengurutkan agar 'Tersedia' di atas
        return $this->db->get();
    }

    public function get_available_serials($id_barang)
    {
        $this->db->from('tb_serial_number');
        $this->db->where('id_barang', $id_barang);
        $this->db->where('status', 'Tersedia');
        return $this->db->get();
    }

    public function get_borrowed_serials($id_barang)
    {
        $this->db->from('tb_serial_number');
        $this->db->where('id_barang', $id_barang);
        $this->db->where('status', 'Dipinjam');
        return $this->db->get();
    }
     public function get_merchants_with_user()
    {
        $this->db->select('tb_merchant.*, tb_user.nama as nama_user');
        $this->db->from('tb_merchant');
        // Gunakan LEFT JOIN agar merchant yang belum punya PIC tetap tampil
        $this->db->join('tb_user', 'tb_merchant.id_user = tb_user.id', 'left');
        $this->db->order_by('id_merchant', 'DESC');
        return $this->db->get();
    }
    public function get_barang_with_user()
{
    $this->db->select('tb_barang.*, tb_user.nama as nama_penginput');
    $this->db->from('tb_barang');
    // Gunakan LEFT JOIN agar barang yang data user-nya kosong (data lama) tetap tampil
    $this->db->join('tb_user', 'tb_barang.id_user_input = tb_user.id', 'left');
    $this->db->order_by('id', 'DESC');
    return $this->db->get();
}

}