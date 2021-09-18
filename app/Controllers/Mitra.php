<?php

namespace App\Controllers;

use App\Models\MitraModel;

class Mitra extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->MitraModel = new MitraModel();
    }

    public function index()
    {

        $data = [
            'tittle' => 'Mitra',
            'isi' => 'Admin/v_mitra',
            'get_mitra' => $this->MitraModel->get_mitra(),
            'get_kategori' => $this->MitraModel->get_kategori()
        ];

        echo view('layout/v_wrapper', $data);
    }

    public function tambah_mitra()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'bagi_hasil' => $this->request->getPost('bagi_hasil')

        ];

        $this->MitraModel->tambah_mitra($data);
        session()->setFlashdata('sukses', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('Mitra'));
    }

    public function hapus_mitra($id)
    {
        $this->MitraModel->hapus_mitra($id);
        session()->setFlashdata('sukses', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('Mitra'));
    }

    public function edit_mitra($id)
    {

        $data = [
            'nama' => $this->request->getPost('nama'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'bagi_hasil' => $this->request->getPost('bagi_hasil')

        ];


        $this->MitraModel->edit_mitra($data, $id);
        session()->setFlashdata('sukses', 'Data Berhasil Diubah');
        return redirect()->to(base_url('Mitra'));
    }
}
