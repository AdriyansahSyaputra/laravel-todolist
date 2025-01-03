<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function index(Request $request)
    {
        $todoList = $this->todolistService->getTodoList();
        return view('todolist.todo', compact('todoList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'todo' => 'required'
        ]);

        $generateId = count($this->todolistService->getTodoList()) + 1;

        $this->todolistService->saveTodo($generateId, $request->todo);

        return redirect('/');
    }

    public function destroy(Request $request, string $todoId)
    {
        $this->todolistService->removeTodo($todoId);

        return redirect('/');
    }
}
