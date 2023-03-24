<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKegiatan;
use App\Models\ModelUnit;
use App\Models\ModelUser;
use CodeIgniter\API\ResponseTrait;

class Administrator extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $unit = new ModelUnit();
        $kegiatan = new \App\Models\ModelKegiatan;
        $user = new ModelUser();
        $data['total_unit'] = $unit->countAllResults();
        $data['user'] = $user->where('role', 'unit')->countAllResults();
        $data['kegiatan'] = $kegiatan->countAllResults();
        return view('rpd/administrator/dashboard', $data);
    }
    public function data_user(Type $var = null)
    {
        $user = new ModelUser();
        $data['data_user'] = $user->orderBy('id', 'desc')->where('role', 'unit')->findAll();
        return view('rpd/administrator/data_user', $data);
    }
    public function store_data_user($status)
    {
        $validation = \Config\Services::validation();
        if ($status == 'store') {
            $rules = [
                'email' => 'required|valid_email|is_unique[table_user.email]',
                'nama' => 'required',
            ];
            $messages = [
                'email' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Email yang digunkaan harus email valid',
                    'is_unique' => 'Email yang anda gunakan sudah terdaftar',
                ],
                'nama' => [
                    'required' => 'Nama tidak boleh kosong',
                ],
            ];
        } else {
            $rules = [
                'nama' => 'required',
            ];
            $messages = [
                'nama' => [
                    'required' => 'Nama tidak boleh kosong',
                ]];
        }

        $validation->setRules($rules, $messages);
        if (!$validation->withRequest($this->request)->run()) {
            $response = [
                'status' => 'validation_failed',
                'errors' => $validation->getErrors(),
            ];
        } else {

            $user = new ModelUser();
            $email = $this->request->getPost('email');
            $nama = $this->request->getPost('nama');
            $password = $this->request->getPost('password');
            $insert = [
                'email' => $email,
                'nama_user' => $nama,
                'role' => 'unit',
                'created_at' => date('Y-m-d H:i:s'),
            ];
            if ($status == 'store') {
                $insert['password'] = hash('sha256', $email);
            } else {
                if ($password) {
                    $insert['password'] = hash('sha256', $password);
                }
            }
            if ($status == 'store') {
                $make_data = $user->insert($insert);
                $msg = "Data user berhasil di tambahkan";
            } else {
                $id = $this->request->getPost('id');
                $make_data = $user->update($id, $insert);
                $msg = 'Data user berhasil di perbarui';
            }
            $response = [
                'status' => 'success',
                'msg' => $msg,
                'insert' => $insert,
            ];
        }
        return $this->respond($response, 200);
    }
    // edit data user
    public function edit_data_user(Type $var = null)
    {
        $user = new ModelUser();
        $id_user = $this->request->getPost('id_user');
        $data = $user->find($id_user);
        return $this->respond($data, 200);
    }
    // delet data user
    public function delete_data_user(Type $var = null)
    {
        $unit = new \App\Models\ModelUnit;
        $id_user = $this->request->getPost('id');
        $check = $unit->asObject()->where('id_pengelola', $id_user)->first();
        if ($check) {
            $response = [
                'status' => 'failed',
                'msg' => 'Akun ini sedang aktif di unit ' . $check->nama_lembaga . ', silahkan ganti pengelola unit tersebut',
            ];
        } else {
            $user = new ModelUser();
            $user->delete($id_user);
            $response = [
                'status' => 'success',
                'msg' => 'Data user berhasil di hapus',
            ];
        }
        return $this->respond($response, 200);
    }
    public function data_unit(Type $var = null)
    {
        $db = \Config\Database::connect();
        $user = new ModelUser();
        $lembaga = $db->table('table_lembaga as a');
        $data['data_user'] = $user->orderBy('id', 'desc')->where('role', 'unit')->findAll();
        $data['unit'] = $lembaga->join('table_user as b', 'a.id_pengelola=b.id')->get()->getResult();
        return view('rpd/administrator/data_unit', $data);
    }
    public function store_data_lembaga(Type $var = null)
    {
        $validation = \Config\Services::validation();
        $validation->setRules(
            [
                'nama_lembaga' => 'required|is_unique[table_lembaga.nama_lembaga]',
            ],
            [
                'nama_lembaga' => [
                    'required' => 'Email tidak boleh kosong',
                    'is_unique' => 'Nama Lembaga Sudah Ada',
                ],
            ]
        );
        if (!$validation->withRequest($this->request)->run()) {
            $response = [
                'status' => 'validation_failed',
                'errors' => $validation->getErrors(),
            ];
        } else {

            $unit = new ModelUnit();
            $nama_lembaga = $this->request->getPost('nama_lembaga');
            $id_pengelola = $this->request->getPost('id_pengelola');
            $insert = [
                'nama_lembaga' => $nama_lembaga,
                'id_pengelola' => $id_pengelola,
                'status_verifikasi' => 1,
            ];

            $make_data = $unit->insert($insert, false);
            $response = [
                'status' => 'success',
                'msg' => 'Data lembaga berhasil di tambahkan',
                'insert' => $insert,
            ];
        }
        return $this->respond($response, 200);
    }
    public function delete_data_lembaga(Type $var = null)
    {
        $id_lembaga = $this->request->getPost('id_lembaga');
        $unit = new ModelUnit();
        $unit->delete($id_lembaga);
        $response = [
            'status' => 'success',
        ];
        return $this->respond($response);
    }
    // use for rpd
    public function rpd(Type $var = null)
    {
        $unit = new ModelUnit();
        $kegiatan = new \App\Models\ModelKegiatan;
        $data_unit = $unit->where('status_verifikasi !=', 1)->findAll();
        $result_unit = [];
        if ($data_unit) {
            foreach ($data_unit as $key => $value) {
                $pagu = $kegiatan->asObject()->where('id_lembaga', $value->id_lembaga)->selectSum('pagu_kegiatan')->findAll()[0]->pagu_kegiatan;
                if ($pagu) {
                    $pagu = $pagu;
                } else {
                    $pagu = 0;
                }
                $result_unit[] = (object) [
                    'id_lembaga' => $value->id_lembaga,
                    'nama_lembaga' => $value->nama_lembaga,
                    'id_pengelola' => $value->id_pengelola,
                    'status_verifikasi' => $value->status_verifikasi,
                    'pagu' => $pagu,
                ];
            }
        }
        $data['unit'] = $result_unit;
        // return $this->respond($data, 200);
        // exit;
        return view('rpd/administrator/data_unit', $data);
    }
    // laporan
    public function laporan(Type $var = null)
    {
        $unit = new ModelUnit();
        $data['unit'] = $unit->where('status_verifikasi !=', 1)->findAll();
        // return $this->respond($data, 200);
        return view('rpd/unit/data_laporan', $data);
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
            return view('rpd/administrator/data_kegiatan', $data);
        }
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
        return view('rpd/administrator/data_penarikan_bulanan', $data);
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
        return view('rpd/administrator/data_penarikan_mingguan', $data);
    }
    // penarikan perhari
    public function tambah_penarikan_perhari($id_lembaga, $id_kegiatan, $id_rincian, $id_rincian_kegiatan_perbulan, $bulan)
    {
        $unit = new ModelUnit();
        $kegiatan = new ModelKegiatan();
        $rincian_kegiatan = new \App\Models\ModelRincianKegiatan;
        $model_rincian_perhari = new \App\Models\ModelRincianKegiatanPerhari;
        $data['kegiatan'] = $kegiatan->asObject()->find($id_kegiatan);
        $data['lembaga'] = $unit->asObject()->find($id_lembaga);
        $data['rincian_kegiatan'] = $rincian_kegiatan->asObject()->find($id_rincian);
        $data['month'] = $this->month('convert')[$bulan];
        $data['month_number'] = $bulan;
        $get_date = $this->get_date($bulan);
        $data['day_in_month'] = $get_date['date'];
        $data['day'] = $get_date['day'];
        $data['penarikan_perhari'] = json_decode($model_rincian_perhari->asObject()->where('bulan', $bulan)->where('id_rincian_kegiatan', $id_rincian)->first()->rincian_perhari);
        // return $this->respond($data['penarikan_perhari'], 200);
        return view('rpd/administrator/data_penarikan_perhari', $data);
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
    // get date in one month
    public function get_date($month)
    {
        $year = date('Y');
        $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $new_date = [];
        for ($i = 1; $i <= $day; $i++) {
            $date = strtotime('2023-' . $month . '-' . $i);
            $day_name = $this->convert_day_name(date('l', $date));
            if ($day_name !== 'Minggu' && $day_name !== 'Sabtu') {
                $new_date[] = [
                    'date' => $i,
                    'name' => $day_name,
                ];
            }

        }
        $default_table = 25;
        $day_working = count($new_date);
        $different_day = $default_table - $day_working;
        $first_day = 0;
        $end_day = 0;
        if ($new_date[0]['name'] == 'Selasa') {
            $end_day = $different_day - 1;
            $first_day = $different_day - $end_day;
        } elseif ($new_date[0]['name'] == 'Rabu') {
            $end_day = $different_day - 2;
            $first_day = $different_day - $end_day;
        } elseif ($new_date[0]['name'] == 'Kamis') {
            $end_day = $different_day - 3;
            $first_day = $different_day - $end_day;
        } elseif ($new_date[0]['name'] == 'Jumat') {
            $end_day = $different_day - 4;
            $first_day = $different_day - $end_day;
        }
        $array_first_day = [];
        for ($i = 1; $i <= $first_day; $i++) {
            $array_first_day[] = [
                'date' => '-',
                'name' => '-',
            ];
        }
        $array_end_day = [];
        for ($i = 1; $i <= $end_day; $i++) {
            $array_end_day[] = [
                'date' => '-',
                'name' => '-',
            ];
        }
        $combine1 = array_merge($array_first_day, (array) $new_date);
        $combine1 = array_merge($combine1, $array_end_day);
        $return_date = [
            'count_date' => count((array) $new_date),
            'add_day' => [
                'a' => $first_day,
                'b' => $end_day,
            ],
            'array_first_day' => $array_first_day,
            'array_end_day' => $array_end_day,
            'day' => $day,
            'month' => $month,
            'date' => (array_chunk((array) $combine1, 5)),
        ];
        return $return_date;
    }
    public function convert_day_name($day_name)
    {
        switch ($day_name) {

            case 'Sunday':
                $day = 'Minggu';
                break;
            case 'Monday':
                $day = 'Senin';
                break;
            case 'Tuesday':
                $day = 'Selasa';
                break;
            case 'Wednesday':
                $day = 'Rabu';
                break;
            case 'Thursday':
                $day = 'Kamis';
                break;
            case 'Friday':
                $day = 'Jumat';
                break;
            default:
                $day = 'Sabtu';
                break;
        }
        return $day;
    }

}
