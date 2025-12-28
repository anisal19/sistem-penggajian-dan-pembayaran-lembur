<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class CreateEmployees extends Migration {
    public function up() {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'status' => ['type' => 'VARCHAR', 'constraint' => 20],
            'salary_per_day' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'salary_per_hour' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('employees');
    }
    public function down() {
        $this->forge->dropTable('employees');
    }
}