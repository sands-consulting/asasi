<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controler as BaseController;

class Controller extends BaseController
{
    public function __construct()
    {
        $this->middleware('policy.admin');
    }
}
