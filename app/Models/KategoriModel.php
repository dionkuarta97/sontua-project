<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{

    public function tambah_kategori($data)
    {

        return $this->db->table('tb_kategori')->insert($data);
    }

    public function get_kategori()
    {
        return $this->db->table('tb_kategori')
            ->where('hapus', 1)
            ->get()->getResultArray();
    }
    public function edit_kategori($data, $id)
    {
        return $this->db->table('tb_kategori')->update($data, ['id_kategori' => $id]);
    }

    public function hapus_kategori($id)
    {

        return $this->db->table('tb_kategori')->delete(['id_kategori' => $id]);
    }
}
