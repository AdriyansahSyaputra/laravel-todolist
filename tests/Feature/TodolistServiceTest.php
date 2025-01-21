<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Testing\Assert;
use Database\Seeders\TodoSeeder;
use App\Services\TodolistService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    public function setUp(): void
    {
        parent::setUp();

        DB::delete('DELETE FROM todos');

        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodolistNotNull()
    {
        $this->assertNotNull($this->todolistService);
    }

    public function testSaveTodo()
    {
        $this->todolistService->saveTodo('1', 'test');

        $todoList = $this->todolistService->getTodoList();
        foreach ($todoList as $todo) {
            self::assertEquals('1', $todo['id']);
            self::assertEquals('test', $todo['todo']);
        }
    }

    public function testGetTodoListEmpty()
    {
        self::assertEquals([], $this->todolistService->getTodoList());
    }

    public function testGetTodoListNotEmpty()
    {
        $expected = [
            [
                "id" => "1",
                "todo" => "test"
            ],
            [
                "id" => "2",
                "todo" => "Game"
            ]
        ];

        $this->todolistService->saveTodo('1', 'test');
        $this->todolistService->saveTodo('2', 'Game');

        Assert::assertArraySubset($expected, $this->todolistService->getTodoList());
    }

    public function testRemoveTodo()
    {

        $this->todolistService->saveTodo('1', 'test');
        $this->todolistService->saveTodo('2', 'Game');

        self::assertEquals(2, sizeof($this->todolistService->getTodoList()));

        $this->todolistService->removeTodo('3');

        self::assertEquals(2, sizeof($this->todolistService->getTodoList()));

        $this->todolistService->removeTodo('1');

        self::assertEquals(1, sizeof($this->todolistService->getTodoList()));

        $this->todolistService->removeTodo('2');

        self::assertEquals(0, sizeof($this->todolistService->getTodoList()));
    }
}
