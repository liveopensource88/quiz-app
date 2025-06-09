<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Quiz::all() as $quiz) {
            for ($i = 1; $i <= 5; $i++) {
                Question::create([
                    'quiz_id' => $quiz->id,
                    'question' => "Question $i for {$quiz->title}",
                    'type' => 'mcq',
                ]);
            }
        }
    }
}
