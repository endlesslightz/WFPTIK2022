<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class About extends BaseController
{
    public function index()
    {
        $data['nav'] = 'about';
        $data['nama'] = 'Boboboy';
        return view('about', $data);
    }
}
