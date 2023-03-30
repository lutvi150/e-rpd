<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Controller extends BaseController
{
    use ResponseTrait;
    public function verifikasi(Type $var = null)
    {
        $session = \Config\Services::session();
        $verifikasi = new \App\Models\ModelVerifikasiKegiatan;
        $unit = new \App\Models\ModelUnit;
        $id_lembaga = $this->request->getPost('id_lembaga');
        $status = $this->request->getPost('status');
        $comment = $this->request->getPost('comment');
        if ($comment == null) {
            $comment = '-';
        }
        $insert = [
            'id_lembaga' => $id_lembaga,
            'status' => $status,
            'comment' => $comment,
            'created_by' => $session->get('id'),
        ];
        $verifikasi->insert($insert);
        $unit->update($id_lembaga, ['status_verifikasi' => $status]);
        $response = [
            'status' => 'success',
            'msg' => 'process success',
        ];
        return $this->respond($response, 200);
    }
    public function history_verifikasi($id_lembaga)
    {
        $db = \Config\Database::connect();
        $lembaga = new \App\Models\ModelUnit;
        $verifikasi = $db->table('table_verifikasi as a');
        $data['lembaga'] = $lembaga->find($id_lembaga);
        $data['verifikasi'] = $verifikasi->where('a.id_lembaga', $id_lembaga)->join('table_user as b', 'a.created_by=b.id')->select('a.*,b.nama_user')->orderBy('created_at', 'desc')->get()->getResult();
        // return $this->respond($data, 200);exit;
        return view('rpd/unit/data_history_pengajuan', $data);
    }
}
