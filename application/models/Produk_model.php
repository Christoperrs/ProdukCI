<?php
class Produk_model extends CI_Model {

    public function save_batch_api($data) {
        foreach ($data as $row) {
            $kategori_id = $this->get_or_insert('kategori', 'id_kategori', ['nama_kategori' => $row['kategori']]);
            
            $status_id = $this->get_or_insert('status', 'id_status', ['nama_status' => $row['status']]);

            $data_produk = [
                'id_produk'   => $row['id_produk'],
                'nama_produk' => $row['nama_produk'],
                'harga'       => $row['harga'],
                'kategori_id' => $kategori_id,
                'status_id'   => $status_id
            ];

            $exists = $this->db->get_where('produk', ['id_produk' => $row['id_produk']])->row();
            if ($exists) {
                $this->db->update('produk', $data_produk, ['id_produk' => $row['id_produk']]);
            } else {
                $this->db->insert('produk', $data_produk);
            }
        }
    }

    private function get_or_insert($table, $pk, $where) {
        $query = $this->db->get_where($table, $where)->row();
        if ($query) {
            return $query->$pk;
        } else {
            $this->db->insert($table, $where);
            return $this->db->insert_id();
        }
    }
    public function get_all_produk() {
        $this->db->select('produk.*, kategori.nama_kategori, status.nama_status');
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id_kategori = produk.kategori_id');
        $this->db->join('status', 'status.id_status = produk.status_id');
        $this->db->where('status.nama_status', 'bisa dijual'); 
        
        return $this->db->get()->result();
    }
    public function get_produk_by_id($id) {
        return $this->db->get_where('produk', ['id_produk' => $id])->row();
    }

    public function get_all_kategori() {
        return $this->db->get('kategori')->result();
    }

    public function get_all_status() {
        return $this->db->get('status')->result();
    }

    public function insert_produk($data) {
        return $this->db->insert('produk', $data);
    }

    public function update_produk($id, $data) {
        return $this->db->update('produk', $data, ['id_produk' => $id]);
    }

    public function delete_produk($id) {
        return $this->db->delete('produk', ['id_produk' => $id]);
    }   
}   