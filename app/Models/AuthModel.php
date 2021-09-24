<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{

    public function login_user($username, $password, $hak_akses)
    {

        return $this->db->table('tb_user')->where([
            'username' => $username,
            'password' => $password,
            'hak_akses' => $hak_akses
        ])->get()->getRowArray();
    }

    public function get_kategori()
    {
        return $this->db->table('tb_kategori')
            ->get()->getResultArray();
    }
}
