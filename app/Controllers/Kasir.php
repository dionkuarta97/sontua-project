<?php

namespace App\Controllers;


use App\Models\KasirModel;
use App\Models\ProductModel;
use Wildanfuady\WFcart\WFcart;

class Kasir extends BaseController
{


    public function __construct()
    {
        helper('form');
        $this->KasirModel = new KasirModel();
        $this->cart = new WFcart();
    }

    public function index()
    {

        $data = [
            'tittle' => 'Dashboard',
            'get_kategori' => $this->KasirModel->get_kategori(),
            'isi' => 'Kasir/v_kasir',
        ];

        echo view('layout/v_wrapper', $data);
    }

    public function list($id)
    {
        $product = new ProductModel;
        $cari = $this->request->getGet('cari');
        $session = session('cart');
        // session()->remove('cart');

        if ($cari == null) {

            $data = [
                'tittle' => 'List',
                'get_kategori' => $this->KasirModel->get_kategori(),
                'get_product' => $this->KasirModel->get_product($id),
                'get_makanan' => $this->KasirModel->get_makanan($id),
                'get_minuman' => $this->KasirModel->get_minuman($id),
                'get_nama' => $this->KasirModel->get_namaKategori($id),
                'id' => $id,
                'isi' => 'Kasir/v_list',
                'currentPage' => $this->request->getVar('page_peoples') ? $this->request->getVar('page_peoples') : 1,
                'product' => $product->where([
                    'id_kategori' => $id
                ])
                    ->orderby('id_product', 'ASC')
                    ->paginate(9, 'peoples'),
                'pager' => $product->pager,
                'cari' => $cari,
                'items' => $this->cart->totals(),
                'total' => $this->cart->count_totals(),
                'pesanan' => is_array($session) ? array_values($session) : array(),
            ];
        } else {

            $data = [
                'tittle' => 'List',
                'get_kategori' => $this->KasirModel->get_kategori(),
                'get_product' => $this->KasirModel->get_product($id),
                'get_makanan' => $this->KasirModel->get_makanan($id),
                'get_minuman' => $this->KasirModel->get_minuman($id),
                'get_nama' => $this->KasirModel->get_namaKategori($id),
                'id' => $id,
                'isi' => 'Kasir/v_list',
                'currentPage' => $this->request->getVar('page_peoples') ? $this->request->getVar('page_peoples') : 1,
                'product' => $product->where([
                    'id_kategori' => $id
                ])
                    ->like('jenis_product', $cari)
                    ->orlike('nama_product', $cari)
                    ->orderby('id_product', 'ASC')
                    ->paginate(9, 'peoples'),
                'pager' => $product->pager,
                'cari' => $cari,
                'items' => $this->cart->totals(),
                'total' => $this->cart->count_totals(),
                'pesanan' => is_array($session) ? array_values($session) : array(),
            ];
        }

        echo view('layout/v_wrapper', $data);
    }

    public function pesan($id)
    {
        $product = $this->KasirModel->get_product2($id);
        // cek data product
        $jumlah = $this->request->getPost('jumlah');
        $id_kategori = $this->request->getPost('id_kategori');
        if ($product != null) { // jika product tidak kosong

            // buat variabel array untuk menampung data product
            $item = [
                'id'        => $product['id_product'],
                'name'      => $product['nama_product'],
                'price'     => $product['harga_product'],
                'photo'     => $product['img_product'],
                'quantity'  => $jumlah,
                'id_kategori' => $product['id_kategori'],
                'id_mitra' => $product['id_mitra']

            ];
            // tambahkan product ke dalam cart
            $this->cart->add_cart($id, $item);
            // tampilkan nama product yang ditambahkan
            $product = $item['name'];
            // success flashdata
            session()->setFlashdata('sukses', "Berhasil memesan {$product}");
        } else {
            // error flashdata
            session()->setFlashdata('error', "Tidak dapat menemukan data product");
        }
        return redirect()->to(base_url('/Kasir/list/' . $id_kategori));
    }

    public function update($id)
    {
        // update cart
        $jumlah = $this->request->getPost('jumlah');
        $id_product = $this->request->getPost('id_product');
        $this->cart->update($id_product, $jumlah);
        session()->setFlashdata('sukses', "Berhasil berhasil diubah");
        return redirect()->to(base_url('/Kasir/list/' . $id));
    }

    public function remove($id = null)
    {

        // cari product berdasarkan id
        $product = $this->KasirModel->get_product2($id);
        // cek data product
        if ($product != null) { // jika product tidak kosong
            // hapus keranjang belanja berdasarkan id
            $this->cart->remove($id);
            // success flashdata
            session()->setFlashdata('sukses', "berhasil menghapus pesanan");
        } else { // product tidak ditemukan
            // error flashdata
            session()->setFlashdata('error', "Tidak dapat menemukan data product");
        }
        return redirect()->to(base_url('/Kasir/list/' . $product['id_kategori']));
    }
}
