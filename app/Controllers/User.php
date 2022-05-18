<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    protected $usermodel;
    public function __construct()
    {
        $this->usermodel = new UserModel();
    }

    public function index()
    {
        $data = [
            'nav' => 'user',
            'nama' => 'Boboboy',
            'list' => $this->usermodel->find()
        ];

        // var_dump($data);
        return view('user/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'nav' => 'user',
            'nama' => 'Boboboy',
            // 'item' => $this->usermodel->where(['id' => $id])->first()
            'item' => $this->usermodel->getDetail($id)
        ];

        return view('user/detail', $data);
    }

    public function create()
    {
        $data = [
            'nav' => 'user',
            'nama' => 'Boboboy',
        ];

        // var_dump($data);
        return view('user/tambah', $data);
    }

    public function insert()
    {

        $nama = $this->request->getVar('namadepan') . " " . $this->request->getVar('namabelakang');
        if ($this->request->getFile('avatar')->getName() != '') {
            $avatar = $this->request->getFile('avatar');
            $namaavatar = $avatar->getRandomName();
            $avatar->move(ROOTPATH . 'public/images/avatar', $namaavatar);
        } else {
            $namaavatar = 'default.jpg';
        }

        $input = [
            'nama' => $nama,
            'alamat' => $this->request->getVar('alamat'),
            'tempat_lahir' => $this->request->getVar('tempatlahir'),
            'tanggal_lahir' => $this->request->getVar('tanggallahir'),
            'jenis_kelamin' => $this->request->getVar('jeniskelamin'),
            'telepon' => $this->request->getVar('telepon'),
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'password' => md5($this->request->getVar('password')),
            'avatar' => $namaavatar
        ];
        $this->usermodel->save($input);

        session()->setFlashdata('label', 'Data anggota berhasil ditambahkan');
        return redirect()->to('/user');
    }

    public function insertAjax()
    {

        $validasi = \Config\Services::validation();
        $valid = $this->validate([
            'namadepan' => [
                'label' => 'Nama Depan',
                'rules' => 'required',
                'errors' => ['required' => '{field} tidak boleh kosong']
            ],

            'namabelakang' => [
                'label' => 'Nama Belakang',
                'rules' => 'required',
                'errors' => ['required' => '{field} tidak boleh kosong']
            ],

            'email' => [
                'label' => 'Email',
                'rules' => 'required|is_unique[users.email]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ]
        ]);
        if (!$valid) {
            $pesan = [
                'error' => [
                    'namadepan' => $validasi->getError('namadepan'),
                    'namabelakang' => $validasi->getError('namabelakang'),
                    'email' => $validasi->getError('email'),
                ]
            ];
            return $this->response->setJSON($pesan);
        } else {
            $nama = $this->request->getVar('namadepan') . " " . $this->request->getVar('namabelakang');
            if ($this->request->getFile('avatar')->getName() != '') {
                $avatar = $this->request->getFile('avatar');
                $namaavatar = $avatar->getRandomName();
                $avatar->move(ROOTPATH . 'public/images/avatar', $namaavatar);
            } else {
                $namaavatar = 'default.jpg';
            }

            $input = [
                'nama' => $nama,
                'alamat' => $this->request->getVar('alamat'),
                'tempat_lahir' => $this->request->getVar('tempatlahir'),
                'tanggal_lahir' => $this->request->getVar('tanggallahir'),
                'jenis_kelamin' => $this->request->getVar('jeniskelamin'),
                'telepon' => $this->request->getVar('telepon'),
                'email' => $this->request->getVar('email'),
                'username' => $this->request->getVar('username'),
                'password' => md5($this->request->getVar('password')),
                'avatar' => $namaavatar
            ];
            $this->usermodel->save($input);
            $pesan = [
                'sukses' => 'Data anggota berhasil diinput'
            ];
            return $this->response->setJSON($pesan);
        }
    }

    public function getData()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'list' => $this->usermodel->find()
            ];
            $hasil = [
                'data' => view('user/list', $data)
            ];
            // echo json_encode($hasil);
            return $this->response->setJSON($hasil);
        } else {
            exit('data tidak dapat diload');
        }
    }


    public function getForm()
    {
        if ($this->request->isAJAX()) {
            $hasil = [
                'data' => view('user/form')
            ];
            // echo json_encode($hasil);
            return $this->response->setJSON($hasil);
        } else {
            exit('data tidak dapat diload');
        }
    }
}
