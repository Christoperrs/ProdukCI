<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Kategori_model');
    }

/**
 * Menampilkan halaman index untuk menampilkan data kategori
 *
 * @return void
 */
    public function index() {
        $data['title'] = 'Master Kategori';
        $data['kategori'] = $this->Kategori_model->get_all();
        $data['content'] = 'kategori_view';
        $this->load->view('layout', $data);
    }

/**
 * Menampilkan halaman tambah untuk menambah data kategori
 *
 * @return void
 */
    public function tambah() {
        $data['title'] = 'Tambah Kategori';
        $data['content'] = 'kategori/kategori_form';
        $this->load->view('layout', $data);
    }

/**
 * Menampilkan halaman edit untuk mengedit data kategori
 * @param int $id id kategori
 * @return void
 */
    public function edit($id) {
        $data['title'] = 'Edit Kategori';
        $data['kat'] = $this->Kategori_model->get_by_id($id);
        $data['content'] = 'kategori/kategori_form';
        $this->load->view('layout', $data);
    }

/**
 * Simpan kategori
 *
 * @param string $nama nama kategori yang akan disimpan
 * @return void
 */
    public function simpan() {
        $nama = $this->input->post('nama_kategori');
        $this->Kategori_model->insert(['nama_kategori' => $nama]);
        $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan!');
        redirect('kategori');
    }

/**
 * Mengupdate kategori
 * @param string $nama nama kategori yang akan diperbarui
 * @return void
 */
    public function update() {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama_kategori');
        $this->Kategori_model->update($id, ['nama_kategori' => $nama]);
        $this->session->set_flashdata('success', 'Kategori berhasil diperbarui!');
        redirect('kategori');
    }

    public function hapus($id) {
/**
 * Hapus kategori
 *
 * @param int $id id kategori yang akan dihapus
 *
 * @return void
 *
 * @throws Exception jika kategori tidak bisa dihapus karena masih digunakan oleh produk
 */
        $terpakai = $this->Kategori_model->check_usage($id);
        if ($terpakai) {
            $this->session->set_flashdata('error', 'Kategori tidak bisa dihapus karena masih digunakan oleh produk!');
        } else {
            $this->Kategori_model->delete($id);
            $this->session->set_flashdata('success', 'Kategori berhasil dihapus!');
        }
        redirect('kategori');
    }
}