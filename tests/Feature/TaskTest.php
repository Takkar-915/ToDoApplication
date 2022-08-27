<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     *@test
     */
    public function test_get_data()
    {
        $tasks = Task::factory()->count(10)->create();

        $response = $this->getJson("api/tasks");
        dd($response->json());

        $response
            ->assertOk()
            ->assertJsonCount($tasks->count());
    }

    /**
     *@test
     */
    public function test_store()
    {
        $data = [
            "title" => "テスト投稿"
        ];

        $response = $this->postJson("api/tasks", ["title" => "テストで投稿"]);
        $response
            ->assertStatus(201);
    }

    /**
     *@test
     *タイトルが空の場合は登録できない
     */
    public function test_null_store()
    {
        $data = [
            "title" => "",
        ];

        $response = $this->postJson("api/tasks", $data);

        dd($response);
        $response
            ->assertStatus(201);
    }
    /**
     *@test
     */
    public function test_update()
    {
        $task = Task::factory()->create();

        $task->title = "書き換え";

        $response = $this->patchJson("api/tasks/{$task->id}", $task->toArray());

        $response
            ->assertStatus(201);
    }

    /**
     *@test
     */
    public function test_delete()
    {
        $task = Task::factory()->count(10)->create();

        $response = $this->deleteJson("api/tasks/1");

        $response = $this->getJson("api/tasks");

        $response->assertJsonCount($task->count() - 1);
    }
}
