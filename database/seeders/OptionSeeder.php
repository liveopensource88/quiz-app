<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Option;

class OptionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Question::all() as $question) {
            for ($i = 1; $i <= 4; $i++) {
                Option::create([
                    'question_id' => $question->id,
                    'option' => "Option $i",
                    'is_correct' => $i === 1, // Mark first option as correct
                ]);
            }
        }
    }
}
