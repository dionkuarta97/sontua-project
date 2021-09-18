<?php

namespace App\Controllers;

use App\Models\ProductBumnagModel;

class ProductBumnag extends BaseController
{

    public function __construct()
    {
        $this->ProductBumnagModel = new ProductBumnagModel();
    }

    public function index()
    {

        $data = [
            'tittle' => 'Product Bumnag',
        ];

        echo view('layout/v_wrapper', $data);
    }


    public function detail($id)
    {

        $data = [
            'tittle' => 'Product Bumnag',
            'get_kategori' => $this->ProductBumnagModel->get_kategori(),
            'get_product' => $this->ProductBumnagModel->get_product($id),
            'get_nama' => $this->ProductBumnagModel->get_namaKategori($id),
            'id' => $id,
            'isi' => 'Admin/v_product',
        ];

        echo view('layout/v_wrapper', $data);
    }

    public function proses($id)
    {

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
                'nama_productBumnag'  => $this->request->getPost('nama_productBumnag'),
                'harga_productBumnag'  => $this->request->getPost('harga_productBumnag'),
                'jenis_product'  => $this->request->getPost('jenis_product'),
                'id_kategori' => $id,
                'img_product' => $upload->getName()
            );
            $this->ProductBumnagModel->simpan_product($data);
            session()->setFlashdata('sukses', 'Data Berhasil di Simpan');
            return redirect()->to(base_url('ProductBumnag/detail/' . $id));
        }
    }
}
