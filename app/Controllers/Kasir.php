<?php

namespace App\Controllers;


use App\Models\KasirModel;
use App\Models\ProductModel;
use App\Models\PembeliModel;
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

        $kategori = $this->KasirModel->get_kategori();
        $total_lunas = array();
        $total_belum = array();
        $order_lunas = array();
        $total_harga_lunas = array();
        $total_harga_bayar = array();
        // print_r(count($kategori));

        foreach ($kategori as $key) {
            $total_lunas[] = $this->KasirModel->get_lunas($key['id_kategori']);
            $total_belum[] = $this->KasirModel->get_belum($key['id_kategori']);
            $order_lunas[] = $this->KasirModel->get_order_lunas($key['id_kategori']);
            $order_bayar[] = $this->KasirModel->get_order_bayar($key['id_kategori']);
        }

        for ($i = 0; $i < count($order_lunas); $i++) {
            $temp = 0;
            for ($j = 0; $j < count($order_lunas[$i]); $j++) {
                $temp += $order_lunas[$i][$j]['harga_product'] * $order_lunas[$i][$j]['jumlah'];
            }
            $total_harga_lunas[] = $temp;
        }

        for ($i = 0; $i < count($order_bayar); $i++) {
            $temp = 0;
            for ($j = 0; $j < count($order_bayar[$i]); $j++) {
                $temp += $order_bayar[$i][$j]['harga_product'] * $order_bayar[$i][$j]['jumlah'];
            }
            $total_harga_bayar[] = $temp;
        }


        $data = [
            'tittle' => 'Dashboard',
            'get_kategori' => $this->KasirModel->get_kategori(),
            'isi' => 'Kasir/v_kasir',
            'total_lunas' => $total_lunas,
            'total_belum' => $total_belum,
            'total_harga_bayar' => $total_harga_bayar,
            'total_harga_lunas' => $total_harga_lunas,
        ];

        echo view('layout/v_wrapper', $data);
    }

    public function list($id, $id_pembeli)
    {
        $product = new ProductModel;
        $cari = $this->request->getGet('cari');
        $session = session('cart' . $id_pembeli);
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
                'items' => $this->cart->totals($id_pembeli),
                'total' => $this->cart->count_totals($id_pembeli),
                'pesanan' => is_array($session) ? array_values($session) : array(),
                'id_pembeli' => $id_pembeli
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
                'id_pembeli' => $id_pembeli
            ];
        }

        echo view('layout/v_wrapper', $data);
    }

    public function pesan($id)
    {
        $product = $this->KasirModel->get_product2($id);
        // cek data product
        $id_pembeli = $this->request->getPost('id_pembeli');
        $jumlah = $this->request->getPost('jumlah');
        $id_kategori = $this->request->getPost('id_kategori');
        $id_product = $product['id_product'];
        $session = session()->get('cart' . $id_pembeli);
        if ($session) {
            $index = $this->cart->exists($id,  $id_pembeli);
        } else {
            $index = -1;
        }

        if ($index == 0) {
            $jumlah += $session[0]['quantity'];
            $this->cart->update($id_product, $jumlah, $id_pembeli);
            session()->setFlashdata('sukses', "Berhasil memesan {$product['nama_product']}");
            return redirect()->to(base_url('/Kasir/list/' . $id_kategori . '/' . $id_pembeli));
        } else {
            if ($product != null) { // jika product tidak kosong

                // buat variabel array untuk menampung data product
                $item = [
                    'id'        => $product['id_product'],
                    'name'      => $product['nama_product'],
                    'price'     => $product['harga_product'],
                    'photo'     => $product['img_product'],
                    'quantity'  => $jumlah,
                    'id_kategori' => $product['id_kategori'],
                    'id_mitra' => $product['id_mitra'],
                    'id_kasir' => session()->get('id_kasir'),
                    'id_pembeli' => $id_pembeli

                ];
                // tambahkan product ke dalam cart
                $this->cart->add_cart($id, $item, $id_pembeli);
                // tampilkan nama product yang ditambahkan
                $product = $item['name'];
                // success flashdata
                session()->setFlashdata('sukses', "Berhasil memesan {$product}");
            } else {
                // error flashdata
                session()->setFlashdata('error', "Tidak dapat menemukan data product");
            }
            return redirect()->to(base_url('/Kasir/list/' . $id_kategori . '/' . $id_pembeli));
        }
    }

    public function update($id, $id_pembeli)
    {
        // update cart
        $jumlah = $this->request->getPost('jumlah');
        $id_product = $this->request->getPost('id_product');
        $this->cart->update($id_product, $jumlah, $id_pembeli);
        session()->setFlashdata('sukses', "Berhasil berhasil diubah");
        return redirect()->to(base_url('/Kasir/list/' . $id . '/' . $id_pembeli));
    }

    public function remove($id = null, $id_pembeli)
    {

        // cari product berdasarkan id
        $product = $this->KasirModel->get_product2($id);
        // cek data product
        if ($product != null) { // jika product tidak kosong
            // hapus keranjang belanja berdasarkan id
            $this->cart->remove($id, $id_pembeli);
            // success flashdata
            session()->setFlashdata('sukses', "berhasil menghapus pesanan");
        } else { // product tidak ditemukan
            // error flashdata
            session()->setFlashdata('error', "Tidak dapat menemukan data product");
        }
        return redirect()->to(base_url('/Kasir/list/' . $product['id_kategori'] . '/' . $id_pembeli));
    }

    public function pembeli($id)
    {

        $pembeli = new PembeliModel;
        $tanggal_awal = $this->request->getGet('tanggal_awal');
        $tanggal_akhir = $this->request->getGet('tanggal_akhir');
        $today = date('Y-m-d');
        $cari = $this->request->getGet('cari');


        if ($tanggal_awal == null && $tanggal_akhir == null) {
            if ($cari == null) {
                $data = [
                    'tittle' => 'List Pembeli',
                    'get_kategori' => $this->KasirModel->get_kategori(),
                    'get_nama' => $this->KasirModel->get_namaKategori($id),
                    'isi' => 'Kasir/v_pembeli',

                    'currentPage' => $this->request->getVar('page_peoples') ? $this->request->getVar('page_peoples') : 1,
                    'list_pembeli' => $pembeli->where([
                        'id_kategori' => $id,
                        'DATE(created_at)' => $today
                    ])
                        ->orderby('id_pembeli', 'ASC')
                        ->paginate(10, 'peoples'),
                    'pager' => $pembeli->pager,
                    'nomor' => nomor($this->request->getVar('page_peoples'), 10),
                    'total_pembeli' => $this->KasirModel->total_pembeli($id, $today),
                    'id' => $id,
                    'cari' => $cari,
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir
                ];
            } else {
                $data = [
                    'tittle' => 'List Pembeli',
                    'get_kategori' => $this->KasirModel->get_kategori(),
                    'get_nama' => $this->KasirModel->get_namaKategori($id),
                    'isi' => 'Kasir/v_pembeli',

                    'currentPage' => $this->request->getVar('page_peoples') ? $this->request->getVar('page_peoples') : 1,
                    'list_pembeli' => $pembeli->where([
                        'id_kategori' => $id,
                        'DATE(created_at)' => $today
                    ])
                        ->like('pembayaran', $cari)
                        ->orlike('nama_pembeli', $cari)
                        ->orderby('id_pembeli', 'ASC')
                        ->paginate(10, 'peoples'),
                    'pager' => $pembeli->pager,
                    'nomor' => nomor($this->request->getVar('page_peoples'), 10),
                    'total_pembeli' => $this->KasirModel->total_cari($id, $today, $cari),
                    'id' => $id,
                    'cari' => $cari,

                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir
                ];
            }
        } else {
            if ($cari == null) {
                $data = [
                    'tittle' => 'List Pembeli',
                    'get_kategori' => $this->KasirModel->get_kategori(),
                    'get_nama' => $this->KasirModel->get_namaKategori($id),
                    'isi' => 'Kasir/v_pembeli',

                    'currentPage' => $this->request->getVar('page_peoples') ? $this->request->getVar('page_peoples') : 1,
                    'list_pembeli' => $pembeli->where([
                        'id_kategori' => $id,
                        'DATE(created_at) >=' => $tanggal_awal,
                        'DATE(created_at) <=' => $tanggal_akhir,
                    ])
                        ->orderby('id_pembeli', 'ASC')
                        ->paginate(10, 'peoples'),
                    'pager' => $pembeli->pager,
                    'nomor' => nomor($this->request->getVar('page_peoples'), 10),
                    'total_pembeli' => $this->KasirModel->total_pembeli2($id, $tanggal_awal, $tanggal_akhir),
                    'id' => $id,
                    'cari' => $cari,

                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir
                ];
            } else {
                $data = [
                    'tittle' => 'List Pembeli',
                    'get_kategori' => $this->KasirModel->get_kategori(),
                    'get_nama' => $this->KasirModel->get_namaKategori($id),
                    'isi' => 'Kasir/v_pembeli',

                    'currentPage' => $this->request->getVar('page_peoples') ? $this->request->getVar('page_peoples') : 1,
                    'list_pembeli' => $pembeli->where([
                        'id_kategori' => $id,
                        'DATE(created_at) >=' => $tanggal_awal,
                        'DATE(created_at) <=' => $tanggal_akhir,
                    ])
                        ->like('pembayaran', $cari)
                        ->orlike('nama_pembeli', $cari)
                        ->orderby('id_pembeli', 'ASC')
                        ->paginate(10, 'peoples'),
                    'pager' => $pembeli->pager,
                    'nomor' => nomor($this->request->getVar('page_peoples'), 10),
                    'total_pembeli' => $this->KasirModel->total_cari2($id, $tanggal_awal, $tanggal_akhir, $cari),
                    'id' => $id,
                    'cari' => $cari,

                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir
                ];
            }
        }




        echo view('layout/v_wrapper', $data);
    }

    public function tambah_pembeli($id)
    {
        $data = [
            'nama_pembeli' => $this->request->getPost('nama_pembeli'),
            'id_kategori' => $id,
            'pembayaran' => 1

        ];

        $this->KasirModel->tambah_pembeli($data);
        session()->setFlashdata('sukses', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('Kasir/pembeli/' . $id));
    }

    public function pembayaran($id, $id_pembeli)
    {
        $order =  $this->KasirModel->get_orderan($id_pembeli);
        $total_harga = 0;
        $length = count($order);
        for ($i = 0; $i < $length; $i++) {
            $total_harga += $order[$i]['jumlah'] * $order[$i]['harga_product'];
        }

        $data = [
            'tittle' => 'Pembayaran',
            'get_kategori' => $this->KasirModel->get_kategori(),
            'get_nama' => $this->KasirModel->get_namaKategori($id),
            'id' => $id,
            'id_pembeli' => $id_pembeli,
            'orderan' => $this->KasirModel->get_orderan($id_pembeli),
            'total_harga' => $total_harga,
            'isi' => 'Kasir/v_pembayaran'
        ];
        echo view('layout/v_wrapper', $data);
    }

    public function tambah_orderan()
    {

        $id_product = $this->request->getPost('id_product');
        $id_kasir = $this->request->getPost('id_kasir');
        $id_kategori = $this->request->getPost('id_kategori');
        $id_mitra = $this->request->getPost('id_mitra');
        $id_pembeli = $this->request->getPost('id_pembeli');
        $jumlah = $this->request->getPost('jumlah');
        $length = count($id_product);
        $data = array();
        for ($i = 0; $i < $length; $i++) {
            $data[$i]['id_product'] = $id_product[$i];
            $data[$i]['id_kasir'] = $id_kasir[$i];
            $data[$i]['id_kategori'] = $id_kategori[$i];
            $data[$i]['id_mitra'] = $id_mitra[$i];
            $data[$i]['id_pembeli'] = $id_pembeli[$i];
            $data[$i]['jumlah'] = $jumlah[$i];

            $cek_order = $this->KasirModel->cek_order($data[$i]['id_product'], $data[$i]['id_pembeli']);
            if ($cek_order == null) {
                $this->KasirModel->tambah_orderan($data[$i]);
            } else {

                $update = [
                    'jumlah' => $cek_order['jumlah'] + $data[$i]['jumlah']
                ];
                $this->KasirModel->edit_orderan($update, $cek_order['id_order']);
            }
        }

        session()->remove('cart' . $id_pembeli[0]);
        session()->setFlashdata('sukses', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('Kasir/pembayaran/' . $id_kategori[0] . '/' . $id_pembeli[0]));
    }

    public function bayar($id, $id_pembeli)
    {
        $data = [
            'pembayaran' => $this->request->getPost('pembayaran')
        ];
        // print_r($data);
        $this->KasirModel->bayar($data, $id_pembeli);
        session()->setFlashdata('sukses', 'Sukses melakukan pembayaran');
        return redirect()->to(base_url('Kasir/pembeli/' . $id));
    }

    public function hapus_pembeli($id, $id_pembeli)
    {
        $this->KasirModel->hapus_pembeli($id_pembeli);
        $this->KasirModel->hapus_order($id_pembeli);
        session()->setFlashdata('sukses', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('Kasir/pembeli/' . $id));
    }
}
