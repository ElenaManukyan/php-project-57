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

    public function testStoreValidationFails()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->post(route('tasks.store'), [
                             'name' => '',
                             'status_id' => '',
                         ]);

        $response->assertSessionHasErrors(['name', 'status_id']);
        $this->assertDatabaseCount('tasks', 0);
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));
        $response->assertOk();
    }

    public function testShow()
    {
        $task = Task::factory()->create();
        $response = $this->get(route('tasks.show', $task));
        $response->assertOk();
    }

    public function testEdit()
    {
        $task = Task::factory()->create(['created_by_id' => $this->user->id]);
        $response = $this->actingAs($this->user)->get(route('tasks.edit', $task));
        $response->assertOk();
    }

    public function testUpdate()
    {
        $task = Task::factory()->create(['created_by_id' => $this->user->id]);
        $data = [
            'name' => 'Updated Task',
            'status_id' => $this->status->id,
        ];

        $response = $this->actingAs($this->user)
            ->patch(route('tasks.update', $task), $data);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['name' => 'Updated Task']);
    }
}
