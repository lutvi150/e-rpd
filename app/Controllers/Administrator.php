<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Administrator extends BaseController
{
    public function index()
    {
        return view('rpd/administrator/dashboard');
    }
    public function data_user(Type $var = null)
    {
        return view('rpd/administrator/data_user');
    }
}
