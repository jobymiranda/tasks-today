<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\Exceptions\PageNotFoundException;

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

    public function newForm(): string
    {
        $data = [
            'title'       => 'New Task',
            'formHeading' => 'Create New Task',
            'formAction'  => base_url('tasks'),
            'submitLabel' => 'Create Task',
            'task'        => [],
        ];

        return view('templates/header', $data)
            . view('tasks/form', $data)
            . view('templates/footer');
    }

    public function create()
    {
        $rules = $this->taskValidationRules();

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $taskModel = new TaskModel();

        $taskModel->insert([
            'title' => trim(
                (string) $this->request->getPost('title')
            ),

            'status' => (string) $this->request->getPost('status'),

            'task_date' => (string) $this->request->getPost(
                'task_date'
            ),

            'is_archived' => 0,
            'created_at'   => date('Y-m-d H:i:s'),
        ]);

        return redirect()
            ->to('/tasks')
            ->with(
                'success',
                'The task was created successfully.'
            );
    }

    public function edit(int $id): string
    {
        $taskModel = new TaskModel();
        $task      = $taskModel->getActiveTask($id);

        if ($task === null) {
            throw PageNotFoundException::forPageNotFound(
                'The requested task could not be found.'
            );
        }

        $data = [
            'title'       => 'Edit Task',
            'formHeading' => 'Edit Task',
            'formAction'  => base_url('tasks/' . $id),
            'submitLabel' => 'Save Changes',
            'task'        => $task,
        ];

        return view('templates/header', $data)
            . view('tasks/form', $data)
            . view('templates/footer');
    }

    public function update(int $id)
    {
        $taskModel = new TaskModel();
        $task      = $taskModel->getActiveTask($id);

        if ($task === null) {
            throw PageNotFoundException::forPageNotFound(
                'The requested task could not be found.'
            );
        }

        $rules = $this->taskValidationRules();

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $taskModel->update($id, [
            'title' => trim(
                (string) $this->request->getPost('title')
            ),

            'status' => (string) $this->request->getPost('status'),

            'task_date' => (string) $this->request->getPost(
                'task_date'
            ),
        ]);

        return redirect()
            ->to('/tasks')
            ->with(
                'success',
                'The task was updated successfully.'
            );
    }

    public function archive(int $id)
    {
        $taskModel = new TaskModel();
        $task      = $taskModel->getActiveTask($id);

        if ($task === null) {
            throw PageNotFoundException::forPageNotFound(
                'The requested task could not be found.'
            );
        }

        /*
         * Soft deletion:
         * the row remains in MySQL and is marked as archived.
         */
        $taskModel->update($id, [
            'is_archived' => 1,
        ]);

        return redirect()
            ->to('/tasks')
            ->with(
                'success',
                'The task was archived successfully.'
            );
    }

    private function taskValidationRules(): array
    {
        return [
            'title' => [
                'label' => 'Task title',
                'rules' => 'required|min_length[3]|max_length[150]',
                'errors' => [
                    'required'   => 'Please enter a task title.',
                    'min_length' => 'The task title must contain at least 3 characters.',
                    'max_length' => 'The task title cannot exceed 150 characters.',
                ],
            ],

            'status' => [
                'label' => 'Status',
                'rules' => 'required|in_list[pending,in progress,completed]',
                'errors' => [
                    'required' => 'Please select a task status.',
                    'in_list'  => 'Please select a valid task status.',
                ],
            ],

            'task_date' => [
                'label' => 'Task date',
                'rules' => 'required|valid_date[Y-m-d]',
                'errors' => [
                    'required'   => 'Please select a task date.',
                    'valid_date' => 'Please select a valid task date.',
                ],
            ],
        ];
    }
}