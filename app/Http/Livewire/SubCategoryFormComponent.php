<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SubCategory;

class SubCategoryFormComponent extends Component
{
    use WithFileUploads;

    public $subCategoryId;
    public $categoryId;
    public $name = '';
    public $image;
    public $mode = 'create'; // or 'edit'

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'image' => $this->mode === 'create' ? 'required|image|mimes:jpg,jpeg,png|max:2048' : 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function mount($categoryId, $subCategoryId = null)
    {
        $this->categoryId = $categoryId;
        $this->subCategoryId = $subCategoryId;
        if ($subCategoryId) {
            $this->mode = 'edit';
            $subCategory = SubCategory::findOrFail($subCategoryId);
            $this->name = $subCategory->name;
        }
    }

    public function save()
    {
        $this->validate();
        if ($this->mode === 'create') {
            $path = $this->image->store('subcategories', 'public');
            SubCategory::create([
                'name' => $this->name,
                'parent_category_id' => $this->categoryId,
                'sub_category_image' => $path,
            ]);
            session()->flash('success', 'Subcategory created successfully!');
        } else {
            $subCategory = SubCategory::findOrFail($this->subCategoryId);
            $subCategory->name = $this->name;
            if ($this->image) {
                $path = $this->image->store('subcategories', 'public');
                $subCategory->sub_category_image = $path;
            }
            $subCategory->save();
            session()->flash('success', 'Subcategory updated successfully!');
        }
        return redirect()->route('categories.show', $this->categoryId);
    }

    public function render()
    {
        return view('livewire.sub-category-form-component');
    }
}
