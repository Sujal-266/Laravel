<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $categories = Category::with('SubCategories')->paginate(5);
        if (!$categories) {
            return $this->errorResponse('No categories found', 404);
        }
        return $this->successResponse($categories);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category = Category::create($validated);
        return $this->successResponse($category, 'Category created', 201);
    }

    public function show($id)
    {
        $category = Category::with('SubCategories')->findOrFail($id);
        return $this->successResponse($category);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $category = Category::findOrFail($id);
        $category->update($validated);
        return $this->successResponse($category, 'Category updated');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return $this->successResponse(null, 'Category deleted');
    }
}
