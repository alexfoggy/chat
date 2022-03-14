<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetTasks()
    {
        $response = $this->getJson('/api/tasks/');

        $response->assertStatus(200);
    }

    public function testPostTask()
    {
        $response = $this->postJson('/api/tasks', [
            'project_id' => 5,
            'title' => 'Unit Test',
            'status' => true,
            'complete_status' => 'new'
        ]);

        $response->assertStatus(201);
    }
}
