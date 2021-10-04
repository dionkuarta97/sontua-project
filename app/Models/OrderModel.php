<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{

    // your table
    protected $table = 'tb_order';
    // primary key
    protected $primaryKey = 'id_order';
    // table fields
    protected $allowedFields = ['id_kasir', 'id_product', 'jumlah', 'id_kategori', 'id_mitra', 'id_pembeli', 'created_at', 'update_at'];
}
