<?php

namespace App\Controllers;


use App\Models\UserModel;

class User extends BaseController
{


    public function __construct()
    {
        helper('form');
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        $id_mitra = session()->get('id_mitra');

        $today = $this->UserModel->pemasukan_today($id_mitra);
        $total_today = 0;
        $all = $this->UserModel->pemasukan_all($id_mitra);
        $total_all = 0;


        foreach ($today as $key) {
            $newPersen = 100 - $key['bagi_hasil'];
            $newPrice = $key['harga_product'] * ($newPersen / 100);
            $total_today += $key['jumlah'] * $newPrice;
        }


        foreach ($all as $key) {
            $newPersen = 100 - $key['bagi_hasil'];
            $newPrice = $key['harga_product'] * ($newPersen / 100);
            $total_all += $key['jumlah'] * $newPrice;
        }



        $data = [
            'tittle' => 'Dashboard',
            'get_kategori' => $this->UserModel->get_kategori($id_mitra),
            'isi' => 'User/v_user',
            'count_today' => $this->UserModel->count_order_today($id_mitra),
            'count_all' => $this->UserModel->count_order_all($id_mitra),
            'total_today' => $total_today,
            'total_all' => $total_all
        ];

        echo view('layout/v_wrapper', $data);
    }

    public function detail($id)
    {

        $id_mitra = session()->get('id_mitra');
        $nama_mitra = session()->get('nama');
        $data = [
            'tittle' => 'Product',
            'get_kategori' => $this->UserModel->get_kategori($id_mitra),
            'get_product' => $this->UserModel->get_product($id, $id_mitra),
            'get_nama' => $this->UserModel->get_namaKategori($id, $id_mitra),
            'nama_mitra' => $nama_mitra,
            'id' => $id,
            'isi' => 'User/v_product',
        ];

        echo view('layout/v_wrapper', $data);
    }

    public function proses($id)
    {

        $id_mitra = session()->get('id_mitra');

        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('upload');
        }
        $validation = $this->validate([
            'file_upload' => 'uploaded[file_upload]|mime_in[file_upload,image/jpg,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]'
        ]);

        if ($validation == FALSE) {

            return $this->index();
        } else {
            $upload = $this->request->getFile('file_upload');
            $upload->move(WRITEPATH . '../public/img/');
            $data = array(
                'nama_product'  => $this->request->getPost('nama_product'),
                'harga_product'  => $this->request->getPost('harga_product'),
                'jenis_product'  => $this->request->getPost('jenis_product'),
                'id_kategori' => $id,
                'id_mitra' => $id_mitra,
                'img_product' => $upload->getName()
            );
            $this->UserModel->simpan_product($data);
            session()->setFlashdata('sukses', 'Data Berhasil di Simpan');
            return redirect()->to(base_url('User/detail/' . $id));
        }
    }

    public function edit_product($id, $id_product)
    {


        $data = [
            'nama_product'  => $this->request->getPost('nama_product'),
            'harga_product'  => $this->request->getPost('harga_product'),
            'jenis_product'  => $this->request->getPost('jenis_product'),

        ];


        $this->UserModel->edit_product($data, $id_product);
        session()->setFlashdata('sukses', 'Data Berhasil Diubah');
        return redirect()->to(base_url('User/detail/' . $id));
    }

    public function hapus_product($id_kategori, $id_product)
    {
        $this->UserModel->hapus_product($id_product);
        session()->setFlashdata('sukses', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('User/detail/' . $id_kategori));
    }
}
