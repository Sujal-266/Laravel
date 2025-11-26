<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SubCategory;

class SubCategoryListComponent extends Component
{
    public $categoryId;
    public $subCategories;
    public $showModal = false;
    public $editId = null;
    public $confirmingDelete = false;
    public $deleteId = null;

    protected $listeners = [
        'subCategoryUpdated' => 'refreshSubCategories',
        'closeModal' => 'closeModal',
    ];

    public function mount($categoryId)
    {
        $this->categoryId = $categoryId;
        $this->refreshSubCategories();
    }

    public function refreshSubCategories()
    {
        $this->subCategories = SubCategory::where('parent_category_id', $this->categoryId)->latest()->get();
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

    public function deleteSubCategory()
    {
        SubCategory::findOrFail($this->deleteId)->delete();
        $this->confirmingDelete = false;
        $this->deleteId = null;
        $this->refreshSubCategories();
    }

    public function render()
    {
        return view('livewire.sub-category-list-component');
    }

    public function deleteSubCategoryDirect($id)
    {
        SubCategory::findOrFail($id)->delete();
        $this->refreshSubCategories();
    }
}
