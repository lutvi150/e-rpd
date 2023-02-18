<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UnitModel;

class Unit extends BaseController
{

    public function index()
    {
        return view('rpd/unit/dashboard');
    }
    public function rpd(Type $var = null)
    {
        $unit = new UnitModel();
        $data['unit'] = $unit->where('id_pengelola');
        return view('rpd/unit/data_unit', $data);
    }
}
