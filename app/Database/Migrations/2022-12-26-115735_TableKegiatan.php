<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableKegiatan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kegiatan' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_kegiatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'uraian_kegiatan' => [
                'type' => 'TEXT',
            ],
            'pagu_kegiatan' =>[
                'type' =>'BIGINT',
            ],
            'mulai_pelaksanaan' =>[
                'type' => 'VARCHAR',
                'constraint'=>'50'
            ],
            'akhir_pelaksanaan' =>[
                'type' => 'VARCHAR',
                'constraint'=>'50'
            ],
            'tahun_anggaran'=>[
                'type' => 'VARCHAR',
                'constraint'=>'5'
            ],
        ]);
        $this->forge->addKey('id_kegiatan', true);
        $this->forge->createTable('table_kegiatan');
    }

    public function down()
    {
        $this->forge->dropTable('table_kegiatan');
    }
}
