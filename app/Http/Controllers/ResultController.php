<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    // Admin: view all results
    public function index()
    {
        return Result::with('user', 'quiz')->get();
    }

    // User: view their own results
    public function myResults(Request $request)
    {
        return $request->user()->results()->with('quiz')->get();
    }
}
