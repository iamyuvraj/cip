<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table = 'clients';
    protected $primaryKey = 'id';
    protected $allowedFields = ['first_name', 'last_name', 'email', 'file_path', 'created_at', 'updated_at'];
    
    protected $useTtimestamps = true; // Enable timestamp handling
    protected $createdField = 'created_at'; // Field name for creation timestamp
    protected $updatedField = 'updated_at'; // Field name for update timestamp

    public function addClient($data, $file = null)
    {
        // Convert email to lowercase
        if (isset($data['email'])) {
            $data['email'] = strtolower($data['email']);
        }

        if ($file && $file->isValid() && $file->getExtension() === 'pdf') {
            $filePath = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $filePath);
            $data['file_path'] = $filePath;
        }

        return $this->save($data);
    }

    public function updateClient($id, $data, $file = null)
    {
        // Convert email to lowercase
        if (isset($data['email'])) {
            $data['email'] = strtolower($data['email']);
        }

        if ($file && $file->isValid() && $file->getExtension() === 'pdf') {
            $filePath = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $filePath);
            $data['file_path'] = $filePath;
        }

        return $this->update($id, $data);
    }
}
