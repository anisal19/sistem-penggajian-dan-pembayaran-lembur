<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use CodeIgniter\Controller;

class Employee extends Controller
{
    public function create()
    {
        $data['title'] = 'Add Employee';
        return view('employee/create', $data);
    }

    public function store()
    {
        helper(['form']);

        $rules = [
            'name' => 'required|min_length[3]',
            'status' => 'required|in_list[active,inactive]',
            'salary_per_day' => 'required|decimal',
            'salary_per_hour' => 'required|decimal',
        ];

        if ($this->validate($rules)) {
            $model = new EmployeeModel();
            $model->save([
                'name' => $this->request->getPost('name'),
                'status' => $this->request->getPost('status'),
                'salary_per_day' => $this->request->getPost('salary_per_day'),
                'salary_per_hour' => $this->request->getPost('salary_per_hour'),
            ]);
            return redirect()->to('/')->with('message', 'Employee created!');
        } else {
            return view('employee/create', [
                'title' => 'Add Employee',
                'validation' => $this->validator,
            ]);
        }
    }

    public function testModel()
    {
        $model = new \App\Models\EmployeeModel();
        $data = $model->findAll();
        dd($data); // dump and die to test output
    }
}
