<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableRincianKegiatanPerbulan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rincian_kegiatan_perbulan' => [
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
                'type' => 'BIGINT',
                'constraint' => '20',
            ],
            'total_pagu_perbulan' => [
                'type' => 'BIGINT',
                'constraint' => '20',
            ],
        ]);
        $this->forge->addKey('id_rincian_kegiatan_perbulan', true);
        $this->forge->createTable('table_rincian_kegiatan_perbulan');
    }

    public function down()
    {
        $this->forge->dropTable('table_rincian_kegiatan_perbulan');
    }
}
