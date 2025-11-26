@extends('UI.base.main')
@section('content')
<div class="container py-4">
    <h3>Edit Subcategory</h3>
    @livewire('sub-category-form-component', ['categoryId' => $categoryId, 'subCategoryId' => $subCategoryId])
    <a href="{{ route('categories.show', $categoryId) }}" class="btn btn-link mt-3">Back to category</a>
</div>
@endsection
