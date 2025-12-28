<?php namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\PayrollModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $employeeModel = new \App\Models\EmployeeModel();
        $payrollModel = new PayrollModel();

        // Get total employees
        $totalEmployees = $employeeModel->countAll();

        // Get total salary paid (sum of all salaries)
        $totalSalary = $payrollModel->selectSum('salary')->first();

        // Pass data to the view
        return view('dashboard/index', [
            'totalEmployees' => $totalEmployees,
            'totalSalary' => $totalSalary['salary'],
        ]);
    }
}

