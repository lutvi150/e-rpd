<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKegiatan;
use App\Models\ModelRincianKegiatan;
use App\Models\ModelRincianKegiatanPerbulan;
use App\Models\ModelRincianKegiatanPerminggu;
use App\Models\ModelUnit;
use App\Models\ModelVerifikasiKegiatan;
use CodeIgniter\API\ResponseTrait;

class Controller extends BaseController
{
    use ResponseTrait;
    public function verifikasi(Type $var = null)
    {
        $session = \Config\Services::session();
        $verifikasi = new ModelVerifikasiKegiatan();
        $unit = new ModelUnit();
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
        $lembaga = new ModelUnit();
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
        $lembaga = new ModelUnit();
        $data['lembaga'] = $lembaga->find($id_lembaga);
        $data['file_name'] = $data['lembaga']->nama_lembaga . "_" . $type;
        if ($type == 'kegiatan') {
            $get_data = $this->report_kegiatan($id_lembaga);
            $data['month'] = $this->month('get');
            $data['activity'] = $get_data['activity'];
            $page = view($get_data['page'], $data);
        } elseif ($type == 'bulanan') {
            $get_data = $this->report_bulanan($id_lembaga);
            $data['data_bulanan'] = $get_data;
            $page = view($get_data['page'], $data);
        } elseif ($type == 'mingguan') {
            $get_data = $this->report_mingguan($id_lembaga);
            $page = view($get_data['page'], $data);
            $data['data_mingguan'] = $get_data;
        }
        // return $this->respond($data, 200);exit;
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
    public function report_bulanan($id_lembaga)
    {
        $data['page'] = 'report/report_bulanan';
        $kegiatan = new ModelKegiatan();
        $unit = new ModelUnit();
        $rincian_kegiatan = new ModelRincianKegiatan();
        $rincian_kegiatan_perbulan = new ModelRincianKegiatanPerbulan();
        $data_kegiatan = $kegiatan->asObject()->findAll();
        $array_kegiatan = [];
        if ($data_kegiatan) {
            foreach ($data_kegiatan as $key => $value) {
                $data_rincian_kegiatan = $rincian_kegiatan->asObject()->where('id_kegiatan', $value->id_kegiatan)->findAll();
                $array_rincian_kegiatan = [];
                if ($data_rincian_kegiatan) {
                    foreach ($data_rincian_kegiatan as $key2 => $value2) {
                        $array_rincian_kegiatan[] = $value2;
                        $value2->{'rincian_pagu'} = $rincian_kegiatan_perbulan->asObject()->select('total_pagu_perbulan as pagu,bulan')->where('id_rincian_kegiatan', $value2->id_rincian)->orderBy('bulan')->findAll();
                    }
                }
                $array_kegiatan[] = $value;
                $value->{'detail_kegiatan'} = $array_rincian_kegiatan;
            }
        }
        $data['month'] = $this->month('get');
        $data['kegiatan'] = $array_kegiatan;
        return $data;
    }
    public function report_mingguan($id_lembaga)
    {
        $data['page'] = 'report/report_mingguan';
        $month = $this->month('convert');
        $kegiatan = new ModelKegiatan();
        $unit = new ModelUnit();
        $rincian_kegiatan = new ModelRincianKegiatan();
        $rincian_kegiatan_perbulan = new ModelRincianKegiatanPerbulan();
        $rincian_kegiatan_perminggu = new ModelRincianKegiatanPerminggu();
        $data_kegiatan = $kegiatan->asObject()->findAll();
        $array_kegiatan = [];
        // $new_data_month = [];
        $array_mingguan = [];
        if ($data_kegiatan) {
            foreach ($data_kegiatan as $key => $kegiatan) {
                $data_rincian_kegiatan = $rincian_kegiatan->asObject()->where('id_kegiatan', $kegiatan->id_kegiatan)->findAll();
                if ($data_rincian_kegiatan) {
                    $array_rincian_kegiatan = [];
                    foreach ($data_rincian_kegiatan as $key => $rincian_kegiatan) {
                        $kegiatan_perminggu=$rincian_kegiatan_perminggu->asObject()->where('id_rincian_kegiatan_perbulan',$rincian_kegiatan->id_rincian)
                        $array_rincian_kegiatan[] = $rincian_kegiatan;
                    }
                    $kegiatan->{'rincian_kegiatan'} = $array_rincian_kegiatan;
                } else {
                    $kegiatan->{'rincian_kegiatan'} = [];
                }
                $array_kegiatan[] = $kegiatan;
            }
        }
        foreach ($month as $key_month => $value_month) {
            $array_mingguan[] = $value_month;
            // if ($data_kegiatan) {
            //     foreach ($data_kegiatan as $key => $value) {
            //         $data_rincian_kegiatan = $rincian_kegiatan->asObject()->where('id_kegiatan', $value->id_kegiatan)->findAll();
            //         $array_rincian_kegiatan = [];
            //         if ($data_rincian_kegiatan) {
            //             foreach ($data_rincian_kegiatan as $key2 => $value2) {
            //                 $array_rincian_kegiatan[] = $value2;
            //                 $hitung_rincian = $rincian_kegiatan_perbulan->asObject()->select('total_pagu_perbulan,id_rincian_kegiatan_perbulan')->where('bulan', $key)->where('id_rincian_kegiatan', $value2->id_rincian)->first();
            //                 $value2->{'harga_satuan'} = $hitung_rincian == null ? 0 : $hitung_rincian->total_pagu_perbulan;
            //                 if ($hitung_rincian) {
            //                     $value2->{'rincian_perminggu'} = $rincian_kegiatan_perminggu->where('id_rincian_kegiatan_perbulan', $hitung_rincian->id_rincian_kegiatan_perbulan)->orderBy('minggu', 'asc')->findAll();
            //                 } else {
            //                     $value2->{'rincian_perminggu'} = $hitung_rincian;
            //                 }
            //             }
            //             $array_kegiatan[] = $value;
            //             $value->{'detail_kegiatan'} = $array_rincian_kegiatan;
            //         }
            //     }
            //     $value_month->{'number_month'} = $key_month;
            //     $value_month->{'kegiatan'} = $array_kegiatan;
            //     $new_data_month[] = $value_month;
            // }

        }
        $data['kegiatan'] = $array_kegiatan;
        $data['mingguan'] = $array_mingguan;
        // $data['month'] = $month;
        // $data['new_month'] = $new_data_month;
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
