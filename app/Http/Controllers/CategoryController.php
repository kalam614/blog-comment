<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {

        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        // Validate the category name
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        // Create the new category
        Category::create([
            'name' => $validated['name'],
        ]);

        // Redirect to categories list or wherever you need
        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }
}
