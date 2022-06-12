<?php

namespace App\Http\Controllers\Api;

use App\Rack;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RackController extends Controller
{
    public function racks(){
        return $racks = Rack::all();
    }
}
