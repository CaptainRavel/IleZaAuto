<?php

//DynamicDepdendent.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CarBaseController extends Controller
{
    public function index()
    {
        return view('car_base');
    }
}

?>