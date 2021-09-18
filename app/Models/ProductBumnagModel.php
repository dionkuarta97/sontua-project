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
        return $this->db->table('tb_ProductBumnag')
            ->where('id_kategori', $id)
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
        return $this->db->table('tb_ProductBumnag')->insert($data);
    }
}
