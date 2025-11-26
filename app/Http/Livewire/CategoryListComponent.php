<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoryListComponent extends Component
{
    public $categories;
    public $showModal = false;
    public $editId = null;
    public $confirmingDelete = false;
    public $deleteId = null;

    protected $listeners = [
        'categoryUpdated' => 'refreshCategories',
        'closeModal' => 'closeModal',
    ];

    public function mount()
    {
        $this->refreshCategories();
    }

    public function refreshCategories()
    {
        $this->categories = Category::latest()->get();
    }

    public function openCreateModal()
    {
        $this->editId = null;
        $this->showModal = true;
    }

    public function openEditModal($id)
    {
        $this->editId = $id;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->editId = null;
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function deleteCategory()
    {
        Category::findOrFail($this->deleteId)->delete();
        $this->confirmingDelete = false;
        $this->deleteId = null;
        $this->refreshCategories();
    }

    public function render()
    {
        return view('livewire.category-list-component');
    }

    public function deleteCategoryDirect($id)
    {
        Category::findOrFail($id)->delete();
        $this->refreshCategories();
    }
}
