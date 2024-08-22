<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ClientModel;

class Home extends BaseController
{
    public function landing()
    {
        return view('landing');
    }

    public function login(): string
    {
        return view('login');
    }

    public function register(): string
    {
        return view('register');
    }

    public function dashboard(): string
{
    // Check if the user is logged in
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login');
    }

    $clientModel = new \App\Models\ClientModel();
    $data['clients'] = $clientModel->findAll();

    return view('dashboard', $data);
}


    public function registerUser()
    {
        $userModel = new UserModel();

        $validation = $this->validate([
            'firstName' => 'required|min_length[2]|max_length[255]',
            'lastName'  => 'required|min_length[2]|max_length[255]',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'password'  => 'required|min_length[8]',
        ]);

        if (!$validation) {
            return view('register', [
                'validation' => $this->validator,
            ]);
        }

        $data = [
            'first_name' => $this->request->getPost('firstName'),
            'last_name'  => $this->request->getPost('lastName'),
            'email'      => $this->request->getPost('email'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        if ($userModel->insert($data)) {
            return redirect()->to('/login')->with('status', 'Registration successful! You can now log in.');
        } else {
            return view('register', [
                'validation' => $this->validator,
                'error' => 'Failed to register. Please try again.',
            ]);
        }
    }

    public function loginUser()
    {
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'userId' => $user['id'],
                'firstName' => $user['first_name'],
                'lastName' => $user['last_name'],
                'isLoggedIn' => true,
            ]);
            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid Email or Password');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function addClient()
{
    // Check if the user is logged in
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login');
    }

    $validation = $this->validate([
        'firstName' => 'required|min_length[2]|max_length[255]',
        'lastName'  => 'required|min_length[2]|max_length[255]',
        'email'     => 'required|valid_email|is_unique[clients.email]',
    ]);

    if (!$validation) {
        return view('add_client', [
            'validation' => $this->validator,
        ]);
    }

    $clientModel = new \App\Models\ClientModel();

    // Handle file upload
    $filePath = '';
    if ($this->request->getFile('file')) {
        $file = $this->request->getFile('file');
        $filePath = $file->getRandomName();
        $file->move(WRITEPATH . 'uploads', $filePath);
    }

    $data = [
        'first_name' => $this->request->getPost('firstName'),
        'last_name'  => $this->request->getPost('lastName'),
        'email'      => $this->request->getPost('email'),
        'file_path'  => $filePath,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];

    if ($clientModel->insert($data)) {
        return redirect()->to('/dashboard')->with('status', 'Client added successfully!');
    } else {
        return view('add_client', [
            'validation' => $this->validator,
            'error' => 'Failed to add client. Please try again.',
        ]);
    }
}


public function editClient($id)
{
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login');
    }

    $clientModel = new ClientModel();
    $client = $clientModel->find($id);

    if (!$client) {
        return redirect()->to('/dashboard')->with('error', 'Client not found');
    }

    return view('edit_client', ['client' => $client]);
}



public function updateClient($id)
{
    $clientModel = new \App\Models\ClientModel();

    $validation = $this->validate([
        'firstName' => 'required|min_length[2]|max_length[255]',
        'lastName'  => 'required|min_length[2]|max_length[255]',
        'email'     => 'required|valid_email|is_unique[clients.email,id,' . $id . ']',
    ]);

    if (!$validation) {
        return view('edit_client', [
            'validation' => $this->validator,
            'client' => $this->request->getPost(),
        ]);
    }

    // Handle file upload
    $filePath = $this->request->getPost('existing_file_path'); // Use existing file path if no new file is uploaded
    if ($this->request->getFile('file')) {
        $file = $this->request->getFile('file');
        $filePath = $file->getRandomName();
        $file->move(WRITEPATH . 'uploads', $filePath);
    }

    $data = [
        'first_name' => $this->request->getPost('firstName'),
        'last_name'  => $this->request->getPost('lastName'),
        'email'      => $this->request->getPost('email'),
        'file_path'  => $filePath,
        'updated_at' => date('Y-m-d H:i:s')
    ];

    if ($clientModel->update($id, $data)) {
        return redirect()->to('/dashboard')->with('status', 'Client updated successfully!');
    } else {
        return view('edit_client', [
            'validation' => $this->validator,
            'client' => $this->request->getPost(),
            'error' => 'Failed to update client. Please try again.',
        ]);
    }
}


    public function deleteClient($id)
    {
        $clientModel = new ClientModel();

        if ($clientModel->delete($id)) {
            return redirect()->to('/dashboard')->with('status', 'Client deleted successfully!');
        } else {
            return redirect()->to('/dashboard')->with('error', 'Failed to delete client. Please try again.');
        }
    }
}
