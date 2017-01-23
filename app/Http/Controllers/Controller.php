<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

<<<<<<< HEAD
abstract class Controller extends BaseController
=======
class Controller extends BaseController
>>>>>>> v5.3.16
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
