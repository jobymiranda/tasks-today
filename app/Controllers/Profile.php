<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();

        $data = [
            'title' => 'Profile',
            'user'  => $userModel->first(),
        ];

        return view('templates/header', $data)
            . view('profile/index', $data)
            . view('templates/footer');
    }
}