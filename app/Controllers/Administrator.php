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
        return view('rpd/administrator/dashboard');
    }
    public function data_user(Type $var = null)
    {
        $user = new ModelUser();
        $data['data_user'] = $user->orderBy('id', 'desc')->where('role', 'unit')->findAll();
        return view('rpd/administrator/data_user', $data);
    }
    public function store_data_user(Type $var = null)
    {
        $validation = \Config\Services::validation();
        $validation->setRules(
            [
                'email' => 'required|valid_email|is_unique[table_user.email]',
                'nama' => 'required',
            ],
            [
                'email' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Email yang digunkaan harus email valid',
                    'is_unique' => 'Email yang anda gunakan sudah terdaftar',
                ],
                'nama' => [
                    'required' => 'Nama tidak boleh kosong',
                ],
            ]
        );
        if (!$validation->withRequest($this->request)->run()) {
            $response = [
                'status' => 'validation_failed',
                'errors' => $validation->getErrors(),
            ];
        } else {

            $user = new ModelUser();
            $email = $this->request->getPost('email');
            $nama = $this->request->getPost('nama');
            $insert = [
                'email' => $email,
                'nama_user' => $nama,
                'password' => hash('sha256', $email),
                'role' => 'unit',
                'created_at' => now(),

            ];

            $make_data = $user->insert($insert);
            $response = [
                'status' => 'success',
                'msg' => 'Data user berhasil di tambahkan',
                'insert' => $insert,
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

}
