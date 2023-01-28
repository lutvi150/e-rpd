<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableRincianPerbulan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rincian_perbulan' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'rincian_perbulan' => [
                'type'       => 'TEXT',
            ],
        ]);
        $this->forge->addKey('id_rincian_perbulan', true);
        $this->forge->createTable('table_rincian_perbulan');
    }

    public function down()
    {
        $this->forge->dropTable('table_rincian_perbulan');
    }
}
