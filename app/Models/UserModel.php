<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    public function get_kategori($id_mitra)
    {
        return $this->db->table('tb_kategori')
            ->join('tb_mitra', 'tb_mitra.id_kategori = tb_kategori.id_kategori')
            ->where('tb_mitra.id_mitra', $id_mitra)
            ->get()->getResultArray();
    }

    public function get_product($id, $id_mitra)
    {
        return $this->db->table('tb_product')
            ->where('id_kategori', $id)
            ->where('id_mitra', $id_mitra)
            ->get()
            ->getResultArray();
    }

    public function get_namaKategori($id, $id_mitra)
    {
        return $this->db->table('tb_kategori')
            ->join('tb_mitra', 'tb_mitra.id_kategori = tb_kategori.id_kategori')
            ->where('tb_kategori.id_kategori', $id)
            ->where('tb_mitra.id_mitra', $id_mitra)
            ->get()->getResultArray();
    }

    public function simpan_product($data)
    {
        return $this->db->table('tb_product')->insert($data);
    }

    public function edit_product($data, $id)
    {
        return $this->db->table('tb_product')->update($data, ['id_product' => $id]);
    }

    public function hapus_product($id)
    {

        return $this->db->table('tb_product')->delete(['id_product' => $id]);
    }

    public function count_order_today($id_mitra)
    {
        return $this->db->table('tb_order')
            ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
            ->where([
                'tb_order.id_mitra' => $id_mitra,
                'DATE(tb_pembeli.created_at)' => date('Y-m-d'),
                'tb_pembeli.pembayaran' => 2
            ])
            ->countAllResults();
    }

    public function count_order_all($id_mitra)
    {
        return $this->db->table('tb_order')
            ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
            ->where([
                'id_mitra' => $id_mitra,
                'tb_pembeli.pembayaran' => 2,
                'MONTH(tb_pembeli.created_at)' => date('m'),
                'YEAR(tb_pembeli.created_at)' => date('Y'),
            ])
            ->countAllResults();
    }

    public function pemasukan_today($id_mitra)
    {
        return $this->db->table('tb_order')
            ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
            ->join('tb_mitra', 'tb_mitra.id_mitra = tb_order.id_mitra')
            ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
            ->where([
                'tb_order.id_mitra' => $id_mitra,
                'DATE(tb_pembeli.created_at)' => date('Y-m-d'),
                'tb_pembeli.pembayaran' => 2
            ])
            ->get()->getResultArray();
    }

    public function pemasukan_all($id_mitra)
    {
        return $this->db->table('tb_order')
            ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
            ->join('tb_mitra', 'tb_mitra.id_mitra = tb_order.id_mitra')
            ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
            ->where([
                'tb_order.id_mitra' => $id_mitra,
                'MONTH(tb_pembeli.created_at)' => date('m'),
                'YEAR(tb_pembeli.created_at)' => date('Y'),
                'tb_pembeli.pembayaran' => 2
            ])
            ->get()->getResultArray();
    }

    public function get_detail_mitra($id_mitra)
    {
        return $this->db->table('tb_mitra')
            ->where('id_mitra', $id_mitra)
            ->get()->getRowArray();
    }

    public function pemasukan_all2($id_mitra)
    {
        return $this->db->table('tb_order')
            ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
            ->join('tb_mitra', 'tb_mitra.id_mitra = tb_order.id_mitra')
            ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
            ->where([
                'tb_order.id_mitra' => $id_mitra,
                'tb_pembeli.pembayaran' => 2
            ])
            ->get()->getResultArray();
    }

    public function count_order_all2($id_mitra)
    {
        return $this->db->table('tb_order')
            ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
            ->where([
                'id_mitra' => $id_mitra,
                'tb_pembeli.pembayaran' => 2,
            ])
            ->countAllResults();
    }

    public function pemasukan_all3($id_mitra, $cari)
    {
        return $this->db->table('tb_order')
            ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
            ->join('tb_mitra', 'tb_mitra.id_mitra = tb_order.id_mitra')
            ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
            ->where([
                'tb_order.id_mitra' => $id_mitra,
                'tb_pembeli.pembayaran' => 2
            ])
            ->like('nama_product', $cari)
            ->get()->getResultArray();
    }

    public function count_order_all3($id_mitra, $cari)
    {
        return $this->db->table('tb_order')
            ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
            ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
            ->where([
                'tb_order.id_mitra' => $id_mitra,
                'tb_pembeli.pembayaran' => 2,
            ])
            ->like('nama_product', $cari)
            ->countAllResults();
    }

    public function pemasukan_all4($id_mitra, $tanggal_awal, $tanggal_akhir)
    {
        return $this->db->table('tb_order')
            ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
            ->join('tb_mitra', 'tb_mitra.id_mitra = tb_order.id_mitra')
            ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
            ->where([
                'tb_order.id_mitra' => $id_mitra,
                'tb_pembeli.pembayaran' => 2,
                'DATE(tb_order.created_at) >=' => $tanggal_awal,
                'DATE(tb_order.created_at) <=' => $tanggal_akhir,
            ])
            ->get()->getResultArray();
    }

    public function count_order_all4($id_mitra, $tanggal_awal, $tanggal_akhir)
    {
        return $this->db->table('tb_order')
            ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
            ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
            ->where([
                'tb_order.id_mitra' => $id_mitra,
                'tb_pembeli.pembayaran' => 2,
                'DATE(tb_order.created_at) >=' => $tanggal_awal,
                'DATE(tb_order.created_at) <=' => $tanggal_akhir,
            ])
            ->countAllResults();
    }

    public function pemasukan_all5($id_mitra, $cari, $tanggal_awal, $tanggal_akhir)
    {
        return $this->db->table('tb_order')
            ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
            ->join('tb_mitra', 'tb_mitra.id_mitra = tb_order.id_mitra')
            ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
            ->where([
                'tb_order.id_mitra' => $id_mitra,
                'tb_pembeli.pembayaran' => 2,
                'DATE(tb_order.created_at) >=' => $tanggal_awal,
                'DATE(tb_order.created_at) <=' => $tanggal_akhir,
            ])
            ->where("(nama_product LIKE '%" . $cari . "%')")
            ->get()->getResultArray();
    }

    public function count_order_all5($id_mitra, $cari, $tanggal_awal, $tanggal_akhir)
    {
        return $this->db->table('tb_order')
            ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
            ->join('tb_pembeli', 'tb_pembeli.id_pembeli = tb_order.id_pembeli')
            ->where([
                'tb_order.id_mitra' => $id_mitra,
                'tb_pembeli.pembayaran' => 2,
                'DATE(tb_order.created_at) >=' => $tanggal_awal,
                'DATE(tb_order.created_at) <=' => $tanggal_akhir,
            ])
            ->where("(nama_product LIKE '%" . $cari . "%')")
            ->countAllResults();
    }
}
