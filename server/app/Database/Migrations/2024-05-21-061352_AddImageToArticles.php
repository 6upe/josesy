<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddImageToArticles extends Migration
{
    public function up()
    {
        $this->forge->addColumn('articles', [
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
                'after' => 'content' // Adjust the position as needed
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('articles', 'image');
    }

}
