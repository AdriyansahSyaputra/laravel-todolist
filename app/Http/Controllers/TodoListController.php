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
        // if($request->session()->exists('user')) {
        //     return redirect('/');
        // } else {
        //     return redirect('/login');
        // }

        $todoList = $this->todolistService->getTodoList();
        return view('todolist.todo', compact('todoList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'todo' => 'required'
        ]);

        $this->todolistService->saveTodo(uniqid(), $request->todo);

        return redirect('/');
    }

    public function destroy(Request $request, string $todoId)
    {
        $this->todolistService->removeTodo($todoId);

        return redirect('/');
    }
}
