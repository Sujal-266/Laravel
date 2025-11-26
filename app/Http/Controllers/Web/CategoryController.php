<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('UI.categories.index');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('UI.categories.show', compact('category'));
    }

    public function create()
    {
        return view('UI.categories.create');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('UI.categories.edit', compact('category'));
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
