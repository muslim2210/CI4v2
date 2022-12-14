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
        //session();
        //session sudah dijalankan dibasecontroller
        $data = [
            'title' => 'Form Tambah Data Komik',
            'validation' => \Config\Services::validation()
        ];

        return view('komik/create', $data);
    }

    public function save()
    {
        //validasi input
        if (!$this->validate([
            //validasi data lebih spesifik
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} komik tidak boleh kosong.',
                    'is_unique' => '{field} komik sudah terdaftar.'
                ]
            ],

            'penulis' => [
                'rules' => 'required[komik.penulis]',
                'errors' => [
                    'required' => 'Silahkan isi Data {field} !'

                ]
            ],
            'penerbit' => [
                'rules' => 'required[komik.penerbit]',
                'errors' => [
                    'required' => 'Silahkan isi Data {field} !'

                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
        }
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/komik');
    }

    public function delete($id)
    {
        $this->komikModel->delete($id);
        session()->setFlashdata('delete', 'Data sudah dihapus.');

        return redirect()->to('/komik');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Data Komik',
            'validation' => \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($slug)
        ];

        return view('komik/edit', $data);
    }

    public function update($id)
    {
        //validasi update
        //cek judul
        $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
        if ($komikLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[komik.judul]';
        }

        if (!$this->validate([
            //validasi data lebih spesifik
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} komik tidak boleh kosong.',
                    'is_unique' => '{field} komik sudah terdaftar.'
                ]
            ],

            'penulis' => [
                'rules' => 'required[komik.penulis]',
                'errors' => [
                    'required' => 'Silahkan isi Data {field} !'

                ]
            ],
            'penerbit' => [
                'rules' => 'required[komik.penerbit]',
                'errors' => [
                    'required' => 'Silahkan isi Data {field} !'

                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah. !');

        return redirect()->to('/komik');
    }
}
