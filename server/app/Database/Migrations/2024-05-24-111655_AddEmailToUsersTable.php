<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmailToUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
                'after' => 'position', // Adds the column after the 'position' column
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'email');
    }
}
