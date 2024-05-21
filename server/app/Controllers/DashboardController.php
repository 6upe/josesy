<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index(): string
    {
        return 
         view('templates/header')
         .view('templates/aside')
        .view('dashboard/index')
        .view('templates/footer');
    }
}
