<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Traits\ApiResponse;
use App\Traits\FileManager;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SubCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SubCategoryController extends Controller
{
    use ApiResponse;
    use FileManager;
    public function index()
    {
        $subcategories = SubCategory::with('category')->paginate(5);
        return response()->json([
            'status' => true,
            'message' => __('messages.subcategories_fetched_successfully'),
            'data' => $subcategories
        ], 200);
    }

    public function store(SubCategoryRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('sub_category_image')) {
            $filePath = $this->saveFile($request->file('sub_category_image'), 'subcategories');
            $data['sub_category_image'] = Storage::url($filePath);
        }
        $subcategory = SubCategory::create($data);
        return response()->json(['message' => __('messages.subcategory_created'), 'data' => $subcategory], 201);
    }

    public function show($id)
    {
        $subcategories = SubCategory::with('category')->findOrFail($id);
        return $this->successResponse($subcategories, __('messages.subcategory_fetched_successfully'));
    }

    public function update(Request $request, $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'category_id' => 'sometimes|exists:categories,id',
            'subcategory_image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
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
        $subcategory->delete();
        return response()->json([
            'status' => true,
            'message' => __('messages.subcategory_deleted'),
            'data' => null
        ], 200);
    }
}
