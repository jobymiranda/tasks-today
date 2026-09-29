<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Home extends BaseController
{
    public function index(): string
    {
        $taskModel = new TaskModel();

        $data = [
            'title' => 'Welcome',
            'today' => date('Y-m-d'),
            'tasks' => $taskModel->getTodaysTasks(),
        ];

        return view('templates/header', $data)
            . view('home/index', $data)
            . view('templates/footer');
    }
}