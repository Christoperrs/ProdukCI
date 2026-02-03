<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->library('form_validation');
    }
    public function index() {
        // 1. Ambil data dari model
        $data['produks'] = $this->Produk_model->get_all_produk();
        
        // 2. Tentukan view mana yang akan dimasukkan ke dalam layout
        $data['content'] = 'produk_view'; 
        
        // 3. Load file layout utama, dan kirim data ke sana
        $this->load->view('layout', $data); 
    }
    public function tambah() {
        $data['title'] = 'Tambah Produk';
        $data['kategori'] = $this->Produk_model->get_all_kategori(); // Ambil dari model
        $data['status'] = $this->Produk_model->get_all_status();
        $data['content'] = 'produk_form'; // Nama file view form
        $this->load->view('layout', $data);
    }
    
    public function edit($id) {
        $data['title'] = 'Edit Produk';
        $data['produk'] = $this->Produk_model->get_produk_by_id($id); // Ambil data lama
        $data['kategori'] = $this->Produk_model->get_all_kategori();
        $data['status'] = $this->Produk_model->get_all_status();
        $data['content'] = 'produk_form';
        $this->load->view('layout', $data);
    }
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
            // Munculkan detail untuk debugging
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