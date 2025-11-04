<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::with('category')->paginate(5);
        return response()->json($subcategories);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_category_id' => 'required|exists:categories,id',
        ]);
        $subcategory = SubCategory::create($validated);
        return response()->json(['message' => 'SubCategory created', 'data' => $subcategory], 201);
    }

    public function show($id)
    {
        $subcategory = SubCategory::with('category')->findOrFail($id);
        return response()->json($subcategory);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_category_id' => 'required|exists:categories,id',
        ]);
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->update($validated);
        return response()->json(['message' => 'SubCategory updated', 'data' => $subcategory]);
    }

    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();
        return response()->json(['message' => 'SubCategory deleted']);
    }
}
