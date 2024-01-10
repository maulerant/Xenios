<?php

namespace Database\Factories;

use App\Models\GroupOfMessages;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'group_id' => GroupOfMessages::factory()->create(),
            'text' => fake()->name(),
            'user' => fake()->name(),
        ];
    }
}
