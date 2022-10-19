<?php

namespace App\Controllers;

class Komik extends BaseController
{

    public function index()
    {
        $data = [
            'title' => 'Daftar Komik | Web CI4v2'
        ];

        return view('komik/index', $data);
    }
}
