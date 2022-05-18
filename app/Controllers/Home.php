<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['nav'] = 'home';
        $data['nama'] = 'Boboboy';
        $data['list'] = ['Andika', 'Budi', 'Charlie', 'Darwin'];
        return view('home', $data);
    }
}
