<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['nama', 'username', 'email', 'password', 'role', 'is_active'];
    protected $useTimestamps = true;

    public function getUser($username = false)
    {
        if ($username == false) {
            return $this->orderBy('role', 'ASC')->findAll();
        }

        return $this->where('username', $username)->first();
    }
}
