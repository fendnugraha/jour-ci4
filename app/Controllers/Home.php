<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('home/index', [
            'title' => 'Home',
            'brandName' => 'Doa Ibu Inc.',
            'role' => 'Administrator',
            'warehouse' => 'BANDUNG 3',
        ]);
    }
}
