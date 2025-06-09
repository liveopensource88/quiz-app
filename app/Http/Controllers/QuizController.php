<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        return Quiz::with('category')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string',
            'total_questions' => 'required|integer|min:1',
        ]);

        return Quiz::create($request->only('category_id', 'title', 'total_questions'));
    }

    public function show($id)
    {
        return Quiz::with('questions.options')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->update($request->only('category_id', 'title', 'total_questions'));
        return $quiz;
    }

    public function destroy($id)
    {
        Quiz::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }

    // For user: submit answers and get score
    public function submit(Request $request, $id)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($id);
        $answers = $request->input('answers'); // [question_id => option_id]
        $score = 0;

        foreach ($quiz->questions as $question) {
            $correct = $question->options()->where('is_correct', true)->first();
            if (isset($answers[$question->id]) && $answers[$question->id] == $correct->id) {
                $score++;
            }
        }

        $request->user()->results()->create([
            'quiz_id' => $quiz->id,
            'score' => $score,
        ]);

        return response()->json([
            'message' => 'Quiz submitted',
            'score' => $score,
            'total' => $quiz->questions->count()
        ]);
    }
}
