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
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'parent_category_id' => 'required|exists:categories,id',
            ]);

            $subcategory = SubCategory::create($validated);
            return response()->json(['message' => 'SubCategory created', 'data' => $subcategory], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        try {
            $subcategory = SubCategory::with('category')->findOrFail($id);
            return response()->json($subcategory);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'SubCategory not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'parent_category_id' => 'required|exists:categories,id',
            ]);

            $subcategory = SubCategory::findOrFail($id);
            $subcategory->update($validated);
            return response()->json(['message' => 'SubCategory updated', 'data' => $subcategory]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'SubCategory not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $subcategory = SubCategory::findOrFail($id);
            $subcategory->delete();
            return response()->json(['message' => 'SubCategory deleted']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'SubCategory not found'], 404);
        }
    }
}
