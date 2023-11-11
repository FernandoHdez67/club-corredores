<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SomosController extends Controller
{
    public function somos()
    {
        return view('modulos.quienessomos');
    }
}
