<?php

namespace App\Services\impl;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodolistService
{
    public function saveTodo(string $id, string $todo): void
    {
        if (!Session::exists("todoList")) {
            Session::put("todoList", []);
        }
        Session::push('todoList', ['id' => $id, 'todo' => $todo]);
    }

        public function getTodoList(): array {
        return Session::get('todoList', []);
    }

    public function removeTodo(string $todoId): void {
        $todoList = Session::get('todoList');
        foreach ($todoList as $key => $todo) {
            if ($todo['id'] == $todoId) {
                unset($todoList[$key]);
                break;
            }
        }
        Session::put('todoList', $todoList);
    }
}
