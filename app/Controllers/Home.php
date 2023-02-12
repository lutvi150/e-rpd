<?php

namespace App\Controllers;

use App\Models\ModelUser;
use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        return view('welcome_message');
    }
    public function login()
    {
        $session = \Config\Services::session();
        if ($session->get('role') == 'administrator') {
            return redirect()->route('administrator');
        } elseif ($session->get('role') == 'unit') {
            return redirect()->route('unit');
        } else {
            return view('login');
        }
    }
    public function authorize(Type $var = null)
    {
        $validation = \Config\Services::validation();
        $validation->setRules(
            [
                'email' => 'required|valid_email',
                'password' => 'required',
            ],
            [
                'email' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Email yang digunkaan harus email valid',
                ],
                'password' => [
                    'required' => 'Password tidak boleh kosong',
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
            $password = hash('sha256', $this->request->getPost('password'));
            $data = $user->where('email', $email)->where('password', $password)->first();
            if ($data) {
                $session = \Config\Services::session();
                $newSession = [
                    'login' => true,
                    'email' => $email,
                    'id' => $data['id'],
                    'role' => $data['role'],
                    'nama_user' => $data['nama_user'],
                ];
                $session->set($newSession);
                $response = [
                    'status' => 'success',
                ];
            } else {
                $response = [
                    'status' => 'user not found',
                ];
            }
        }
        return $this->respond($response, 200);
    }
    public function logout(Type $var = null)
    {
        $session = \Config\Services::session();
        $session->destroy();
        return redirect()->route('/');
    }
}
