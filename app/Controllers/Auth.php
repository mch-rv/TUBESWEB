<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Auth extends BaseController
{
    protected $users;
    function __construct()
    {
        $this->users = new UsersModel();
    }
    public function register()
    {
        if(session()->get('Role')!='Admin'){
            return redirect()->to(base_url('home'));
        }else{
            return view('vw_register');
        }
        
    }
    public function registerprocess()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|min_length[4]|max_length[20]|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 20 Karakter',
                    'is_unique' => 'Username sudah digunakan sebelumnya'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[4]|max_length[50]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 50 Karakter',
                ]
            ],
            'password_conf' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi Password tidak sesuai dengan password',
                ]
            ],
            'name' => [
                'rules' => 'required|min_length[4]|max_length[100]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 100 Karakter',
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $this->users->insert([
            'Username' => $this->request->getVar('username'),
            'Password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'Name' => $this->request->getVar('name'),
            'Role' => $this->request->getVar('role'),
            'Profile' => "profile.png",
        ]);
        session()->setFlashdata('message', "Register Berhasil!");
        return redirect()->back();
    }
    public function login()
    {
        if(session()->get('logged_in')==TRUE){
            return redirect()->to(base_url('home'));
        }else{
        return view('vw_login');
        }
    }
    public function loginprocess()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $dataUser = $this->users->where([
            'Username' => $username,
        ])->first();
        if ($dataUser) {
            if (password_verify($password, $dataUser->Password)) {
                session()->set([
                    'Username' => $dataUser->Username,
                    'Name' => $dataUser->Name,
                    'Role' => $dataUser->Role,
                    'Profile' => $dataUser->Profile,
                    'Id' => $dataUser->id,
                    'logged_in' => TRUE,
                ]);
                return redirect()->to(base_url('home'));
            } else {
                session()->setFlashdata('error', 'Username & Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->back();
        }
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('Auth/login');
    }
}