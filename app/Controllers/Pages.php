<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function about(): string
    {
        $data = [
            'title' => 'About',
        ];

        return view('templates/header', $data)
            . view('pages/about', $data)
            . view('templates/footer');
    }
}