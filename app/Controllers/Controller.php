<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKegiatan;
use App\Models\ModelUnit;
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
    // use for make report
    public function make_report($type, $id_lembaga)
    {
        // use for get data
        $lembaga = new \App\Models\ModelUnit;
        $data['lembaga'] = $lembaga->find($id_lembaga);
        $data['file_name'] = $data['lembaga']->nama_lembaga . "_" . $type;
        if ($type == 'kegiatan') {
            $get_data = $this->report_kegiatan($id_lembaga);
            $data['month'] = $this->month('get');
            $data['activity'] = $get_data['activity'];
            $page = view($get_data['page'], $data);
        }
        $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
        $mpdf->SetTitle($data['file_name']);
        $mpdf->SetAuthor($data['file_name']);
        $mpdf->SetCreator('IAIN Batusangkar');
        $mpdf->SetDisplayMode('fullpage');
        // $mpdf->SetWatermarkText($data['file_name']);
        $mpdf->showWatermarkText = true;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($page);
        $mpdf->Output($data['file_name'] . '.pdf', 'I');
        exit;
        return $this->respond(['type' => $type, 'id_lembaga' => $id_lembaga], 200);
    }
    public function report_kegiatan($id_lembaga)
    {
        $lembaga = new ModelUnit();
        $kegiatan = new ModelKegiatan();
        $data['activity'] = $kegiatan->asObject()->where('id_lembaga', $id_lembaga)->findAll();
        $data['page'] = 'report/report_kegiatan';
        return $data;
    }
    // costume bulan
    public function month($status)
    {
        $month = [
            [
                'kode' => 1,
                'month' => "Jan",
                'long_month' => 'Januari',
            ],
            [
                'kode' => 2,
                'month' => "Feb",
                'long_month' => 'Februari',
            ],
            [
                'kode' => 3,
                'month' => "Mar",
                'long_month' => 'Maret',
            ],
            [
                'kode' => 4,
                'month' => "Apr",
                'long_month' => 'April',
            ],
            [
                'kode' => 5,
                'month' => "Mei",
                'long_month' => 'Mei',
            ],
            [
                'kode' => 6,
                'month' => "Juni",
                'long_month' => 'Juni',
            ],
            [
                'kode' => 7,
                'month' => "Juli",
                'long_month' => 'Juli',
            ],
            [
                'kode' => 8,
                'month' => "Agust",
                'long_month' => 'Agustus',
            ],
            [
                'kode' => 9,
                'month' => "Sept",
                'long_month' => 'Semptember',
            ],
            [
                'kode' => 10,
                'month' => "Okt",
                'long_month' => 'Oktober',
            ],
            [
                'kode' => 11,
                'month' => "Nov",
                'long_month' => 'November',
            ],
            [
                'kode' => 12,
                'month' => "Des",
                'long_month' => 'Desember',
            ],

        ];
        if ($status == 'get') {
            return $month;
        } elseif ($status == 'convert') {
            foreach ($month as $key => $value) {
                $result_month[$value['kode']] = (object) [
                    'month' => $value['month'],
                    'long_month' => $value['long_month'],
                ];
            }
            return $result_month;
        }
    }
}
