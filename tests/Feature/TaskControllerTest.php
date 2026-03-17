<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase; // Очищает базу перед каждым тестом

    protected $user;
    protected $status;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->status = TaskStatus::factory()->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertStatus(200);
    }

    // Тест: Создание задачи залогиненным пользователем
    public function testStore()
    {
        $data = [
            'name' => 'Test Task',
            'status_id' => $this->status->id,
            'description' => 'Fine description',
            'assigned_to_id' => $this->user->id,
            'labels' => [],
        ];

        $response = $this->actingAs($this->user)
            ->post(route('tasks.store'), $data);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['name' => 'Test Task']);
    }

    public function testDestroyByCreator()
    {
        $task = Task::factory()->create(['created_by_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
            ->delete(route('tasks.destroy', $task));

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function testDestroyByNonCreator()
    {
        $anotherUser = User::factory()->create();
        $task = Task::factory()->create(['created_by_id' => $this->user->id]);

        $response = $this->actingAs($anotherUser)
            ->delete(route('tasks.destroy', $task));

        $response->assertStatus(403);
        $this->assertDatabaseHas('tasks', ['id' => $task->id]);
    }
}
