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
}
