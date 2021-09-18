<?php

namespace App\Controllers;


use App\Models\DashboardModel;

class Admin extends BaseController
{


    public function __construct()
    {
        helper('form');
        $this->DashboardModel = new DashboardModel();
    }

    public function index()
    {

        $data = [
            'tittle' => 'Dashboard',
            'get_kategori' => $this->DashboardModel->get_kategori(),
            'isi' => 'Admin/v_admin',
        ];

        echo view('layout/v_wrapper', $data);
    }
}
