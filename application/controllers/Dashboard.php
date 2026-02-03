<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->model('Kategori_model');
    }

    public function index() {
        $data['title'] = 'CRM Dashboard';
        
        // Mengambil statistik ringkas
        $data['total_produk'] = $this->db->count_all('produk');
        $data['total_kategori'] = $this->db->count_all('kategori');
        $data['bisa_dijual'] = $this->db->where('id_status', 1)->from('produk')->count_all_results();
        $data['tidak_bisa_dijual'] = $this->db->where('id_status', 2)->from('produk')->count_all_results();

        // Data untuk Grafik: Jumlah produk per kategori
        $this->db->select('k.nama_kategori, COUNT(p.id_produk) as jumlah');
        $this->db->from('kategori k');
        $this->db->join('produk p', 'p.id_kategori = k.id_kategori', 'left');
        $this->db->group_by('k.id_kategori');
        $data['statistik_kategori'] = $this->db->get()->result();

        $data['content'] = 'dashboard_view';
        $this->load->view('layout', $data);
    }
}