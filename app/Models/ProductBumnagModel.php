<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductBumnagModel extends Model
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
            ->where('id_mitra', 0)
            ->get()
            ->getResultArray();
    }

    public function get_namaKategori($id)
    {
        return $this->db->table('tb_kategori')
            ->where('id_kategori', $id)
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
