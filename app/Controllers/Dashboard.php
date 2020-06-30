<?php

namespace App\Controllers;

use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'user_logged_in' => $this->userModel->find($this->session->get('id')),
            'session' => \Config\Services::session()
        ];

        return view('dashboard/index', $data);
    }

    //--------------------------------------------------------------------

}
