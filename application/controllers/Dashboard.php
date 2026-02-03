<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->model('Kategori_model');
    }

/**
 * Index page for CRM Dashboard
 *
 * This function is used to display the dashboard of CRM application.
 * It will display the total number of products, categories, and the number of products that are or are not suitable for sale.
 *
 * The function will also display the statistical data of products per category.
 *
 * @return void
 */
public function index() {
    $data['title'] = 'CRM Dashboard';
    
    // 1. Mengambil statistik total
    $data['total_produk'] = $this->db->count_all('produk');
    $data['total_kategori'] = $this->db->count_all('kategori');

    // Mengambil ID secara dinamis berdasarkan nama status (lebih aman)
    // Sesuai skema: status_id di tabel produk merujuk ke id_status di tabel status
    $status_bisa = $this->db->get_where('status', ['nama_status' => 'bisa dijual'])->row();
    $status_tidak = $this->db->get_where('status', ['nama_status' => 'tidak bisa dijual'])->row();

    $data['bisa_dijual'] = 0;
    if ($status_bisa) {
        $data['bisa_dijual'] = $this->db->where('status_id', $status_bisa->id_status)
                                        ->from('produk')
                                        ->count_all_results();
    }

    $data['tidak_bisa_dijual'] = 0;
    if ($status_tidak) {
        $data['tidak_bisa_dijual'] = $this->db->where('status_id', $status_tidak->id_status)
                                              ->from('produk')
                                              ->count_all_results();
    }

    // 2. Statistik untuk Grafik (Produk per Kategori)
    $this->db->select('k.nama_kategori, COUNT(p.id_produk) as jumlah');
    $this->db->from('kategori k');
    
    /** * ANALISIS JOIN BERDASARKAN QUERY SQL KAMU:
     * FK di tabel produk adalah: kategori_id
     * PK di tabel kategori adalah: id_kategori
     */
    $this->db->join('produk p', 'p.kategori_id = k.id_kategori', 'left'); 
    
    $this->db->group_by('k.id_kategori'); // Mengelompokkan berdasarkan PK Kategori
    $data['statistik_kategori'] = $this->db->get()->result();

    $data['content'] = 'dashboard_view';
    $this->load->view('layout', $data);
}
}