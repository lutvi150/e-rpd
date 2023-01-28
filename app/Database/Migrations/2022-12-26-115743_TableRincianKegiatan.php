<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

use function PHPSTORM_META\type;

class TableRincianKegiatan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rincian' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_kegiatan' => [
                'type'       => 'int',
                'constraint' => '11',
            ],
            'kode_rincian' => [
                'type' => 'VARCHAR',
                'constraint'=>'255',
            ],
            'uraian_rincian_kegiatan' =>[
                'type' =>'TEXT',
            ],'pagu_rincian_kegiatan' =>[
                'type'=>'int',
            ],
        ]);
        $this->forge->addKey('id_rincian', true);
        $this->forge->createTable('table_rincian_kegiatan');
    }

    public function down()
    {
        $this->forge->dropTable('table_rincian_kegiatan');
    }
}
