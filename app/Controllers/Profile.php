<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Profile extends BaseController
{
    protected $Users;

    function __construct()
    {
        $this->Users = new UsersModel();
    }
    public function index($id)
    {
        $dataUsers = $this->Users->find($id);
        if(session()->get('Id')==$dataUsers->id){
        if (empty($dataUsers)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak ditemukan !');
        }
        $data['users'] = $dataUsers;
        return view('Profile/index', $data);
        }else{
            return redirect()->back();
        }
    }
    function edit($id)
    {
        $dataUsers = $this->Users->find($id);
        if(session()->get('Id')==$dataUsers->id){
            if (empty($dataUsers)) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak ditemukan !');
            }
            $data['users'] = $dataUsers;
            return view('Profile/edit', $data);
        }else{
            return redirect()->back();
        }
    }
    public function update($id)
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required|min_length[4]|max_length[100]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 100 Karakter',
                ]
            ],
            'profile' => [
				'rules' => 'mime_in[profile,image/jpg,image/jpeg,image/gif,image/png]|max_size[profile,2048]',
				'errors' => [
					'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
					'max_size' => 'Ukuran File Maksimal 2 MB'
				]
            ],
            
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        }
        $data = $this->Users->find($id);
        if(session()->get('Id')==$data->id){
        $old_img_name = $data->Profile;

		$dataUsers = $this->request->getFile('profile');
        if($dataUsers->isValid() && !$dataUsers->hasMoved())
        {
            if(file_exists("uploads/profile/".$old_img_name)){
                unlink("uploads/profile/".$old_img_name);
            }
            $fileName = $dataUsers->getRandomName();
            $dataUsers->move('uploads/profile/', $fileName);
        }
            else
            {
                $fileName = $old_img_name;
            }
            if($this->Users->update($id, [
                'Name' => $this->request->getVar('name'),
                'Profile' => $fileName,
            ]));
            session()->destroy();
            session()->setFlashdata('message', 'Silahkan Login Kembali');
            return redirect()->to('/login');
        }else{
            return redirect()->back();
        }
    }
}   