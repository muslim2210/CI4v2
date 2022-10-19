<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | Web CI4v2'
        ];

        return view('Pages/home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Me | Web CI4v2'
        ];

        return view('Pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact Us | Web CI4v2',
            'alamat' => [
                [
                    'tipe' => 'rumah',
                    'alamat' => 'jl abcd no.172 bojong menteng',
                    'kota' => 'bekasi'
                ],
                [
                    'tipe' => 'kantor',
                    'alamat' => 'jl m hasibuan no.68 margahayu',
                    'kota' => 'bekasi'
                ]

            ]
        ];

        return view('Pages/contact', $data);
    }
}
