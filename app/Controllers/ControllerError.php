<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ControllerError extends BaseController
{
    public function error_404()
    {
        return view('error_404');
    }
}
