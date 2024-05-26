<?php

namespace App\Controllers;

use CodeIgniter\Database\Exceptions\DatabaseException;

class Home extends BaseController
{
    public function __construct()
    {
        // Load the database service
        $this->db = \Config\Database::connect();
        
        if (!session()->get('isLoggedIn')) {
            redirect()->to('/auth/login');
        }

    }


    public function index()
    {
        try {
            // Attempt to perform a simple database query to check the connection
            $query = $this->db->query('SELECT 1');
            $result = $query->getResult();
            
            // If the query is successful, database connection is established
            echo 'Database connection is successful!';
        } catch (DatabaseException $e) {
            // If an exception is caught, there's an issue with the database connection
            echo 'Database connection error: ' . $e->getMessage();
        }

        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        return view('/dashboard');
    }
}


