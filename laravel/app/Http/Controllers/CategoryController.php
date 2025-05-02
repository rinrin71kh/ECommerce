<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // TC001: Get all categories
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // TC002: Create a new category
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create($validated);

        return response()->json($category, 201);
    }

    // TC004: Get a single category by ID
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => "Can't find this category!"], 404);
        }

        return response()->json($category);
    }

    // TC006: Update an existing category
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => "Update unsuccessful!"], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($validated);

        return response()->json($category);
    }

    // TC009: Delete an existing category
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => "Delete unsuccessful!"], 404);
        }

        $category->delete();

        return response()->json(['message' => "Delete successful!"]);
    }
}
