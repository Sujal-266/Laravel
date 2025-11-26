@extends('UI.base.main')
@section('content')
<div class="container py-4">
    <h3>Edit Category</h3>
    @livewire('category-form-component', ['categoryId' => $category->id])
    <a href="{{ route('categories.index') }}" class="btn btn-link mt-3">Back to list</a>
</div>
@endsection
