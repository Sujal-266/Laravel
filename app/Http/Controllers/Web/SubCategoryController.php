<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function create($categoryId)
    {
        // Ensure the parent category exists
        $category = Category::findOrFail($categoryId);
        return view('UI.subcategories.create', ['categoryId' => $categoryId]);
    }
    public function edit($categoryId, $subCategoryId)
    {
        // Ensure the parent category exists
        $category = Category::findOrFail($categoryId);
        return view('UI.subcategories.edit', [
            'categoryId' => $categoryId,
            'subCategoryId' => $subCategoryId,
        ]);
    }
    public function show($categoryId, $subCategoryId)
    {
        $subCategory = \App\Models\SubCategory::findOrFail($subCategoryId);
        return view('UI.subcategories.show', compact('subCategory'));
    }
    public function destroy($categoryId, $subCategoryId)
    {
        $subCategory = \App\Models\SubCategory::findOrFail($subCategoryId);
        $subCategory->delete();
        return redirect()->route('categories.show', $categoryId)->with('success', 'Subcategory deleted successfully!');
    }
}
