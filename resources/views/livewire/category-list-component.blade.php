<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Categories</h4>
        <a href="{{ route('categories.create') }}" class="btn btn-success">Add Category</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="mb-0 me-0" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this category?')">Delete</button>
                            </form>
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm">View</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
