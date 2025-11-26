<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;

class CategoryFormComponent extends Component
{
    use WithFileUploads;

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

    public function mount($categoryId = null)
    {
        $this->categoryId = $categoryId;
        if ($categoryId) {
            $this->mode = 'edit';
            $category = Category::findOrFail($categoryId);
            $this->name = $category->name;
        }
    }

    public function save()
    {
        $this->validate();
        if ($this->mode === 'create') {
            $path = $this->image->store('categories', 'public');
            Category::create([
                'name' => $this->name,
                'category_image' => $path,
                'user_id' => auth()->id(),
            ]);
            session()->flash('success', 'Category created successfully!');
        } else {
            $category = Category::findOrFail($this->categoryId);
            $category->name = $this->name;
            if ($this->image) {
                $path = $this->image->store('categories', 'public');
                $category->category_image = $path;
            }
            $category->save();
            session()->flash('success', 'Category updated successfully!');
        }
        return redirect()->route('categories.index');
    }

    public function render()
    {
        return view('livewire.category-form-component');
    }
}
