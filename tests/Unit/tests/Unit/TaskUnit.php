<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Task;

class SampleTesting extends TestCase
{
    /**
     * A basic unit test example.
     */
    // public function test_example(): void
    // {
    //     $this->assertTrue(true);
    // }

    public function test_task_cannot_be_completed_without_description()
    {
        $task = Task::create([
            'title' => 'Belajar Laravel',
            'description' => '',
            'completed' => false,
        ]);

        // Simulasi update ke completed = true
        $task->completed = true;

        // Validasi manual sesuai logic controller
        $this->assertTrue(empty($task->description), 'Deskripsi harus kosong');
        $this->assertFalse($task->completed && empty($task->description), 'Task tidak boleh selesai tanpa deskripsi');
    }
}

class CalculatorTest extends TestCase
{
    public function test_addition_with_positive_numbers()
    {
        $a = 5;
        $b = 3;
        $result = $a + $b;
        $this->assertEquals(8, $result);
    }

    public function test_addition_with_negative_number_should_fail()
    {
        $a = -2;
        $b = 4;
        $this->assertTrue($a < 0 || $b < 0, 'Salah satu input negatif');
    }
}
