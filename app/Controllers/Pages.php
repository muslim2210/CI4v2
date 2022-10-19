<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | Web CI4v2'

        ];
        echo view('Layout/header', $data);
        echo view('Pages/home');
        echo view('Layout/footer');
    }

    public function about()
    {
        $data = [
            'title' => 'About Me | Web CI4v2'

        ];
        echo view('Layout/header', $data);
        echo view('Pages/about');
        echo view('Layout/footer');
    }
}
