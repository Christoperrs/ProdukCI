<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

/**
 * Class constructor.
 *
 * Load model Produk_model and library form_validation.
 *
 * @return void
 */
    public function __construct() {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->library('form_validation');
    }
/**

 * Menampilkan halaman index yang berisi mengambil data dari model dan menampilkan view yang sesuai.
 *
 * @return void
 */
    public function index() {
        $data['produks'] = $this->Produk_model->get_all_produk();
        
        $data['content'] = 'produk_view'; 
        
        $this->load->view('layout', $data); 
    }
/**
 * Menampilkan form tambah produk yang berisi mengambil data dari model dan menampilkan view yang sesuai.
 * 
 * @return void
 */
    public function tambah() {
        $data['title'] = 'Tambah Produk';
        $data['kategori'] = $this->Produk_model->get_all_kategori(); 
        $data['status'] = $this->Produk_model->get_all_status();
        $data['content'] = 'produk_form'; 
        $this->load->view('layout', $data);
    }
    
/**
 * Function to edit a product.
 *
 * @param int $id
 * @return void
 *
 * This function will edit a product based on the given id.
 * It will load the view 'produk_form' and pass the data to it.
 */
    public function edit($id) {
        $data['title'] = 'Edit Produk';
        $data['produk'] = $this->Produk_model->get_produk_by_id($id); 
        $data['kategori'] = $this->Produk_model->get_all_kategori();
        $data['status'] = $this->Produk_model->get_all_status();
        $data['content'] = 'produk_form';
        $this->load->view('layout', $data);
    }
/**
 * Hapus produk berdasarkan id produk
 * Menghapus produk berdasarkan id produk
 * Set flash data 'pesan' dengan value 'Data berhasil diproses!' setelah menghapus produk
 * Redirect ke halaman 'produk' setelah menghapus produk
 */
    public function delete($id) {
        $this->Produk_model->delete_produk($id);
        $this->session->set_flashdata('pesan', 'Data berhasil diproses!');
        redirect('produk');
    }
    /**
     * Fungsi untuk mengambil data produk dari API Fastprint.
     * 
     * @return void
     */
    public function fetch_from_api() {
        $jam = date('H');
        $username = "tesprogrammer" . date('dmy') . "C" . $jam ; 
        $password = md5("bisacoding-" . date('d-m-y'));

        $url = "https://recruitment.fastprint.co.id/tes/api_tes_programmer";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'username' => $username,
            'password' => $password
        ]);
        
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        if (isset($result['error']) && $result['error'] == 0) {
            $this->Produk_model->save_batch_api($result['data']);
            echo "Berhasil sinkronisasi " . count($result['data']) . " data.";
        } else {
            echo "<h3>Gagal Sinkronisasi!</h3>";
            echo "Pesan Error: " . ($result['ket'] ?? 'Koneksi API bermasalah') . "<br>";
            echo "<hr>";
            echo "<strong>Detail Credentials yang dikirim:</strong><br>";
            echo "URL: " . $url . "<br>";
            echo "Username: <code style='color:red'>" . $username . "</code><br>";
            echo "Password (Plain): <code>bisacoding-" . date('d-m-y') . "</code><br>";
            echo "Password (MD5): <code style='color:blue'>" . $password . "</code><br>";
            echo "Waktu Server Anda: " . date('Y-m-d H:i:s') . "<br>";
            echo "<hr>";
            echo "Response API: " . $response;
        }
    }
}