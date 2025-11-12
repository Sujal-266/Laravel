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
    public function index(Request $request)
    {
        $query = Category::with(['SubCategories', 'user']);

        // Filter by user_id
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->input('user_id'));
        }

        // Searching
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhereHas('SubCategories', function ($subQ) use ($search) {
                      $subQ->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('user', function ($userQ) use ($search) {
                      $userQ->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                  });
            });
        }

        // Sorting
        $sortField = $request->input('sort_field', 'id');
        $sortOrder = $request->input('sort_order', 'asc');
        $validSortFields = ['id', 'name', 'user_id'];
        if (in_array($sortField, $validSortFields)) {
            $query->orderBy($sortField, $sortOrder);
        } else {
            $query->orderBy('id', 'desc');
        }

        $categories = $query->paginate(5);
        return $this->successResponse($categories, __('messages.categories_fetched_successfully'));
    }



    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('category_image')) {

            $filePath = $this->saveFile($request->file('category_image'), 'categories');
            $data['category_image'] = Storage::url($filePath);
        }
        $data['user_id'] = $request->user()->id;
        $category = Category::create($data);
        return $this->successResponse($category, __('messages.category_created'), 201);
    }

    public function show($id)
    {
        $category = Category::with(['SubCategories', 'likers'])->findOrFail($id);
        return $this->successResponse([
            'category' => $category,
            'liked_by' => $category->likers
        ], __('messages.category_fetched_successfully'), 200);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'category_image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $updated = false;

        if ($request->filled('name') && $request->name !== $category->name) {
            $category->name = $request->name;
            $updated = true;
        }

        if ($request->hasFile('category_image')) {
            // Remove /storage/ prefix to get the relative path for deletion
            $oldPath = $category->category_image ? str_replace('/storage/', '', $category->category_image) : null;
            $filePath = $this->replaceFile($oldPath, $request->file('category_image'), 'categories');
            $category->category_image = Storage::url($filePath);
            $updated = true;
        }

        if (!$updated) {
            return $this->errorResponse(__('messages.nothing_to_update'), 400);
        }

        $category->save();

        return $this->successResponse($category, __('messages.category_updated'), 200);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return $this->successResponse(null, __('messages.category_deleted'));
    }

    public function like($id)
    {
        $category = Category::findOrFail($id);
        $category->likers()->syncWithoutDetaching([auth()->id()]);
        return $this->successResponse($category, __('messages.category_liked_successfully'), 200);
    }

    public function dislike($id)
    {
        $category = Category::findOrFail($id);
        $category->likers()->detach(auth()->id());
        return $this->successResponse($category, __('messages.category_disliked_successfully'), 200);
    }
}
