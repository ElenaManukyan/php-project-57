<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Policies\TaskPolicy;

class TaskPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function testOwnerCanUpdateTask()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['created_by_id' => $user->id]);

        $response = $this->actingAs($user)
                         ->get(route('tasks.edit', $task));

        $response->assertStatus(200);
    }

    public function testOtherUserCannotUpdateTask()
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $task = Task::factory()->create(['created_by_id' => $owner->id]);

        $response = $this->actingAs($otherUser)
                         ->get(route('tasks.edit', $task));

        $response->assertStatus(403);
    }


    public function testOtherUserCannotDeleteTask()
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $task = Task::factory()->create(['created_by_id' => $owner->id]);

        $response = $this->actingAs($otherUser)
                         ->delete(route('tasks.destroy', $task));

        $response->assertStatus(403);
        $this->assertDatabaseHas('tasks', ['id' => $task->id]);
    }

    public function testTaskPolicyLogicDirectly()
    {
        $policy = new TaskPolicy();
        $user = User::factory()->create();
        $owner = User::factory()->create();
        $task = Task::factory()->create(['created_by_id' => $owner->id]);

        $this->assertTrue($policy->update($owner, $task));
        $this->assertFalse($policy->update($user, $task));

        $this->assertTrue($policy->delete($owner, $task));
        $this->assertFalse($policy->delete($user, $task));
    }
}
