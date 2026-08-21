<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $promociones = [
            [
                'titulo' => '',
                'descripcion' => '',
                'imagen' => '',
                'link' => ''
            ],
            [
                'titulo' => '',
                'descripcion' => '',
                'imagen' => '',
                'link' => ''
            ],
            [
                'titulo' => '',
                'descripcion' => '',
                'imagen' => '',
                'link' => ''
            ],
        ];

        return view('landing', compact('promociones'));

    }
}
