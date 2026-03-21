<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testTaskHasRelationships()
    {
        $task = Task::factory()->create();

        if (isset($task->assigned_to_id)) {
            $this->assertInstanceOf(User::class, $task->assignedTo);
        }
    }
}
