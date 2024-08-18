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
        // Check if the user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        return view('dashboard');
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
}
