<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableRincianPerminggu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rincian_kegiatan_perminggu' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_rincian_kegiatan_perbulan' => [
                'type' => 'int',
                'constraint' => '11',
            ],
            'minggu' => [
                'type' => 'int',
                'constraint' => '5',
            ],
            'total_pagu_perminggu' => [
                'type' => 'BIGINT',
                'constraint' => '20',
            ],
        ]);
        $this->forge->addKey('id_rincian_kegiatan_perminggu', true);
        $this->forge->createTable('table_rincian_kegiatan_perminggu');
    }

    public function down()
    {
        $this->forge->dropTable('table_rincian_kegiatan_perminggu');
    }
}
