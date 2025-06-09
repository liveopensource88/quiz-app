<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Admin: list all users
    public function index()
    {
        return User::select('id', 'name', 'email', 'role')->get();
    }

    // Authenticated user: show profile
    public function me(Request $request)
    {
        return $request->user();
    }
}
