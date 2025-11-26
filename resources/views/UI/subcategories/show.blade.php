@extends('UI.base.main')
@section('content')
<div class="container py-4">
    <a href="{{ route('categories.show', $subCategory->parent_category_id) }}" class="btn btn-link mb-3">Back to Category</a>
    <div class="mb-4">
        <h3>{{ $subCategory->name }}</h3>
        @if($subCategory->sub_category_image)
            <img src="{{ asset('storage/' . $subCategory->sub_category_image) }}" width="120" class="img-thumbnail">
        @endif
        <div class="mt-3">
            <a href="{{ route('subcategories.edit', ['categoryId' => $subCategory->parent_category_id, 'subCategoryId' => $subCategory->id]) }}" class="btn btn-primary">Edit</a>
            <button class="btn btn-danger" onclick="if(confirm('Delete this subcategory?')) { window.livewire.find('sub-category-list-component')?.deleteSubCategoryDirect({{ $subCategory->id }}); }">Delete</button>
        </div>
    </div>
    <!-- Add more subcategory details here if needed -->
</div>
@endsection
