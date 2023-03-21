<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Controller extends BaseController
{
    use ResponseTrait;
    public function verifikasi(Type $var = null)
    {
        $verifikasi = new \App\Models\ModelVerifikasiKegiatan;
        $unit = new \App\Models\ModelUnit;
        $id_lembaga = $this->request->getPost('id_lembaga');
        $status = $this->request->getPost('status');
        $insert = [
            'id_lembaga' => $id_lembaga,
            'status' => $status,
            'comment' => '-',
        ];
        if ($status == 'verifikasi') {
            $unit->update($id_lembaga, ['status_verifikasi' => 2]);
            $msg = 'Verifikasi berhasil di ajukan';
        }
        $response = [
            'status' => 'success',
            'msg' => $msg,
        ];
        return $this->respond($response, 200);
    }
    public function history_verifikasi($id_lembaga)
    {
        $lembaga = new \App\Models\ModelUnit;
        $verifikasi = new \App\Models\ModelVerifikasiKegiatan;
        $data['lembaga'] = $lembaga->find($id_lembaga);
        $data['verifikasi'] = $verifikasi->where('id_lembaga', $id_lembaga)->findAll();
        // return $this->respond($data, 200);
        // exit;
        return view('rpd/unit/data_history_pengajuan', $data);
    }
}
