<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        return Question::with('quiz', 'options')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question' => 'required|string',
            'options' => 'required|array|min:2',
            'correct_option' => 'required|integer',
        ]);

        $question = Question::create([
            'quiz_id' => $request->quiz_id,
            'question' => $request->question,
        ]);

        foreach ($request->options as $index => $optText) {
            $question->options()->create([
                'option' => $optText,
                'is_correct' => ($index == $request->correct_option),
            ]);
        }

        return $question->load('options');
    }

    public function show($id)
    {
        return Question::with('options')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->update($request->only('question'));

        // optionally handle option updates here

        return $question->load('options');
    }

    public function destroy($id)
    {
        Question::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
