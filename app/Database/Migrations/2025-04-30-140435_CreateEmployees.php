<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployees extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'employee_id' => ['type' => 'INT'],
            'date' => ['type' => 'DATE'],
            'work_hours' => ['type' => 'INT'],
            'overtime_hours' => ['type' => 'INT'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('attendances');
    }

    public function down()
    {
        //
    }
}
