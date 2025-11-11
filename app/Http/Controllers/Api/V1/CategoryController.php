<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\ApiResponse;
use App\Traits\FileManager;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    use ApiResponse;
    use FileManager;
    public function index()
    {
        $categories = Category::with('SubCategories')->paginate(5);
        if (!$categories) {
            return $this->errorResponse('No categories found', 404);
        }
        return $this->successResponse($categories,__('messages.categories_fetched_successfully'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('category_image')) {

            $filePath = $this->saveFile($request->file('category_image'), 'categories');
            $data['category_image'] = Storage::url($filePath);
        }
        $category = Category::create($data);
        return $this->successResponse([$category, $data['category_image']], __('messages.category_created'), 201);
    }

    public function show($id)
    {
        $category = Category::with('SubCategories')->findOrFail($id);
        return $this->successResponse($category, __('messages.category_fetched_successfully'));
    }

    public function update(Request $request, $id){
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'category_image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $updated = false;

        // Update name if provided
        if ($request->filled('name') && $request->name !== $category->name) {
            $category->name = $request->name;
            $updated = true;
        }

        // Update image if provided
        if ($request->hasFile('category_image')) {
            $oldPath = $category->category_image ? str_replace('/storage/app/public/categories', '', $category->category_image) : null;
            $filePath = $this->replaceFile($oldPath, $request->file('category_image'), 'categories');
            $category->category_image = Storage::url($filePath);
            $updated = true;
        }

        if (!$updated) {
            return $this->errorResponse(__('messages.nothing_to_update'), 400);
        }

        $category->save();

        return $this->successResponse($category, __('messages.category_updated'));
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return $this->successResponse(null, __('messages.category_deleted'));
    }
}
