<?php

namespace App\Controllers;

use App\Controllers\BaseController;
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
        $data['unit'] = $unit->where('status_verifikasi !=', 1)->findAll();
        // return $this->respond($data, 200);
        // exit;
        return view('rpd/unit/data_unit', $data);
    }
    // laporan
    // laporan
    public function laporan(Type $var = null)
    {
        $unit = new ModelUnit();
        $data['unit'] = $unit->where('status_verifikasi !=', 1)->findAll();
        // return $this->respond($data, 200);
        return view('rpd/unit/data_laporan', $data);
    }

}
