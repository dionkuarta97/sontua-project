<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{

    // your table
    protected $table = 'tb_product';
    // primary key
    protected $primaryKey = 'id_product';
    // table fields
    protected $allowedFields = ['nama_product', 'id_mitra', 'id_kategori', 'harga_product', 'jenis_product', 'img_product', 'arsip'];
}
