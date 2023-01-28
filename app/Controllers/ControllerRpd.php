<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ControllerRpd extends BaseController
{
    public function dashboard(Type $var = null)
    {
        return view('rpd/dashboard');
    }
    public function index()
    {
        //
    }
}
