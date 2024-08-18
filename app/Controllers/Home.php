<?php

namespace App\Controllers;

use App\Models\UserModel;

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
        return view('dashboard');
    }

    public function registerUser()
    {
        $userModel = new UserModel();

        // Validate incoming request
        $validation = $this->validate([
            'firstName' => 'required|min_length[2]|max_length[255]',
            'lastName'  => 'required|min_length[2]|max_length[255]',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'password'  => 'required|min_length[8]',
        ]);

        if (!$validation) {
            // Return to register view with validation errors
            return view('register', [
                'validation' => $this->validator,
            ]);
        }

        // Prepare data for insertion
        $data = [
            'first_name' => $this->request->getPost('firstName'),
            'last_name'  => $this->request->getPost('lastName'),
            'email'      => $this->request->getPost('email'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // Hash the password
        ];

        // Insert user data into the database
        if ($userModel->insert($data)) {
            // Redirect to login with success message
            return redirect()->to('/login')->with('status', 'Registration successful! You can now log in.');
        } else {
            // Return to register view with an error
            return view('register', [
                'validation' => $this->validator,
                'error' => 'Failed to register. Please try again.',
            ]);
        }
    }
}
