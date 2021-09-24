<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{

    public function __construct()
    {
        helper('form');

        $this->AuthModel = new AuthModel();
    }

    public function index()
    {

        $data = [
            'tittle' => 'Login',
            'isi' => 'v_login',
            'get_kategori' => $this->AuthModel->get_kategori(),
        ];

        echo view('layout/v_wrapper', $data);
    }

    public function cek_login()
    {


        if ($this->validate([

            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!!'
                ]
            ],

            'level' => [
                'label' => 'Hak Akses',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!!'
                ]
            ],

            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!!'
                ]
            ],

        ])) {

            $hak_akses = $this->request->getPost('level');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $cek_user = $this->AuthModel->login_user($username, $password, $hak_akses);

            if ($hak_akses == 1) {


                if ($cek_user) {

                    session()->set('log', true);
                    session()->set('username', $cek_user['username']);
                    session()->set('nama', $cek_user['nama']);
                    session()->set('level', $hak_akses);

                    return redirect()->to(base_url('Admin'));
                } else {
                    session()->setFlashdata('pesan', 'Login Gagal!, Username Atau Password Salah !!');
                    return redirect()->to(base_url('auth/index'));
                }
            }
        } else {
            session()->setFlashdata('errors', \config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/index'));
        }
    }

    public function logout()
    {
        session()->remove('log');
        session()->remove('username');
        session()->remove('level');
        return redirect()->to(base_url('Auth'));
    }
}
