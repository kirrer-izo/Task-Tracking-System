<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $assigner = User::where('role','Assigner')->inRandomOrder()->first();
        $technican = User::where('role','IT technician')->inRandomOrder()->first();
        return [
            'task' => fake()->paragraph(10),
            'created_by' => $assigner->name,
            'assigned_to' => $technican->name,
            'status' => fake()->randomElement(['Pending','Completed']),
            'created_at'=> fake()->dateTimeBetween('-2 months','now'),
            'updated_at' => fake()->dateTimeBetween('-2 months','now'),
            'review' => fake()->paragraph()
            
        ];

        if($task['updated_at']>$task['created_at']){
            $task['updated_at'] = $task['created_at'];
        }
    }
}
