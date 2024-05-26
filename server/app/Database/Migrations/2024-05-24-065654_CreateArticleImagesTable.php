<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArticleImagesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'article_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'filename' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('article_id', 'articles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('article_images');
    }

    public function down()
    {
        $this->forge->dropTable('article_images');
    }
}
