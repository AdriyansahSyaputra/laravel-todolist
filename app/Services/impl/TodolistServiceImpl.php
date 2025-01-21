<?php

namespace App\Services\impl;

use App\Models\Todo;
use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodolistService
{
    public function saveTodo(string $id, string $todo): void
    {
        $todo = new Todo([
            'id' => $id,
            'todo' => $todo
        ]);
        $todo->save();
    }

    public function getTodoList(): array
    {
        return Todo::all()->toArray();
    }

    public function removeTodo(string $todoId): void
    {
        $todo = Todo::find($todoId);
        if($todo != null) {
            $todo->delete();
        }
    }
}
