<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $users = \App\Models\User::get();
        $user = \App\Models\User::where(['email'=>'max@mail.com'])->first();
        $catigorys = \App\Models\Catigory::where(['user_id'=>$user->user_id])->get();
        return [
            'task_id'       =>  Str::random(10),
            'title'         =>  fake()->text(50),
            'description'   =>  fake()->text(200),
            'status'        =>  false,
            'due_date'      =>  date('Y-m-d'),
            'catigory_id'   =>  $catigorys[rand(0,count($catigorys)-1)]->catigory_id,
            'user_id'       =>  $user->user_id,
            // 'user_id'       =>  $users[rand(0,count($users)-1)]->user_id,
        ];
    }
}
