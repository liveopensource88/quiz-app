<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Category;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Category::all() as $category) {
            Quiz::create([
                'title' => $category->name . ' Basics',
                'category_id' => $category->id,
                'description' => 'A beginner level quiz on ' . $category->name,
                'is_active' => true,
                'total_questions' => 5,
            ]);
        }
    }
}
