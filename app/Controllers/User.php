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
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 10 karakter'
                ]
            ],
            'namabelakang' => [
                'label' => 'Nama Belakang',
                'rules' => 'required',
                'errors' => ['required' => '{field} tidak boleh kosong']
            ]
        ]);

        if (!$valid) {
            $pesan = [
                'error' => [
                    'namadepan' => $validasi->getError('namadepan'),
                    'namabelakang' => $validasi->getError('namabelakang'),
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


    public function edit($id)
    {
        if ($this->request->isAJAX()) {
            $item = $this->usermodel->find($id);
            $nama = explode(" ", $item['nama']);
            $data = [
                'id' => $item['id'],
                'nama_depan' => $nama[0],
                'nama_belakang' => $nama[1],
                'alamat' => $item['alamat'],
                'tempat_lahir' => $item['tempat_lahir'],
                'tanggal_lahir' => $item['tanggal_lahir'],
                'jenis_kelamin' => $item['jenis_kelamin'],
                'telepon' => $item['telepon'],
                'email' => $item['email'],
                'username' => $item['username'],
                'password' => $item['password'],
                'avatar' => $item['avatar']
            ];
            $hasil = [
                'data' => view('user/edit', $data)
            ];
            return $this->response->setJSON($hasil);
        } else {
            exit('data tidak dapat diload');
        }
    }

    public function update($id)
    {
        $validasi = \Config\Services::validation();
        $valid = $this->validate([
            'namadepan' => [
                'label' => 'Nama Depan',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} minimal 10 karakter'
                ]
            ],
            'namabelakang' => [
                'label' => 'Nama Belakang',
                'rules' => 'required',
                'errors' => ['required' => '{field} tidak boleh kosong']
            ]
        ]);
        if (!$valid) {
            $pesan = [
                'error' => [
                    'namadepan' => $validasi->getError('namadepan'),
                    'namabelakang' => $validasi->getError('namabelakang'),
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
                $namaavatar = $this->request->getVar('avalama');
            }
            if ($this->request->getVar('password') != $this->request->getVar('passlama')) {
                $pass = md5($this->request->getVar('password'));
            } else {
                $pass = $this->request->getVar('passlama');
            }

            $input = [
                'id' => $id,
                'nama' => $nama,
                'alamat' => $this->request->getVar('alamat'),
                'tempat_lahir' => $this->request->getVar('tempatlahir'),
                'tanggal_lahir' => $this->request->getVar('tanggallahir'),
                'jenis_kelamin' => $this->request->getVar('jeniskelamin'),
                'telepon' => $this->request->getVar('telepon'),
                'email' => $this->request->getVar('email'),
                'username' => $this->request->getVar('username'),
                'password' => $pass,
                'avatar' => $namaavatar
            ];
            $this->usermodel->save($input);
            $pesan = [
                'sukses' => 'Data anggota berhasil diupdate'
            ];
            return $this->response->setJSON($pesan);
        }
    }

    public function hapus($id)
    {
        if ($this->request->isAJAX()) {
            $this->usermodel->delete($id);
            $pesan = [
                'sukses' => "Data anggota dengan ID=$id berhasil dihapus"
            ];
            return $this->response->setJSON($pesan);
        } else {
            exit('data tidak dapat dihapus');
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
            return $this->response->setJSON($hasil);
        } else {
            exit('data tidak dapat diload');
        }
    }
}
