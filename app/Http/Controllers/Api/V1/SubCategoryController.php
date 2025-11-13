<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Traits\ApiResponse;
use App\Traits\FileManager;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SubCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SubCategoryController extends Controller
{
    use ApiResponse, FileManager, AuthorizesRequests;
    public function index(Request $request)
    {
        $query = SubCategory::with('category');

        // Searching
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($catQ) use ($search) {
                      $catQ->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Sorting
        $sortField = $request->input('sort_field', 'id'); // default sort field
        $sortOrder = $request->input('sort_order', 'desc'); // default sort order

        // Only allow sorting by valid columns
        $validSortFields = ['id', 'name', 'parent_category_id', 'created_at', 'updated_at'];
        if (in_array($sortField, $validSortFields)) {
            $query->orderBy($sortField, $sortOrder);
        } else {
            $query->orderBy('id', 'desc'); // Default to latest
        }

        $subcategories = $query->paginate(5);

        return $this->successResponse($subcategories, __('messages.subcategories_fetched_successfully'));
    }

    public function store(SubCategoryRequest $request)
    {
        $data = $request->validated();
        $this->authorize('create', SubCategory::class);
        if ($request->hasFile('sub_category_image')) {
            $filePath = $this->saveFile($request->file('sub_category_image'), 'subcategories');
            $data['sub_category_image'] = Storage::url($filePath);
        }
        $subcategory = SubCategory::create($data);
        return $this->successResponse($subcategory, __('messages.subcategory_created'), 201);
    }

    public function show($id)
    {
        $subcategory = SubCategory::with('category')->findOrFail($id);
        return $this->successResponse(['subcategory' => $subcategory], __('messages.subcategory_fetched_successfully'));
    }

    public function update(Request $request, $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $this->authorize('update', $subcategory);
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'category_id' => 'sometimes|exists:categories,id',
            'sub_category_image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $updated = false;
        // Update name if provided
        if ($request->filled('name') && $request->name !== $subcategory->name) {
            $subcategory->name = $request->name;
            $updated = true;
        }
        // Update category_id if provided
        if ($request->filled('category_id') && $request->category_id != $subcategory->category_id) {
            $subcategory->category_id = $request->category_id;
            $updated = true;
        }
        // Update image if provided
        if ($request->hasFile('sub_category_image')) {
            $oldPath = $subcategory->sub_category_image ? str_replace('/storage/', '', $subcategory->sub_category_image) : null;
            $filePath = $this->replaceFile($oldPath, $request->file('sub_category_image'), 'categories');
            $subcategory->sub_category_image = Storage::url($filePath);
            $updated = true;
        }
        if ($updated) {
            $subcategory->save();
        }
        return $this->successResponse($subcategory, __('messages.subcategory_updated'));
    }

    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $this->authorize('delete', $subcategory);
        $subcategory->delete();
        return response()->json([
            'status' => true,
            'message' => __('messages.subcategory_deleted'),
            'data' => null
        ], 200);
    }

}
