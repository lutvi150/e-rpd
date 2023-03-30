<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableRincianKegiatanPerhari extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rincian_kegiatan_perhari' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_rincian_kegiatan' => [
                'type' => 'int',
                'constraint' => '11',
            ],
            'bulan' => [
                'type' => 'VARCHAR',
                'constraint' => '5',
            ],
            'rincian_perhari' => [
                'type' => 'TEXT',
            ],
            'rincian_kegiatan_perhari' => [
                'type' => 'TEXT',
            ],
        ]);
        $this->forge->addKey('id_rincian_kegiatan_perhari', true);
        $this->forge->createTable('table_rincian_kegiatan_perhari');
    }

    public function down()
    {
        $this->forge->dropTable('table_rincian_kegiatan_perhari');
    }
}
