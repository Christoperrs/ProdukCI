<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Kategori_model');
    }

    public function index() {
        $data['title'] = 'Master Kategori';
        $data['kategori'] = $this->Kategori_model->get_all();
        $data['content'] = 'kategori_view';
        $this->load->view('layout', $data);
    }

    public function tambah() {
        $data['title'] = 'Tambah Kategori';
        $data['content'] = 'kategori/kategori_form';
        $this->load->view('layout', $data);
    }

    public function edit($id) {
        $data['title'] = 'Edit Kategori';
        $data['kat'] = $this->Kategori_model->get_by_id($id);
        $data['content'] = 'kategori/kategori_form';
        $this->load->view('layout', $data);
    }

    public function simpan() {
        $nama = $this->input->post('nama_kategori');
        $this->Kategori_model->insert(['nama_kategori' => $nama]);
        $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan!');
        redirect('kategori');
    }

    public function update() {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama_kategori');
        $this->Kategori_model->update($id, ['nama_kategori' => $nama]);
        $this->session->set_flashdata('success', 'Kategori berhasil diperbarui!');
        redirect('kategori');
    }

    public function hapus($id) {
        // Cek relasi agar tidak error jika kategori masih dipakai produk
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