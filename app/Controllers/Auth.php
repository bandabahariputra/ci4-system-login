<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
	public function index()
	{
		if ($this->session->get('logged_in')) {
			return redirect()->to('/dashboard');
		}

		$data = [
			'session' => \Config\Services::session(),
			'validation' => \Config\Services::validation()
		];

		return view('auth/login', $data);
	}

	public function login()
	{
		$validate = $this->validate([
			'username' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Username harus diisi.'
				]
			],
			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Password harus diisi.'
				]
			]
		]);

		if (!$validate) {
			$validation = \Config\Services::validation();
			return redirect()->to('/')->withInput()->with('validation', $validation);
		}

		$userModel = new UserModel();

		$cek_user = $userModel->getUser($this->request->getVar('username'));

		// jika username tidak ditemukan
		if (!$cek_user) {
			return redirect()->to('/')->with('msg', '<div class="alert alert-danger">Username tidak ditemukan.</div>');
		}

		// jika status tidak tidak aktif
		if ($cek_user['is_active'] != 1) {
			return redirect()->to('/')->with('msg', '<div class="alert alert-danger">User diblokir.</div>');
		}

		// jika password salah
		if (!password_verify($this->request->getVar('password'), $cek_user['password'])) {
			return redirect()->to('/')->with('msg', '<div class="alert alert-danger">Password salah.</div>');
		}

		// LOGIN BERHASIL

		// set session
		$newdata = [
			'id' => $cek_user['id'],
			'role' => $cek_user['role'],
			'logged_in' => TRUE
		];
		$this->session->set($newdata);

		return redirect()->to('/dashboard');
	}

	public function logout()
	{
		// remove session
		$newdata = ['username', 'role', 'logged_in'];
		$this->session->remove($newdata);

		return redirect()->to('/')->with('msg', '<div class="alert alert-info">Logout berhasil.</div>');
	}
}
