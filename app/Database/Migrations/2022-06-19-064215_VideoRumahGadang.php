<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VideoRumahGadang extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => 7,
                'unique' => true,
            ],
            'rumah_gadang_id' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'duration' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'view' => [
                'type' => 'INT',
                'null' => true,
                'default' => 0,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ];

        $this->db->disableForeignKeyChecks();
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('rumah_gadang_id', 'rumah_gadang', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('video_rumah_gadang');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('video_rumah_gadang');
    }
}
