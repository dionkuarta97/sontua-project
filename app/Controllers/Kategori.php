<?php

namespace App\Controllers;

use App\Models\KategoriModel;


class Kategori extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->KategoriModel = new KategoriModel();
    }
    public function index()
    {

        $data = [
            'tittle' => 'Kategori',
            'get_kategori' => $this->KategoriModel->get_kategori(),
            'isi' => 'Admin/v_kategori',
        ];

        echo view('layout/v_wrapper', $data);
    }


    public function tambah_kategori()
    {
        $data = [
            'kategori' => $this->request->getPost('kategori')

        ];

        $this->KategoriModel->tambah_kategori($data);
        session()->setFlashdata('sukses', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('Kategori'));
    }


    public function edit_kategori($id)
    {


        $data = [
            'kategori' => $this->request->getPost('kategori'),

        ];


        $this->KategoriModel->edit_kategori($data, $id);
        session()->setFlashdata('sukses', 'Data Berhasil Diubah');
        return redirect()->to(base_url('Kategori'));
    }

    public function hapus_kategori($id)
    {
        $this->KategoriModel->hapus_kategori($id);
        session()->setFlashdata('sukses', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('Kategori'));
    }
}
