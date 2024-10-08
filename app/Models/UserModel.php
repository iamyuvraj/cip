<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // The table associated with the model
    protected $primaryKey = 'id'; // The primary key of the table

    protected $allowedFields = ['first_name', 'last_name', 'email', 'password']; // Fields that can be inserted/updated
    protected $beforeInsert = ['beforeInsert'];
    protected function beforeInsert(array $data): array
    {
        if (isset($data['data']['email'])) {
            $data['data']['email'] = strtolower($data['data']['email']);
        }
        return $data;
    }
}
