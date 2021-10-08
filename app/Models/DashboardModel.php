<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    public function get_kategori()
    {
        return $this->db->table('tb_kategori')
            ->where('hapus', 1)
            ->get()->getResultArray();
    }

    public function get_kasir()
    {
        return $this->db->table('tb_kasir')
            ->where('dlt', 1)
            ->get()->getResultArray();
    }

    public function get_akun()
    {
        return $this->db->table('tb_user')
            ->whereNotIn('hak_akses', [1])
            ->get()->getResultArray();
    }

    public function get_mitra()
    {
        return $this->db->table('tb_mitra')
            ->where('del', 1)
            ->get()->getResultArray();
    }


    public function tambah_kasir($data)
    {

        return $this->db->table('tb_kasir')->insert($data);
    }


    public function tambah_user($data)
    {

        return $this->db->table('tb_user')->insert($data);
    }
    public function edit_kasir($data, $id)
    {
        return $this->db->table('tb_kasir')->update($data, ['id_kasir' => $id]);
    }


    public function edit_user($data, $id)
    {
        return $this->db->table('tb_user')->update($data, ['id' => $id]);
    }

    public function hapus_kasir($id)
    {

        return $this->db->table('tb_kasir')->delete(['id_kasir' => $id]);
    }

    public function hapus_user($id)
    {

        return $this->db->table('tb_user')->delete(['id' => $id]);
    }

    public function hapus_order($id)
    {

        return $this->db->table('tb_order')->delete(['id_order' => $id]);
    }

    public function pemasukan_all($id_kasir)
    {
        return $this->db->table('tb_order')
            ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
            ->join('tb_kasir', 'tb_kasir.id_kasir = tb_order.id_kasir')
            ->where([
                'tb_order.id_kasir' => $id_kasir,
            ])
            ->get()->getResultArray();
    }

    public function count_order_all($id_kasir)
    {
        return $this->db->table('tb_order')
            ->where([
                'id_kasir' => $id_kasir,
            ])
            ->countAllResults();
    }

    public function pemasukan_all2($id_kasir, $cari)
    {
        return $this->db->table('tb_order')
            ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
            ->join('tb_kasir', 'tb_kasir.id_kasir = tb_order.id_kasir')
            ->where([
                'tb_order.id_kasir' => $id_kasir,
            ])
            ->like('tb_product.nama_product', $cari)
            ->get()->getResultArray();
    }

    public function count_order_all2($id_kasir, $cari)
    {
        return $this->db->table('tb_order')
            ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
            ->where([
                'id_kasir' => $id_kasir,
            ])
            ->like('nama_product', $cari)
            ->countAllResults();
    }

    public function pemasukan_all3($id_kasir, $tanggal_awal, $tanggal_akhir)
    {
        return $this->db->table('tb_order')
            ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
            ->join('tb_kasir', 'tb_kasir.id_kasir = tb_order.id_kasir')
            ->where([
                'tb_order.id_kasir' => $id_kasir,
                'DATE(tb_order.created_at) >=' => $tanggal_awal,
                'DATE(tb_order.created_at) <=' => $tanggal_akhir,
            ])
            ->get()->getResultArray();
    }

    public function count_order_all3($id_kasir,  $tanggal_awal, $tanggal_akhir)
    {
        return $this->db->table('tb_order')
            ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
            ->where([
                'id_kasir' => $id_kasir,
                'DATE(tb_order.created_at) >=' => $tanggal_awal,
                'DATE(tb_order.created_at) <=' => $tanggal_akhir,
            ])
            ->countAllResults();
    }

    public function pemasukan_all4($id_kasir, $tanggal_awal, $tanggal_akhir, $cari)
    {
        return $this->db->table('tb_order')
            ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
            ->join('tb_kasir', 'tb_kasir.id_kasir = tb_order.id_kasir')
            ->where([
                'tb_order.id_kasir' => $id_kasir,
                'DATE(tb_order.created_at) >=' => $tanggal_awal,
                'DATE(tb_order.created_at) <=' => $tanggal_akhir,
            ])
            ->where("(nama_product LIKE '%" . $cari . "%')")
            ->get()->getResultArray();
    }

    public function count_order_all4($id_kasir,  $tanggal_awal, $tanggal_akhir, $cari)
    {
        return $this->db->table('tb_order')
            ->join('tb_product', 'tb_product.id_product = tb_order.id_product')
            ->where([
                'id_kasir' => $id_kasir,
                'DATE(tb_order.created_at) >=' => $tanggal_awal,
                'DATE(tb_order.created_at) <=' => $tanggal_akhir,
            ])
            ->where("(nama_product LIKE '%" . $cari . "%')")
            ->countAllResults();
    }
}
