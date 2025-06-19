<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        return Category::findOrFail($id);
    }

    public function edit(Category $category)
    {
        return Inertia::render('Admin/Categories/Edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
      
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $category = Category::findOrFail($id);
   
        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');

    }

    public function destroy($id)
    {
        Category::destroy($id);
        return response()->json(['message' => 'Deleted']);

    }
}
