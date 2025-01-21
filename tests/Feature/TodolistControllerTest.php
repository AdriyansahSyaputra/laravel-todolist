<?php

namespace Tests\Feature;

use Tests\TestCase;
use Database\Seeders\TodoSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodolistControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        DB::delete('DELETE FROM todos');
    }

    public function testTodolist()
    {
        $this->seed(TodoSeeder::class);
        $this->withSession([
            "user" => "Riyan",
        ])->get('/')
            ->assertSeeText('1')
            ->assertSeeText('test');
    }

    public function testAddTodo()
    {
        $this->withSession([
            "user" => "Riyan"
        ])->post('/', [
            "todo" => "test"
        ])->assertRedirect('/');
    }

    public function testDeleteTodo()
    {
        $this->withSession([
            "user" => "Riyan",
            "todoList" => [
                [
                    "id" => "1",
                    "todo" => "test"
                ]
            ]
        ])->delete('/1/delete')
            ->assertRedirect('/');
    }
}
