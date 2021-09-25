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
}
