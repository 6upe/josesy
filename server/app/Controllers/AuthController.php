<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        $session = session();
        $model = new UserModel();
        
        // Get the email and password from the POST request
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        // Find the user by email
        $user = $model->where('email', $email)->first();
        
        if ($user) {
            // Verify the password
            if (password_verify($password, $user['password'])) {
                $session->set([
                    'user_id' => $user['id'],
                    'user_email' => $user['email'],
                    'user_firstname' => $user['firstname'],
                    'user_lastname' => $user['lastname'],
                    'position' => $user['position'],
                    'logged_in' => true,
                ]);
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('error', 'Invalid password.');
                return redirect()->to('/auth/login');
            }
        } else {
            $session->setFlashdata('error', 'Email not found.');
            return redirect()->to('/auth/login');
        }
    }


    public function register()
    {
        return view('auth/register');
    }

    public function processRegister()
    {
        $userModel = new UserModel();

        // Get form input
        $data = [
            'firstname' => $this->request->getPost('firstname'),
            'lastname' => $this->request->getPost('lastname'),
            'position' => $this->request->getPost('position'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'password_confirm' => $this->request->getPost('password_confirm'),
        ];

        // Validate input
        if ($data['password'] !== $data['password_confirm']) {
            return redirect()->back()->with('error', 'Passwords do not match');
        }

        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        // Remove password_confirm from data before inserting
        unset($data['password_confirm']);

        // Insert user
        if ($userModel->insert($data)) {
            return redirect()->to('/auth/login')->with('success', 'Registration successful. Please login.');
        } else {
            return redirect()->back()->with('error', 'Failed to register. Please try again.');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/auth/login');
    }
}
