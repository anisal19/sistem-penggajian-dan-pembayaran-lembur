<?php

namespace App\Models;

use CodeIgniter\Model;

class PayrollModel extends Model
{
    protected $table = 'payrolls';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'employee_id',
        'worked_days',
        'worked_hours',
        'salary',
        'date',
        'created_at',
        'updated_at'
    ];
}

