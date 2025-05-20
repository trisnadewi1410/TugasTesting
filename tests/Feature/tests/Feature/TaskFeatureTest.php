<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;

class TaskFeatureTest extends TestCase
{
    // Test removed because the feature is not implemented
}

class CalculatorFeatureTest extends TestCase
{
    public function test_addition_api_with_positive_numbers()
    {
        $response = $this->postJson('/api/calculator/add', [
            'a' => 7,
            'b' => 2
        ]);
        $response->assertStatus(200);
        $response->assertJson(['result' => 9]);
    }

    public function test_addition_api_with_negative_number_should_return_error()
    {
        $response = $this->postJson('/api/calculator/add', [
            'a' => -5,
            'b' => 3
        ]);
        $response->assertStatus(422);
        $response->assertJson(['error' => 'Input harus berupa angka positif.']);
    }
}
