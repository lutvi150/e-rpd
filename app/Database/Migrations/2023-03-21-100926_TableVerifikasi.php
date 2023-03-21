<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableVerifikasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_verifikasi' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_lembaga' => [
                'type' => 'BIGINT',
                'constraint' => '20',
            ],
            'status' => [
                'type' => 'TEXT',
            ],
            'comment' => [
                'type' => 'TEXT',
            ],
            'created_at' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);
        $this->forge->addKey('id_verifikasi', true);
        $this->forge->createTable('table_verifikasi');
    }

    public function down()
    {
        $this->forge->dropTable('table_verifikasi');
    }
}
