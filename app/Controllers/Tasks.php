<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Tasks extends BaseController
{
    public function index(): string
    {
        $taskModel = new TaskModel();

        $data = [
            'title' => 'Task List',
            'tasks' => $taskModel->getAllTasks(),
        ];

        return view('templates/header', $data)
            . view('tasks/index', $data)
            . view('templates/footer');
    }
}