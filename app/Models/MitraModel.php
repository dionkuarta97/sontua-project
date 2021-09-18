<?php

namespace App\Models;

use CodeIgniter\Model;

class MitraModel extends Model
{
    public function get_kategori()
    {
        return $this->db->table('tb_kategori')
            ->get()->getResultArray();
    }

    public function get_mitra()
    {
        return $this->db->table('tb_mitra')
            ->join('tb_kategori', 'tb_kategori.id_kategori = tb_mitra.id_kategori')
            ->get()->getResultArray();
    }

    public function tambah_mitra($data)
    {
        return $this->db->table('tb_mitra')->insert($data);
    }


    public function hapus_mitra($id)
    {

        return $this->db->table('tb_mitra')->delete(['id_mitra' => $id]);
    }

    public function edit_mitra($data, $id)
    {
        return $this->db->table('tb_mitra')->update($data, ['id_mitra' => $id]);
    }
}
