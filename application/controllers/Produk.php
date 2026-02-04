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
        
        // PERBAIKAN: Tambahkan 'produk/' sebelum nama file
        $data['content'] = 'produk/produk_form'; 
        
        $this->load->view('layout', $data);
    }

/**
 * Simpan produk.
 *
 * Validasi input (Nama wajib diisi, Harga wajib angka)
 *
 * @return void
 */
    public function simpan() {
        // Poin 7: Validasi input (Nama wajib diisi, Harga wajib angka)
        $this->form_validation->set_rules('id_produk', 'ID Produk', 'required|numeric|is_unique[produk.id_produk]');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = [
                'id_produk'   => $this->input->post('id_produk'),
                'nama_produk' => $this->input->post('nama_produk'),
                'harga'       => $this->input->post('harga'),
                'kategori_id' => $this->input->post('kategori_id'),
                'status_id'   => $this->input->post('status_id')
            ];
            $this->Produk_model->insert_produk($data);
            $this->session->set_flashdata('pesan', 'Data berhasil disimpan!');
            redirect('produk');
        }
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
        
        // PERBAIKAN: Sesuaikan folder view menjadi 'produk/produk_form'
        $data['content'] = 'produk/produk_form';
        
        $this->load->view('layout', $data);
    }
    /**
     * Mengupdate produk berdasarkan id produk
     * Mengupdate produk berdasarkan id produk
     * Set flash data 'pesan' dengan value 'Data berhasil diperbarui!' setelah mengupdate produk
     * Redirect ke halaman 'produk' setelah mengupdate produk
     */
    public function update() {
        $id = $this->input->post('id_produk');
        
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            $data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'harga'       => $this->input->post('harga'),
                'kategori_id' => $this->input->post('kategori_id'),
                'status_id'   => $this->input->post('status_id')
            ];
            $this->Produk_model->update_produk($id, $data);
            $this->session->set_flashdata('pesan', 'Data berhasil diperbarui!');
            redirect('produk');
        }
    }


/**
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
            $this->session->set_flashdata('pesan', 'Berhasil sinkronisasi ' . count($result['data']) . ' data dari API.');
            redirect('produk');
        } else {
            $pesan_error = isset($result['ket']) ? $result['ket'] : 'Koneksi API bermasalah';
            $this->session->set_flashdata('error', 'Gagal Sinkronisasi: ' . $pesan_error);
            
            redirect('produk');
        }
    }
}