<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user" => "Riyan",
            "todoList" => [
                [
                    "id" => "1",
                    "todo" => "test"
                ]
            ]
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
