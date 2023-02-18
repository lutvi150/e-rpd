<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableLembaga extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_lembaga' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_lembaga' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'id_pengelola' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id_lembaga', true);
        $this->forge->createTable('table_lembaga');
    }

    public function down()
    {

        $this->forge->dropTable('table_lembaga');
    }
}
