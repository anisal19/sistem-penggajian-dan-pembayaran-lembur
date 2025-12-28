<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
// use App\Models\PayrollModel; // Uncomment if you have payroll data

class Dashboard extends BaseController
{
    public function index()
    {
        $employeeModel = new EmployeeModel();
        $totalEmployees = $employeeModel->countAll();

        // Placeholder for totalPaid
        $totalPaid = 0; // Replace this when payroll data is ready

        return view('dashboard/index', [
            'totalEmployees' => $totalEmployees,
            'totalPaid' => $totalPaid,
        ]);
    }
}
