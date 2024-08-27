<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ClientModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    // Custom validation messages
    $validationRules = [
        'firstName'      => [
            'label' => 'First Name',
            'rules' => 'required|min_length[2]|max_length[255]',
        ],
        'lastName'       => [
            'label' => 'Last Name',
            'rules' => 'required|min_length[2]|max_length[255]',
        ],
        'email'          => [
            'label' => 'Email Address',
            'rules' => 'required|valid_email|is_unique[users.email]',
        ],
        'password'       => [
            'label' => 'Password',
            'rules' => 'required|min_length[8]',
        ],
        'confirmPassword'=> [
            'label' => 'Confirm Password',
            'rules' => 'required|matches[password]',
            'errors' => [
                'matches' => 'Passwords do not match!', // Custom error message for password mismatch
            ],
        ],
    ];

    if (!$this->validate($validationRules)) {
        return view('register', [
            'validation' => $this->validator,
        ]);
    }

    // Convert email to lowercase
    $email = strtolower($this->request->getPost('email'));

    $data = [
        'first_name' => $this->request->getPost('firstName'),
        'last_name'  => $this->request->getPost('lastName'),
        'email'      => $email, // Save lowercase email
        'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
    ];

    // Insert user data and redirect to login with success message
    if ($userModel->insert($data)) {
        return redirect()->to('/login')->with('status', 'Registration Successful! Please Log In.');
    } else {
        return view('register', [
            'validation' => $this->validator,
            'error' => 'Failed to Register. Please retry.',
        ]);
    }
}

    public function loginUser()
    {
        $userModel = new UserModel();
        $email = strtolower($this->request->getPost('email')); // Convert email to lowercase
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
        $file->move(FCPATH . '/uploads', $filePath);
    }

    // Convert email to lowercase
    $email = strtolower($this->request->getPost('email'));

    $data = [
        'first_name' => $this->request->getPost('firstName'),
        'last_name'  => $this->request->getPost('lastName'),
        'email'      => $email,
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
        $file->move(FCPATH . '/uploads', $filePath);
    }

    // Convert email to lowercase
    $email = strtolower($this->request->getPost('email'));

    $data = [
        'first_name' => $this->request->getPost('firstName'),
        'last_name'  => $this->request->getPost('lastName'),
        'email'      => $email,
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

    public function exportClientsToExcel()
{
    try {
        $clientModel = new ClientModel();
        $clients = $clientModel->findAll();

        if (empty($clients)) {
            throw new \Exception('No clients found');
        }

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set column headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'First Name');
        $sheet->setCellValue('C1', 'Last Name');
        $sheet->setCellValue('D1', 'Email');

        // Set custom column widths
        $sheet->getColumnDimension('A')->setWidth(10); // Width for column A
        $sheet->getColumnDimension('B')->setWidth(20); // Width for column B
        $sheet->getColumnDimension('C')->setWidth(20); // Width for column C
        $sheet->getColumnDimension('D')->setWidth(30); // Width for column D

        // Add client data to spreadsheet
        $row = 2;
        foreach ($clients as $client) {
            $sheet->setCellValue('A' . $row, $client['id']);
            $sheet->setCellValue('B' . $row, $client['first_name']);
            $sheet->setCellValue('C' . $row, $client['last_name']);
            $sheet->setCellValue('D' . $row, $client['email']);
            $row++;
        }

        // Create a Writer instance
        $writer = new Xlsx($spreadsheet);

        // Set filename and output
        $filename = 'Client Details.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), 'clients_data');
        $writer->save($temp_file);

        // Prepare the response
        $response = $this->response->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
                                  ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                                  ->setHeader('Cache-Control', 'max-age=0')
                                  ->setBody(file_get_contents($temp_file));

        // Clean up the temporary file
        unlink($temp_file);

        return $response;
    } catch (\Exception $e) {
        return $this->response->setStatusCode(500)->setBody('Error: ' . $e->getMessage());
    }
}

}
