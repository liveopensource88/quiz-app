<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Result;
use App\Models\Question;
use App\Models\Answer;

class AnswerSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Result::all() as $result) {
            $questions = Question::where('quiz_id', $result->quiz_id)->get();

            foreach ($questions as $question) {
                Answer::create([
                    'result_id' => $result->id,
                    'question_id' => $question->id,
                    'answer' => 'Sample Answer',
                    'is_correct' => (bool) rand(0, 1),
                ]);
            }
        }
    }
}
