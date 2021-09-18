<?php

namespace App\Controllers;

use App\Models\ProductBumnagModel;

class ProductBumnag extends BaseController
{

    public function __construct()
    {
        $this->ProductBumnagModel = new ProductBumnagModel();
    }

    public function index()
    {

        $data = [
            'tittle' => 'Product Bumnag',
        ];

        echo view('layout/v_wrapper', $data);
    }


    public function detail($id)
    {

        $data = [
            'tittle' => 'Product Bumnag',
            'get_kategori' => $this->ProductBumnagModel->get_kategori(),
            'isi' => 'Admin/v_product',
        ];

        echo view('layout/v_wrapper', $data);
    }
}
