<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Home extends BaseController
{
    protected $Users;
    function __construct()
    {
        $this->Users = new UsersModel();
    }
    public function index()
    {
        $dataUsers = $this->Users->findAll();
        if (empty($dataUsers)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak ditemukan !');
        }
        $data['users'] = $dataUsers;
        return view('home', $data);
    }
}
