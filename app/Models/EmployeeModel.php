<?php

// app/Models/EmployeeModel.php
namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'status', 'salary_per_day', 'salary_per_hour'];
}


