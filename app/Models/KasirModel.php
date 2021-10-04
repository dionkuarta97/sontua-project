<?php

namespace App\Models;

use CodeIgniter\Model;

class KasirModel extends Model
{
    public function get_kategori()
    {
        return $this->db->table('tb_kategori')
            ->get()->getResultArray();
    }

    public function get_product($id)
    {
        return $this->db->table('tb_product')
            ->where('id_kategori', $id)
            ->get()
            ->getResultArray();
    }

    public function get_product2($id)
    {
        return $this->db->table('tb_product')
            ->where('id_product', $id)
            ->get()
            ->getRowArray();
    }

    public function get_makanan($id)
    {
        return $this->db->table('tb_product')
            ->where('id_kategori', $id)
            ->where('jenis_product', 1)
            ->get()
            ->getResultArray();
    }

    public function get_minuman($id)
    {
        return $this->db->table('tb_product')
            ->where('id_kategori', $id)
            ->where('jenis_product', 2)
            ->get()
            ->getResultArray();
    }

    public function get_namaKategori($id)
    {
        return $this->db->table('tb_kategori')
            ->where('id_kategori', $id)
            ->get()->getResultArray();
    }

    public function tambah_pembeli($data)
    {

        return $this->db->table('tb_pembeli')->insert($data);
    }

    public function total_pembeli($id, $date)
    {
        return $this->db->table('tb_pembeli')
            ->where([
                'id_kategori' => $id,
                'DATE(created_at)' => $date
            ])->countAllResults();
    }



    public function total_pembeli2($id, $tanggal_awal, $tanggal_akhir)
    {
        return $this->db->table('tb_pembeli')
            ->where([
                'id_kategori' => $id,
                'DATE(created_at) >=' => $tanggal_awal,
                'DATE(created_at) <=' => $tanggal_akhir,
            ])->countAllResults();
    }

    public function total_cari($id, $date, $cari)
    {
        return $this->db->table('tb_pembeli')
            ->where([
                'id_kategori' => $id,
                'DATE(created_at)' => $date
            ])
            ->like('pembayaran', $cari)
            ->orlike('nama_pembeli', $cari)
            ->countAllResults();
    }

    public function total_cari2($id, $tanggal_awal, $tanggal_akhir, $cari)
    {
        return $this->db->table('tb_pembeli')
            ->where([
                'id_kategori' => $id,
                'DATE(created_at) >=' => $tanggal_awal,
                'DATE(created_at) <=' => $tanggal_akhir,
            ])
            ->like('pembayaran', $cari)
            ->orlike('nama_pembeli', $cari)
            ->countAllResults();
    }

    public function total_cari3($id, $tanggal_awal, $tanggal_akhir, $cari)
    {
        return $this->db->table('tb_pembeli')
            ->where([
                'id_kategori' => $id,
                'DATE(created_at) >=' => $tanggal_awal,
                'DATE(created_at) <=' => $tanggal_akhir,
            ])
            ->where("(pembayaran LIKE '%" . $cari . "%' OR nama_pembeli LIKE '%" . $cari . "%')")
            ->countAllResults();
    }


    public function get_orderan($id)
    {
        return $this->db->table('tb_order')
            ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
            ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
            ->where('tb_order.id_pembeli', $id)
            ->get()->getResultArray();
    }

    public function tambah_orderan($data)
    {

        return $this->db->table('tb_order')->insert($data);
    }

    public function edit_orderan($data, $id)
    {
        return $this->db->table('tb_order')->update($data, ['id_order' => $id]);
    }

    public function cek_order($id_product, $id_pembeli)
    {
        return $this->db->table('tb_order')
            ->where([
                'id_product' => $id_product,
                'id_pembeli' => $id_pembeli
            ])
            ->get()->getRowArray();
    }

    public function bayar($data, $id)
    {
        return $this->db->table('tb_pembeli')->update($data, ['id_pembeli' => $id]);
    }


    public function hapus_pembeli($id)
    {

        return $this->db->table('tb_pembeli')->delete(['id_pembeli' => $id]);
    }

    public function hapus_order($id)
    {

        return $this->db->table('tb_order')->delete(['id_pembeli' => $id]);
    }

    public function get_lunas($id)
    {
        return $this->db->table('tb_pembeli')
            ->where([
                'id_kategori' => $id,
                'DATE(created_at)' =>  date('Y-m-d'),
                'pembayaran' => 2
            ])
            ->countAllResults();
    }


    public function get_belum($id)
    {
        return $this->db->table('tb_pembeli')
            ->where([
                'id_kategori' => $id,
                'DATE(created_at)' =>  date('Y-m-d'),
                'pembayaran' => 1
            ])
            ->countAllResults();
    }

    public function get_order_lunas($id)
    {
        return $this->db->table('tb_order')
            ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
            ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
            ->where([
                'tb_order.id_kategori' => $id,
                'tb_pembeli.pembayaran' => 2,
                'DATE(tb_pembeli.created_at)' =>  date('Y-m-d'),
            ])->get()->getResultArray();
    }

    public function get_order_bayar($id)
    {
        return $this->db->table('tb_order')
            ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
            ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
            ->where([
                'tb_order.id_kategori' => $id,
                'tb_pembeli.pembayaran' => 1,
                'DATE(tb_pembeli.created_at)' =>  date('Y-m-d'),
            ])->get()->getResultArray();
    }
}
