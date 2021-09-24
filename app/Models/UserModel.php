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
}
