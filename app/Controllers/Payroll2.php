<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Payroll extends Controller
{
    public function index()
    {
        return view('payroll/index'); // You can change this to match your view file.
    }
}
