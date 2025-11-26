@extends('UI.base.main')
@section('content')
<div class="container py-4">
    <a href="{{ route('subcategories.create', $category->id) }}" class="btn btn-success mb-3">Add Subcategory</a>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('success') }}
        </div>
    @endif
    <div class="mb-4">
        <h3>Category Name: {{ $category->name }}</h3>
        @if($category->category_image)
            <img src="{{ asset('storage/' . $category->category_image) }}" width="120" class="img-thumbnail">
        @endif
        <div class="mt-3">
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
            </form>
        </div>
    </div>
    @livewire('sub-category-list-component', ['categoryId' => $category->id])
</div>
@endsection
