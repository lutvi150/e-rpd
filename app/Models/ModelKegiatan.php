<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKegiatan extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'table_kegiatan';
    protected $primaryKey = 'id_kegiatan';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['kode_kegiatan', 'uraian_kegiatan', 'pagu_kegiatan', 'mulai_pelaksanaan', 'akhir_pelaksanaan', 'id_lembaga', 'tahun_anggaran'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];
}
