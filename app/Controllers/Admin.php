<?php

namespace App\Controllers;


use App\Models\DashboardModel;
use App\Models\OrderModel;

class Admin extends BaseController
{


    public function __construct()
    {
        helper('form');
        $this->DashboardModel = new DashboardModel();
    }

    public function index()
    {

        $data = [
            'tittle' => 'Dashboard',
            'get_kategori' => $this->DashboardModel->get_kategori(),
            'isi' => 'Admin/v_admin',
        ];

        echo view('layout/v_wrapper', $data);
    }

    public function kasir()
    {

        $data = [
            'tittle' => 'List Kasir',
            'get_kategori' => $this->DashboardModel->get_kategori(),
            'isi' => 'Admin/v_kasir',
            'kasir' => $this->DashboardModel->get_kasir(),
        ];
        echo view('layout/v_wrapper', $data);
    }

    public function tambah_kasir()
    {
        $data = [
            'nama' => $this->request->getPost('nama')

        ];

        $this->DashboardModel->tambah_kasir($data);
        session()->setFlashdata('sukses', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('Admin/kasir'));
    }


    public function edit_kasir($id)
    {


        $data = [
            'nama' => $this->request->getPost('nama'),

        ];


        $this->DashboardModel->edit_kasir($data, $id);
        session()->setFlashdata('sukses', 'Data Berhasil Diubah');
        return redirect()->to(base_url('Admin/kasir'));
    }

    public function hapus_kasir($id)
    {
        $data = [
            'dlt' => 2

        ];


        $this->DashboardModel->edit_kasir($data, $id);
        session()->setFlashdata('sukses', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('Admin/kasir'));
    }


