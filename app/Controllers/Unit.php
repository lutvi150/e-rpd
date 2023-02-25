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
        $rincian_kegiatan = new \App\Models\ModelRincianKegiatan;
        $rincian_kegiatan_perbulan = new \App\Models\ModelRincianKegiatanPerbulan;
        $data['kegiatan'] = $kegiatan->asObject()->find($id_kegiatan);
        $data_rincian_kegiatan = $rincian_kegiatan->asObject()->where('id_kegiatan', $id_kegiatan)->findAll();
        $result_rincian_kegiatan = [];
        if ($data_rincian_kegiatan) {
            foreach ($data_rincian_kegiatan as $key => $value) {
                $result_rincian_kegiatan[] = (object) [
                    'id_rincian' => $value->id_rincian,
                    'id_kegiatan' => $value->id_kegiatan,
                    'kode_rincian' => $value->kode_rincian,
                    'uraian_rincian_kegiatan' => $value->uraian_rincian_kegiatan,
                    'pagu_rincian_kegiatan' => $value->pagu_rincian_kegiatan,
                    'rincian_pagu' => $rincian_kegiatan_perbulan->asObject()->select('total_pagu_perbulan as pagu,bulan')->where('id_rincian_kegiatan', $value->id_rincian)->orderBy('bulan')->findAll(),
                ];
            }
        }
        $data['rincian_kegiatan'] = $result_rincian_kegiatan;
        $data['lembaga'] = $unit->find($id_lembaga);
        $data['month'] = $this->month('get');

        // return $this->respond($data, 200);exit;
        return view('rpd/unit/data_penarikan_bulanan', $data);
    }
    // store month draw
    public function store_rincian_kegiatan($status)
    {
        $validation = \Config\Services::validation();
        $validation->setRules(
            [
                'kode_rincian' => 'required',
                'uraian_rincian_kegiatan' => 'required',
                'pagu_rincian_kegiatan' => 'required|numeric',
            ],
            [
                'kode_rincian' => [
                    'required' => 'Kode Rincian Kegiatan tidak boleh kosong',
                ],
                'uraian_rincian_kegiatan' => [
                    'required' => 'Uraian Rincian Kegiatan tidak boleh kosong',
                ],
                'pagu_rincian_kegiatan' => [
                    'required' => 'Pagu Rincian Kegiatan tidak boleh kosong',
                    'numeric' => 'Pagu Rincian harus berupa angka',
                ],
            ]
        );
        if (!$validation->withRequest($this->request)->run()) {
            $response = [
                'status' => 'validation_failed',
                'errors' => $validation->getErrors(),
            ];
        } else {

            $rincian_kegiatan = new \App\Models\ModelRincianKegiatan;
            $id_kegiatan = $this->request->getPost('id_kegiatan');
            $kode_rincian = $this->request->getPost('kode_rincian');
            $uraian_rincian_kegiatan = $this->request->getPost('uraian_rincian_kegiatan');
            $pagu_rincian_kegiatan = $this->request->getPost('pagu_rincian_kegiatan');
            $insert = [
                'id_kegiatan' => $id_kegiatan,
                'kode_rincian' => $kode_rincian,
                'uraian_rincian_kegiatan' => $uraian_rincian_kegiatan,
                'pagu_rincian_kegiatan' => $pagu_rincian_kegiatan,

            ];
            if ($status == 'store') {
                $make_data = $rincian_kegiatan->insert($insert, false);
                if ($make_data) {
                    $true_data = 1;
                } else {
                    $true_data = 2;
                }
                $msg = 'Data rincian kegiatan berhasil di tambahkan' . $true_data;
            } else {
                $id_kegiatan = $this->request->getPost('id_rincian');
                $make_data = $rincian_kegiatan->update($id_kegiatan, $insert);
                $msg = 'Data rincian kegiatan berhasil di update';
            }
            $response = [
                'status' => 'success',
                'msg' => $msg,
            ];
        }
        return $this->respond($response, 200);
    }
    // use for edit
    public function edit_rincian_kegiatan(Type $var = null)
    {
        $id_rincian = $this->request->getPost('id_rincian');
        $rincian_kegiatan = new \App\Models\ModelRincianKegiatan;
        $data = $rincian_kegiatan->asObject()->find($id_rincian);
        $response = [
            'status' => 'success',
            'data' => $data,
        ];
        return $this->respond($response, 200);
    }
    // delete detail activirty
    public function delete_rincian_kegiatan()
    {
        $id = $this->request->getPost('id');
        $rincian_kegiatan = new \App\Models\ModelRincianKegiatan;
        $delete = $rincian_kegiatan->delete($id);
        $response = [
            'status' => 'success',
            'msg' => 'Data Rincian Kegiatan berhasil di hapus',
        ];
        return $this->respond($response, 200);
    }
    // update pague rincian kegiatan perbulan
    public function update_pagu_rincian_kegiatan_perbulan(Type $var = null)
    {
        $id_rincian = $this->request->getPost('id_rincian_kegiatan');
        $bulan = $this->request->getPost('bulan');
        $total_paguper_bulan = $this->request->getPost('total_pagu_perbulan');
        $rincian_kegiatan_perbulan = new \App\Models\ModelRincianKegiatanPerbulan;
        $check = $rincian_kegiatan_perbulan->asObject()->where('id_rincian_kegiatan', $id_rincian)->where('bulan', $bulan)->first();
        $insert = [
            'id_rincian_kegiatan' => $id_rincian,
            'bulan' => $bulan,
            'total_pagu_perbulan' => $total_paguper_bulan,
        ];
        if ($check) {
            $rincian_kegiatan_perbulan->update($check->id_rincian_kegiatan_perbulan, $insert);
            $msg = 'Update';
        } else {
            $rincian_kegiatan_perbulan->insert($insert);
            $msg = 'Insert';
        }
        $response = [
            'status' => 'success',
            'msg' => $msg,
        ];
        return $this->respond($response, 200);
    }
    // add penarikan mingguan
    public function tambah_penarikan_mingguan($id_lembaga, $id_kegiatan, $id_rincian)
    {
        $unit = new ModelUnit();
        $kegiatan = new ModelKegiatan();
        $rincian_kegiatan = new \App\Models\ModelRincianKegiatan;
        $rincian_perbulan = new \App\Models\ModelRincianKegiatanPerbulan;
        $data['kegiatan'] = $kegiatan->asObject()->find($id_kegiatan);
        $data['lembaga'] = $unit->asObject()->find($id_lembaga);
        $data['rincian_kegiatan'] = $rincian_kegiatan->asObject()->find($id_rincian);
        $data_rincian_perbulan = $rincian_perbulan->asObject()->where('id_rincian_kegiatan', $id_rincian)->where('total_pagu_perbulan !=', 0)->orderBy('bulan', 'asc')->findAll();
        $resul_rincian_perbulan = [];
        if ($data_rincian_perbulan) {
            foreach ($data_rincian_perbulan as $key => $value) {
                $resul_rincian_perbulan[] = (object) [
                    'id_rincian_kegiatan_perbulan' => $value->id_rincian_kegiatan_perbulan,
                    'id_rincian_kegiatan' => $value->id_rincian_kegiatan,
                    'bulan' => (int) $value->bulan,
                    'total_pagu_perbulan' => (int) $value->total_pagu_perbulan,
                    'week_data' => $this->week_draw($value->id_rincian_kegiatan_perbulan),
                ];
            }
        }
        $data['rincian_perbulan'] = $resul_rincian_perbulan;
        $data['month'] = $this->month('convert');
        // return $this->respond($data);exit;
        return view('rpd/unit/data_penarikan_mingguan', $data);
    }
    private function week_draw($id_rincian_kegiatan_perbulan)
    {
        $rincian_perminggu = new \App\Models\ModelRincianKegiatanPerminggu;
        for ($i = 1; $i <= 4; $i++) {

            $check = $rincian_perminggu->asObject()->where('id_rincian_kegiatan_perbulan', $id_rincian_kegiatan_perbulan)->where('minggu', $i)->first();
            $pagu = $check == null ? 0 : $check->total_pagu_perminggu;
            $result_perminggu[] = (object) [
                'minggu' => $i,
                'pagu' => $pagu,
            ];
        }
        return $result_perminggu;
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
