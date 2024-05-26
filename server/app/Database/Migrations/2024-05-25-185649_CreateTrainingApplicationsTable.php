<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTrainingApplicationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'service' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'message' => [
                'type' => 'TEXT',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('training_applications');
    }

    public function down()
    {
        $this->forge->dropTable('training_applications');
    }
}
