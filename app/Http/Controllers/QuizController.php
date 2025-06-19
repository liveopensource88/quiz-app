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
        $validated = $request->validate([
           
            'title' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required',
          
        ]);
        Quiz::create($validated);
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz created successfully.');
    }

    public function show($id)
    {
        return Quiz::with('questions.options')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
           
            'title' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required',
          
        ]);
        $quiz = Quiz::findOrFail($id);
        
        $quiz->update($validated);
        
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz updated successfully!');
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
