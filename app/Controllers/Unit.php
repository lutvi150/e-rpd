<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKegiatan;
use App\Models\ModelUnit;
use CodeIgniter\API\ResponseTrait;

class Unit extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        return view('rpd/unit/dashboard');
    }
    public function rpd(Type $var = null)
    {
        $session = \Config\Services::session();
        $id_pengelola = $session->get('id');
        $unit = new ModelUnit();
        $data['unit'] = $unit->where('id_pengelola', $id_pengelola)->findAll();
        // return $this->respond($data, 200);
        // exit;
        return view('rpd/unit/data_unit', $data);
    }
    // use fot add new action
    public function tambah_kegiatan($id_unit = 0)
    {
        if ($id_unit == 0) {
            return redirect()->route('unit/rpd');
        } else {
            $lembaga = new ModelUnit();
            $kegiatan = new ModelKegiatan();
            $data['lembaga'] = $lembaga->find($id_unit);
            $data['month'] = $this->month('get');
            $data['activity'] = $kegiatan->asObject()->where('id_lembaga', $id_unit)->findAll();
            // return $this->respond($data, 200);exit;
            return view('rpd/unit/data_kegiatan', $data);
        }
    }
    // store activity
    public function store_kegiatan($status)
    {
        $validation = \Config\Services::validation();
        $validation->setRules(
            [
                'kode_kegiatan' => 'required',
                'uraian_kegiatan' => 'required',
                'pagu_kegiatan' => 'required|numeric',
            ],
            [
                'kode_kegiatan' => [
                    'required' => 'Kode Kegiatan tidak boleh kosong',
                ],
                'uraian_kegiatan' => [
                    'required' => 'Uraian Kegiatan tidak boleh kosong',
                ],
                'pagu_kegiatan' => [
                    'required' => 'Pagu Kegiatan tidak boleh kosong',
                    'numeric' => 'Pagu Kegiatan harus berupa angka',
                ],
            ]
        );
        if (!$validation->withRequest($this->request)->run()) {
            $response = [
                'status' => 'validation_failed',
                'errors' => $validation->getErrors(),
            ];
        } else {

            $kegiatan = new ModelKegiatan();
            $kode_kegiatan = $this->request->getPost('kode_kegiatan');
            $uraian_kegiatan = $this->request->getPost('uraian_kegiatan');
            $pagu_kegiatan = $this->request->getPost('pagu_kegiatan');
            $mulai_pelaksanaan = $this->request->getPost('mulai_pelaksanaan');
            $akhir_pelaksanaan = $this->request->getPost('akhir_pelaksanaan');
            $id_lembaga = $this->request->getPost('id_lembaga');
            $tahun_anggaran = date('Y');
            $insert = [
                'kode_kegiatan' => $kode_kegiatan,
                'uraian_kegiatan' => $uraian_kegiatan,
                'pagu_kegiatan' => $pagu_kegiatan,
                'mulai_pelaksanaan' => $mulai_pelaksanaan,
                'akhir_pelaksanaan' => $akhir_pelaksanaan,
                'id_lembaga' => $id_lembaga,
                'tahun_anggaran' => $tahun_anggaran,

            ];
            if ($status == 'store') {
                $make_data = $kegiatan->insert($insert);
                $msg = 'Data kegiatan berhasil di tambahkan';
            } else {
                $id_kegiatan = $this->request->getPost('id_kegiatan');
                $make_data = $kegiatan->update($id_kegiatan, $insert);
                $msg = 'Data kegiatan berhasil di update';
            }
            $response = [
                'status' => 'success',
                'msg' => $msg,
            ];
        }
        return $this->respond($response, 200);
    }
    // delete activity
    public function delete_kegiatan()
    {
        $id = $this->request->getPost('id');
        $kegiatan = new ModelKegiatan();
        $delete = $kegiatan->delete($id);
        $response = [
            'status' => 'success',
            'msg' => 'Data Kegiatan berhasil di hapus',
        ];
        return $this->respond($response, 200);
    }
    // edit activity
    public function edit_kegiatan(Type $var = null)
    {
        $id_kegiatan = $this->request->getPost('id_kegiatan');
        $kegiatan = new ModelKegiatan();
        $data = $kegiatan->asObject()->find($id_kegiatan);
        $response = [
            'status' => 'success',
            'data' => $data,
        ];
        return $this->respond($response, 200);
    }
// month draw
    public function tambah_penarikan_bulanan($id_lembaga, $id_kegiatan)
    {
        // return $this->respond(['id' => $id_lembaga, 'kegiatan' => $id_kegiatan]);
        $kegiatan = new ModelKegiatan();
        $unit = new ModelUnit();
        $data['kegiatan'] = $kegiatan->asObject()->find($id_kegiatan);
        $data['lembaga'] = $unit->find($id_lembaga);
        return $this->respond($data, 200);exit;
        return view('rpd/unit/data_penarikan_bulanan', $data);
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
        }
    }
}
