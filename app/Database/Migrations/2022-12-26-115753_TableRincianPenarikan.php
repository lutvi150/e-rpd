<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableRincianPenarikan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_penarikan' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_rincian' => [
                'type'       => 'int',
            ],
            'detail_penarikan' => [
                'type' => 'TEXT',
            ],
            'jumlah_penarikan' =>[
                'type' =>'BIGINT',
            ],
        ]);
        $this->forge->addKey('id_penarikan', true);
        $this->forge->createTable('table_rincian_penarikan');
    }

    public function down()
    {
        $this->forge->dropTable('table_rincian_penarikan');
    }
}
