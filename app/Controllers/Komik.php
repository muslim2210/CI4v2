<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
    //agar bisa dipake dikelas turunan nya
    protected $komikModel;
    //membuat constructor agar semua method bisa 
    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }

    //atau bisa dibuat dibasecontroler semua method bisa pake

    public function index()
    {
        $komik = $this->komikModel->findAll();
        $data = [
            'title' => 'Daftar Komik | Web CI4v2',
            'komik' => $komik
        ];

        //cara connect db tanpa model
        //$db = \Config\Database::connect();
        //$komik = $db->query("SELECT * FROM komik");
        //foreach ($komik->getResultArray() as $row) {
        //  d($row);
        //}

        //cara connect db dengan models
        //$komikModel = new App\Models\KomikModel();
        //$komikModel = new KomikModel();


        return view('komik/index', $data);
    }
}
