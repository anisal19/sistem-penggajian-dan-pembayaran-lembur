<?php

namespace App\Controllers;

use App\Models\PayrollModel;

class Payroll extends BaseController
{
    public function index()
    {
        // Load the payroll model
        //$payrollModel = new PayrollModel();
        $payrollModel = new \App\Models\PayrollModel();

        // Build a query to join payrolls with employees
        $builder = $payrollModel->builder();
        $builder->select('payrolls.*, employees.name as employee_name');
        $builder->join('employees', 'employees.id = payrolls.employee_id');
        $query = $builder->get();
        $payrolls = $query->getResultArray();
        //$data['payrolls'] = $payrollModel->findAll();

        // ✅ Add overtime calculation here
        $overtimeRate = 10000; // e.g., 10,000 per hour
        foreach ($payrolls as &$p) {
            $p['overtime_pay'] = $p['worked_hours'] * $overtimeRate;
            $p['total_salary'] = $p['salary'] + $p['overtime_pay'];
        }

        // Pass data to the view
        return view('payroll/index', ['payrolls' => $payrolls]);
        //return view('payroll/index', $data);
    }

    public function create()
    {
        // Load employee list to select in form
        $employeeModel = new \App\Models\EmployeeModel();
        $employees = $employeeModel->findAll();

        return view('payroll/create', ['employees' => $employees]);
    }

    public function store()
    {
        $payrollModel = new \App\Models\PayrollModel();

        $data = [
            'employee_id'   => $this->request->getPost('employee_id'),
            'worked_days'   => $this->request->getPost('worked_days'),
            'worked_hours'  => $this->request->getPost('worked_hours'),
            'salary'        => $this->request->getPost('salary'),
        ];

        $payrollModel->insert($data);

        return redirect()->to('/payroll');
    }

    public function generateFromAttendance()
    {
        $db = \Config\Database::connect();

        // Get total worked and overtime hours per employee
        $builder = $db->table('attendances');
        $builder->select('employee_id, SUM(work_hours) as total_hours, SUM(overtime_hours) as total_overtime');
        $builder->groupBy('employee_id');
        $result = $builder->get()->getResultArray();

        $payrollModel = new \App\Models\PayrollModel();

        foreach ($result as $row) {
            $employeeId = $row['employee_id'];
            $hours = $row['total_hours'];
            $overtime = $row['total_overtime'];

            $salary = ($hours * 10) + ($overtime * 15); // Customize rates as needed

            $payrollModel->insert([
                'employee_id' => $employeeId,
                'worked_hours' => $hours,
                'worked_days' => 0, // optional if not tracked
                'salary' => $salary,
            ]);
        }

        return redirect()->to('/payroll')->with('message', 'Payroll generated successfully.');
    }

    public function generate()
    {
        $attendanceModel = new \App\Models\AttendanceModel();
        $employeeModel = new \App\Models\EmployeeModel();
        $payrollModel = new \App\Models\PayrollModel();

        $employees = $employeeModel->findAll();

        foreach ($employees as $employee) {
            // Get total attendance for this employee
            $attendance = $attendanceModel->where('employee_id', $employee['id'])->findAll();

            $workedDays = count($attendance);
            $workedHours = array_sum(array_column($attendance, 'work_hours'));

            // Example salary calculation: $10 per hour
            $salary = $workedHours * 10; // adjust the rate if needed

            // Insert into payrolls table
            $payrollModel->insert([
                'employee_id' => $employee['id'],
                'worked_days' => $workedDays,
                'worked_hours' => $workedHours,
                'salary' => $salary,
            ]);
        }

        return redirect()->to('/payroll')->with('message', 'Payroll generated successfully!');
    }

    public function filter()
    {
        $start = $this->request->getGet('start_date');
        $end = $this->request->getGet('end_date');

        $payrollModel = new \App\Models\PayrollModel();
        $builder = $payrollModel->builder();
        $builder->select('payrolls.*, employees.name as employee_name');
        $builder->join('employees', 'employees.id = payrolls.employee_id');
        $builder->where('payrolls.created_at >=', $start);
        $builder->where('payrolls.created_at <=', $end);
        $query = $builder->get();
        $payrolls = $query->getResultArray();

        return view('payroll/index', ['payrolls' => $payrolls]);
    }

    public function exportCSV()
    {
        $payrollModel = new \App\Models\PayrollModel();
        $data = $payrollModel->findAll();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=payroll_export.csv');

        $output = fopen("php://output", "w");
        fputcsv($output, ['ID', 'Employee ID', 'Worked Days', 'Worked Hours', 'Salary', 'Created At']);
        foreach ($data as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
        exit;
    }


}

