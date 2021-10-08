<?php

namespace App\Controllers;

use App\Models\MitraModel;
use App\Models\UserModel;
use App\Models\OrderModel;

class Mitra extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->MitraModel = new MitraModel();
        $this->UserModel = new UserModel();
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
        $data = [
            'del' => 2

        ];


        $this->MitraModel->edit_mitra($data, $id);
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

    public function detail($id_mitra)
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
                    'isi' => 'Admin/v_detail_mitra',
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
                    'isi' => 'Admin/v_detail_mitra',
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
                    'isi' => 'Admin/v_detail_mitra',
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
                    'isi' => 'Admin/v_detail_mitra',
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
