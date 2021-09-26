<?php

namespace App\Models;

use CodeIgniter\Model;

class PembeliModel extends Model
{

    // your table
    protected $table = 'tb_pembeli';
    // primary key
    protected $primaryKey = 'id_pembeli';
    // table fields
    protected $allowedFields = ['nama_pembeli', 'id_kategori', 'pembayaran'];
}
