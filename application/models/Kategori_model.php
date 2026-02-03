<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

    // Nama tabel di database
    protected $table = 'kategori';

    /**
     * Mengambil semua data kategori
     */
    public function get_all() {
        return $this->db->get($this->table)->result();
    }

    /**
     * Mengambil satu data kategori berdasarkan ID
     */
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id_kategori' => $id])->row();
    }

    /**
     * Menambah data kategori baru
     */
    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    /**
     * Memperbarui data kategori
     */
    public function update($id, $data) {
        $this->db->where('id_kategori', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Menghapus data kategori
     */
    public function delete($id) {
        $this->db->where('id_kategori', $id);
        return $this->db->delete($this->table);
    }

    /**
     * Mengecek apakah kategori sedang digunakan oleh tabel produk
     * Ini penting untuk integritas data (Foreign Key Protection)
     */
    public function check_usage($id) {
        // Menghitung jumlah produk yang memiliki kategori_id tersebut
        $this->db->where('kategori_id', $id);
        $query = $this->db->get('produk');
        
        // Jika jumlahnya lebih dari 0, berarti kategori masih dipakai
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }
}