    public function detail_kasir($id_kasir)
    {


        $order = new OrderModel;
        $tanggal_awal = $this->request->getGet('tanggal_awal');
        $tanggal_akhir = $this->request->getGet('tanggal_akhir');
        $cari = $this->request->getGet('cari');


        if ($tanggal_awal == null && $tanggal_akhir == null) {
            if ($cari == null) {
                $all = $this->DashboardModel->pemasukan_all($id_kasir);
                $total_all = 0;
                foreach ($all as $key) {
                    $newPrice = $key['harga_product'];
                    $total_all += $key['jumlah'] * $newPrice;
                }
                $data = [
                    'tittle' => 'Detail Kasir',
                    'get_kategori' => $this->DashboardModel->get_kategori(),
                    'isi' => 'Admin/v_detail_kasir',
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir,
                    'cari' => $cari,
                    'id' => $id_kasir,
                    'currentPage' => $this->request->getVar('page_peoples') ? $this->request->getVar('page_peoples') : 1,
                    'list_order' => $order
                        ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
                        ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
                        ->join('tb_kasir', 'tb_kasir.id_kasir = tb_order.id_kasir')
                        ->join('tb_kategori', 'tb_kategori.id_kategori = tb_order.id_kategori')
                        ->where([
                            'tb_order.id_kasir' => $id_kasir,
                        ])
                        ->orderby('tb_order.id_order', 'DESC')
                        ->paginate(10, 'peoples'),
                    'pager' => $order->pager,
                    'nomor' => nomor($this->request->getVar('page_peoples'), 10),
                    'total_all' => $total_all,
                    'count_all' => $this->DashboardModel->count_order_all($id_kasir),
                ];
            } else {
                $all = $this->DashboardModel->pemasukan_all2($id_kasir, $cari);
                $total_all = 0;
                foreach ($all as $key) {
                    $newPrice = $key['harga_product'];
                    $total_all += $key['jumlah'] * $newPrice;
                }
                $data = [
                    'tittle' => 'Detail Kasir',
                    'get_kategori' => $this->DashboardModel->get_kategori(),
                    'isi' => 'Admin/v_detail_kasir',
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir,
                    'cari' => $cari,
                    'id' => $id_kasir,
                    'currentPage' => $this->request->getVar('page_peoples') ? $this->request->getVar('page_peoples') : 1,
                    'list_order' => $order
                        ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
                        ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
                        ->join('tb_kasir', 'tb_kasir.id_kasir = tb_order.id_kasir')
                        ->join('tb_kategori', 'tb_kategori.id_kategori = tb_order.id_kategori')
                        ->where([
                            'tb_order.id_kasir' => $id_kasir,
                        ])
                        ->like('tb_product.nama_product', $cari)
                        ->orderby('tb_order.id_order', 'DESC')
                        ->paginate(10, 'peoples'),
                    'pager' => $order->pager,
                    'nomor' => nomor($this->request->getVar('page_peoples'), 10),
                    'total_all' => $total_all,
                    'count_all' => $this->DashboardModel->count_order_all2($id_kasir, $cari),
                ];
            }
        } else {
            if ($cari == null) {
                $all = $this->DashboardModel->pemasukan_all3($id_kasir, $tanggal_awal, $tanggal_akhir);
                $total_all = 0;
                foreach ($all as $key) {
                    $newPrice = $key['harga_product'];
                    $total_all += $key['jumlah'] * $newPrice;
                }
                $data = [
                    'tittle' => 'Detail Kasir',
                    'get_kategori' => $this->DashboardModel->get_kategori(),
                    'isi' => 'Admin/v_detail_kasir',
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir,
                    'cari' => $cari,
                    'id' => $id_kasir,
                    'currentPage' => $this->request->getVar('page_peoples') ? $this->request->getVar('page_peoples') : 1,
                    'list_order' => $order
                        ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
                        ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
                        ->join('tb_kasir', 'tb_kasir.id_kasir = tb_order.id_kasir')
                        ->join('tb_kategori', 'tb_kategori.id_kategori = tb_order.id_kategori')
                        ->where([
                            'tb_order.id_kasir' => $id_kasir,
                            'DATE(tb_order.created_at) >=' => $tanggal_awal,
                            'DATE(tb_order.created_at) <=' => $tanggal_akhir,
                        ])
                        ->orderby('tb_order.id_order', 'DESC')
                        ->paginate(10, 'peoples'),
                    'pager' => $order->pager,
                    'nomor' => nomor($this->request->getVar('page_peoples'), 10),
                    'total_all' => $total_all,
                    'count_all' => $this->DashboardModel->count_order_all3($id_kasir, $tanggal_awal, $tanggal_akhir),
                ];
            } else {
                $all = $this->DashboardModel->pemasukan_all4($id_kasir, $tanggal_awal, $tanggal_akhir, $cari);
                $total_all = 0;
                foreach ($all as $key) {
                    $newPrice = $key['harga_product'];
                    $total_all += $key['jumlah'] * $newPrice;
                }
                $data = [
                    'tittle' => 'Detail Kasir',
                    'get_kategori' => $this->DashboardModel->get_kategori(),
                    'isi' => 'Admin/v_detail_kasir',
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir,
                    'cari' => $cari,
                    'id' => $id_kasir,
                    'currentPage' => $this->request->getVar('page_peoples') ? $this->request->getVar('page_peoples') : 1,
                    'list_order' => $order
                        ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
                        ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
                        ->join('tb_kasir', 'tb_kasir.id_kasir = tb_order.id_kasir')
                        ->join('tb_kategori', 'tb_kategori.id_kategori = tb_order.id_kategori')
                        ->where([
                            'tb_order.id_kasir' => $id_kasir,
                            'DATE(tb_order.created_at) >=' => $tanggal_awal,
                            'DATE(tb_order.created_at) <=' => $tanggal_akhir,
                        ])
                        ->where("(nama_product LIKE '%" . $cari . "%')")
                        ->orderby('tb_order.id_order', 'DESC')
                        ->paginate(10, 'peoples'),
                    'pager' => $order->pager,
                    'nomor' => nomor($this->request->getVar('page_peoples'), 10),
                    'total_all' => $total_all,
                    'count_all' => $this->DashboardModel->count_order_all4($id_kasir, $tanggal_awal, $tanggal_akhir, $cari),
                ];
            }
        }


        echo view('layout/v_wrapper', $data);
    }

    public function hapus_order($id_order, $id)
    {
        $this->DashboardModel->hapus_order($id_order);
        session()->setFlashdata('sukses', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('Admin/detail_kasir/' . $id));
    }

    public function akun()
    {
        $data = [
            'tittle' => 'List Akun',
            'get_kategori' => $this->DashboardModel->get_kategori(),
            'get_kasir' => $this->DashboardModel->get_kasir(),
            'get_mitra' => $this->DashboardModel->get_mitra(),
            'isi' => 'Admin/v_akun',
            'akun' => $this->DashboardModel->get_akun(),
        ];
        echo view('layout/v_wrapper', $data);
    }

    public function tambah_user()
    {
        $data = [
            'nama_user' => $this->request->getPost('nama_user'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'hak_akses' => $this->request->getPost('hak_akses'),
            'id_mitra' => $this->request->getPost('id_mitra'),
            'id_kasir' => $this->request->getPost('id_kasir')

        ];

        $this->DashboardModel->tambah_user($data);
        session()->setFlashdata('sukses', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('Admin/akun'));
    }


    public function edit_user($id)
    {


        $data = [
            'nama_user' => $this->request->getPost('nama_user'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'hak_akses' => $this->request->getPost('hak_akses'),

        ];

        $this->DashboardModel->edit_user($data, $id);
        session()->setFlashdata('sukses', 'Data Berhasil Diubah');
        return redirect()->to(base_url('Admin/akun'));
    }

    public function hapus_user($id)
    {
        $this->DashboardModel->hapus_user($id);
        session()->setFlashdata('sukses', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('Admin/akun'));
    }
}
