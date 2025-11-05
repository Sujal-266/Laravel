<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Traits\ApiResponse;
use App\Http\Requests\SubCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::with('category')->paginate(5);
        return response()->json($subcategories, __('messages.subcategories_fetched_successfully'));
    }

    public function store(SubCategoryRequest $request)
    {
        $subcategory = SubCategory::create($request->validated());
        return response()->json(['message' => __('messages.subcategory_created'), 'data' => $subcategory], 201);
    }

    public function show($id)
    {
        $subcategory = SubCategory::with('category')->findOrFail($id);
        return response()->json($subcategory, __('messages.subcategory_fetched_successfully'));
    }

    public function update(SubCategoryRequest $request, $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->update($request->validated());
        return response()->json(['message' => __('messages.subcategory_updated'), 'data' => $subcategory]);
    }

    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();
        return response()->json(['message' => __('messages.subcategory_deleted')]);
    }
}
