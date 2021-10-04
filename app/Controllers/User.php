<?php

namespace App\Controllers;


use App\Models\UserModel;
use App\Models\OrderModel;

class User extends BaseController
{


    public function __construct()
    {
        helper('form');
        $this->UserModel = new UserModel();
    }

    public function dashboard($id_mitra)
    {

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
            'total_all' => $total_all,
            'id_mitra' => $id_mitra
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

            return $this->dashboard($id_mitra);
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

    public function list_order($id_mitra)
    {

        $order = new OrderModel;
        $tanggal_awal = $this->request->getGet('tanggal_awal');
        $tanggal_akhir = $this->request->getGet('tanggal_akhir');
        $cari = $this->request->getGet('cari');



        if ($tanggal_awal == null && $tanggal_akhir == null) {
            if ($cari == null) {
                $all = $this->UserModel->pemasukan_all2($id_mitra);
                $total_all = 0;
                foreach ($all as $key) {
                    $newPersen = 100 - $key['bagi_hasil'];
                    $newPrice = $key['harga_product'] * ($newPersen / 100);
                    $total_all += $key['jumlah'] * $newPrice;
                }
                $data = [
                    'tittle' => 'List Order',
                    'get_kategori' => $this->UserModel->get_kategori($id_mitra),
                    'isi' => 'User/v_list',
                    'detail_mitra' => $this->UserModel->get_detail_mitra($id_mitra),
                    'currentPage' => $this->request->getVar('page_peoples') ? $this->request->getVar('page_peoples') : 1,
                    'list_order' => $order
                        ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
                        ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
                        ->where([
                            'tb_order.id_mitra' => $id_mitra,
                            'tb_pembeli.pembayaran' => 2
                        ])
                        ->orderby('tb_order.id_order', 'DESC')
                        ->paginate(10, 'peoples'),
                    'pager' => $order->pager,
                    'nomor' => nomor($this->request->getVar('page_peoples'), 10),
                    'cari' => $cari,
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir,
                    'total_all' => $total_all,
                    'count_all' => $this->UserModel->count_order_all2($id_mitra),
                    'id_mitra' => $id_mitra,
                ];
            } else {
                $all = $this->UserModel->pemasukan_all3($id_mitra, $cari);
                $total_all = 0;
                foreach ($all as $key) {
                    $newPersen = 100 - $key['bagi_hasil'];
                    $newPrice = $key['harga_product'] * ($newPersen / 100);
                    $total_all += $key['jumlah'] * $newPrice;
                }
                $data = [
                    'tittle' => 'List Order',
                    'get_kategori' => $this->UserModel->get_kategori($id_mitra),
                    'isi' => 'User/v_list',
                    'currentPage' => $this->request->getVar('page_peoples') ? $this->request->getVar('page_peoples') : 1,
                    'detail_mitra' => $this->UserModel->get_detail_mitra($id_mitra),
                    'list_order' => $order
                        ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
                        ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
                        ->where([
                            'tb_order.id_mitra' => $id_mitra,
                            'tb_pembeli.pembayaran' => 2
                        ])
                        ->like('nama_product', $cari)
                        ->orderby('tb_order.id_order', 'DESC')
                        ->paginate(10, 'peoples'),
                    'pager' => $order->pager,
                    'nomor' => nomor($this->request->getVar('page_peoples'), 10),
                    'cari' => $cari,
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir,
                    'total_all' => $total_all,
                    'count_all' => $this->UserModel->count_order_all3($id_mitra, $cari),
                    'id_mitra' => $id_mitra,

                ];
            }
        } else {
            if ($cari == null) {
                $all = $this->UserModel->pemasukan_all4($id_mitra, $tanggal_awal, $tanggal_akhir);
                $total_all = 0;
                foreach ($all as $key) {
                    $newPersen = 100 - $key['bagi_hasil'];
                    $newPrice = $key['harga_product'] * ($newPersen / 100);
                    $total_all += $key['jumlah'] * $newPrice;
                }
                $data = [
                    'tittle' => 'List Order',
                    'get_kategori' => $this->UserModel->get_kategori($id_mitra),
                    'isi' => 'User/v_list',
                    'detail_mitra' => $this->UserModel->get_detail_mitra($id_mitra),
                    'currentPage' => $this->request->getVar('page_peoples') ? $this->request->getVar('page_peoples') : 1,
                    'list_order' => $order
                        ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
                        ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
                        ->where([
                            'tb_order.id_mitra' => $id_mitra,
                            'tb_pembeli.pembayaran' => 2,
                            'DATE(tb_order.created_at) >=' => $tanggal_awal,
                            'DATE(tb_order.created_at) <=' => $tanggal_akhir,
                        ])
                        ->orderby('tb_order.id_order', 'DESC')
                        ->paginate(10, 'peoples'),
                    'pager' => $order->pager,
                    'nomor' => nomor($this->request->getVar('page_peoples'), 10),
                    'cari' => $cari,
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir,
                    'total_all' => $total_all,
                    'count_all' => $this->UserModel->count_order_all4($id_mitra, $tanggal_awal, $tanggal_akhir),
                    'id_mitra' => $id_mitra,
                ];
            } else {
                $all = $this->UserModel->pemasukan_all5($id_mitra, $cari, $tanggal_awal, $tanggal_akhir);
                $total_all = 0;
                foreach ($all as $key) {
                    $newPersen = 100 - $key['bagi_hasil'];
                    $newPrice = $key['harga_product'] * ($newPersen / 100);
                    $total_all += $key['jumlah'] * $newPrice;
                }
                $data = [
                    'tittle' => 'List Order',
                    'get_kategori' => $this->UserModel->get_kategori($id_mitra),
                    'isi' => 'User/v_list',
                    'detail_mitra' => $this->UserModel->get_detail_mitra($id_mitra),
                    'currentPage' => $this->request->getVar('page_peoples') ? $this->request->getVar('page_peoples') : 1,
                    'list_order' => $order
                        ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
                        ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
                        ->where([
                            'tb_order.id_mitra' => $id_mitra,
                            'tb_pembeli.pembayaran' => 2,
                            'DATE(tb_order.created_at) >=' => $tanggal_awal,
                            'DATE(tb_order.created_at) <=' => $tanggal_akhir,
                        ])
                        ->where("(nama_product LIKE '%" . $cari . "%')")
                        ->orderby('tb_order.id_order', 'DESC')
                        ->paginate(10, 'peoples'),
                    'pager' => $order->pager,
                    'nomor' => nomor($this->request->getVar('page_peoples'), 10),
                    'cari' => $cari,
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir,
                    'total_all' => $total_all,
                    'count_all' => $this->UserModel->count_order_all5($id_mitra, $cari, $tanggal_awal, $tanggal_akhir),
                    'id_mitra' => $id_mitra,
                ];
            }
        }
        echo view('layout/v_wrapper', $data);
    }
}
