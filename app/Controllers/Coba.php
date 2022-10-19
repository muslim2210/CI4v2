<?php

namespace App\Controllers;

class Coba extends BaseController
{
    public function index()
    {
        //return view('welcome_message');
        echo 'index coba';
    }

    public function about()
    {
        echo "menggunakan base controller nama $this->nama";
    }
}
