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
            $cek_admin = $this->AuthModel->login_admin($username, $password, $hak_akses);
            $cek_mitra = $this->AuthModel->login_mitra($username, $password, $hak_akses);

            if ($hak_akses == 1) {


                if ($cek_admin) {

                    session()->set('log', true);
                    session()->set('username', $cek_admin['username']);
                    session()->set('nama', $cek_admin['nama']);
                    session()->set('level', $hak_akses);

                    return redirect()->to(base_url('Admin'));
                } else {
                    session()->setFlashdata('pesan', 'Login Gagal!, Username Atau Password Salah !!');
                    return redirect()->to(base_url('auth/index'));
                }
            } else if ($hak_akses == 2) {


                if ($cek_mitra) {

                    session()->set('log', true);
                    session()->set('username', $cek_mitra['username']);
                    session()->set('nama', $cek_mitra['nama']);
                    session()->set('id_mitra', $cek_mitra['id_mitra']);
                    session()->set('level', $hak_akses);

                    return redirect()->to(base_url('User/'));
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
