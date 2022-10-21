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
            'komik' => $this->komikModel->getKomik()
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

    public function detail($slug)
    {

        $data = [
            'title' => 'Detail Komik',
            'komik' => $this->komikModel->getKomik($slug)
        ];

        //jika data tabel tidak ada
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik' . $slug . 'tidak ditemukan');
        }
        return view('komik/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Komik'
        ];

        return view('komik/create', $data);
    }

    public function save()
    {
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data berhasilkan ditambahkan.');

        return redirect()->to('/komik');
    }
}
