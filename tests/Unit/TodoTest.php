<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_task()
    {
        // Arrange
        $taskData = [
            'name' => 'Test Task',
            'created_at' => now(),
            'updated_at' => now()
        ];

        // Act
        $task = Task::create($taskData);

        // Assert
        $this->assertInstanceOf(Task::class, $task);
        $this->assertEquals('Test Task', $task->name);
        $this->assertDatabaseHas('tasks', [
            'name' => 'Test Task'
        ]);
    }

    public function test_can_create_tag()
    {
        // Arrange
        $task = Task::create([
            'name' => 'Test Task',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $tagData = [
            'tag_name' => 'Test Tag',
            'task_id' => $task->id,
            'created_at' => now(),
            'updated_at' => now()
        ];

        // Act
        $tag = Tag::create($tagData);

        // Assert
        $this->assertInstanceOf(Tag::class, $tag);
        $this->assertEquals('Test Tag', $tag->tag_name);
        $this->assertDatabaseHas('tags', [
            'tag_name' => 'Test Tag',
            'task_id' => $task->id
        ]);
    }

    public function test_task_can_have_tag()
    {
        // Arrange
        $task = Task::create([
            'name' => 'Task with Tag',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $tag = Tag::create([
            'tag_name' => 'Test Tag',
            'task_id' => $task->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Act & Assert
        $this->assertTrue($task->tags->contains($tag));
        $this->assertEquals(1, $task->tags->count());
    }

    public function test_can_delete_task()
    {
        // Arrange
        $task = Task::create([
            'name' => 'Task to Delete',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Act
        $task->delete();

        // Assert
        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
            'name' => 'Task to Delete'
        ]);
    }

    public function test_can_update_task()
    {
        // Arrange
        $task = Task::create([
            'name' => 'Original Task',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Act
        $task->update(['name' => 'Updated Task']);

        // Assert
        $this->assertEquals('Updated Task', $task->name);
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'name' => 'Updated Task'
        ]);
    }
} 