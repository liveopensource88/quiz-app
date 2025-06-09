<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Result;

class ResultSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {
            $quiz = Quiz::inRandomOrder()->first();
            Result::create([
                'user_id' => $user->id,
                'quiz_id' => $quiz->id,
                'score' => rand(1, 5),
                'completed_at' => now(),
            ]);
        }
    }
}
