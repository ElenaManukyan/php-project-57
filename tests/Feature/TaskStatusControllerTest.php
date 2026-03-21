<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $data = TaskStatus::factory()->make()->only(['name']);

        $response = $this->actingAs($this->user)
            ->post(route('task_statuses.store'), $data);

        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testUpdate()
    {
        $status = TaskStatus::factory()->create();
        $newData = TaskStatus::factory()->make()->only(['name']);

        $response = $this->actingAs($this->user)
            ->patch(route('task_statuses.update', $status), $newData);

        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', $newData);
    }

    public function testDestroy()
    {
        $status = TaskStatus::factory()->create();

        $response = $this->actingAs($this->user)
            ->delete(route('task_statuses.destroy', $status));

        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseMissing('task_statuses', ['id' => $status->id]);
    }

    public function testGuestCannotCreateStatus()
    {
        $response = $this->post(route('task_statuses.store'), ['name' => 'Аноним']);
        $response->assertRedirect(route('login'));
    }
}
