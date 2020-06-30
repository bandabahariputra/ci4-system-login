<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    protected function _validation()
    {
        if ($this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi.'
                ]
            ],
            'username' => [
                'rules' => 'required|alpha_numeric|is_unique[user.username,id,{id}]',
                'errors' => [
                    'required' => 'Username harus diisi.',
                    'alpha_numeric' => 'Username hanya boleh diisi dengan huruf dan angka.',
                    'is_unique' => 'Username sudah digunakan.'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi.',
                    'valid_email' => 'Email tidak valid.'
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role harus diisi.'
                ]
            ]
        ])) {
            return true;
        }
    }

    public function index()
    {
        $data = [
            'title' => 'User',
            'user_logged_in' => $this->userModel->find($this->session->get('id')),
            'users' => $this->userModel->getUser(),
            'session' => \Config\Services::session()
        ];

        return view('user/index', $data);
    }

    public function new()
    {
        $data = [
            'title' => 'User',
            'user_logged_in' => $this->userModel->find($this->session->get('id')),
            'validation' => \Config\Services::validation()
        ];

        return view('user/new', $data);
    }

    public function create()
    {
        if ($this->_validation() == false) {
            $validation = \Config\Services::validation();
            return redirect()->to('/user/new')->withInput()->with('validation', $validation);
        }

        $data = [
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('username'), PASSWORD_DEFAULT),
            'role' => $this->request->getVar('role'),
            'is_active' => 1,
            'created_at' => date('yy-m-d H:m:s'),
            'updated_at' => date('yy-m-d H:m:s')
        ];

        $this->userModel->save($data);

        return redirect()->to('/user')->with('msg', 'Data berhasil ditambah.');
    }

    public function edit($username)
    {
        $data = [
            'title' => 'User',
            'user_logged_in' => $this->userModel->find($this->session->get('id')),
            'user' => $this->userModel->getUser($username),
            'validation' => \Config\Services::validation()
        ];

        return view('user/edit', $data);
    }

    public function update($id)
    {
        if ($this->_validation() == false) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $data = [
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('username'), PASSWORD_DEFAULT),
            'role' => $this->request->getVar('role'),
            'updated_at' => date('yy-m-d H:m:s')
        ];

        $this->userModel->save($data);

        return redirect()->to('/user')->with('msg', 'Data berhasil diedit.');
    }

    public function changeStatus($username)
    {
        $user = $this->userModel->getUser($username);

        $data = [
            'id' => $user['id'],
            'is_active' => !$user['is_active']
        ];

        $this->userModel->save($data);

        return redirect()->to('/user')->with('msg', 'diedit');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);

        return redirect()->to('/user')->with('msg', 'Data berhasil dihapus.');
    }

    public function profile()
    {
        $data = [
            'title' => 'My Profile',
            'user_logged_in' => $this->userModel->find($this->session->get('id')),
            'session' => \Config\Services::session(),
            'validation' => \Config\Services::validation()
        ];

        return view('user/profile', $data);
    }

    public function changeProfile($id)
    {
        $validate = $this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi.'
                ]
            ],
            'username' => [
                'rules' => 'required|alpha_numeric|is_unique[user.username,id,{id}]',
                'errors' => [
                    'required' => 'Username harus diisi.',
                    'alpha_numeric' => 'Username hanya boleh diisi dengan huruf dan angka.',
                    'is_unique' => 'Username sudah digunakan.'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi.',
                    'valid_email' => 'Email tidak valid.'
                ]
            ]
        ]);

        if (!$validate) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $data = [
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'updated_at' => date('yy-m-d H:m:s')
        ];

        $this->userModel->save($data);

        return redirect()->back()->with('msg', 'Profile berhasil diedit.');
    }
}
