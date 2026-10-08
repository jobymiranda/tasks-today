<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table            = 'tasks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'title',
        'status',
        'task_date',
        'is_archived',
        'created_at',
    ];

    protected $useTimestamps = false;

    public function getTodaysTasks(): array
    {
        return $this
            ->where('task_date', date('Y-m-d'))
            ->where('is_archived', 0)
            ->orderBy('id', 'ASC')
            ->findAll();
    }

    public function getAllTasks(): array
    {
        return $this
            ->where('is_archived', 0)
            ->orderBy('task_date', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();
    }

    public function getActiveTask(int $id): ?array
    {
        return $this
            ->where('id', $id)
            ->where('is_archived', 0)
            ->first();
    }
}