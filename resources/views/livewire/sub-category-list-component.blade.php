<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Subcategories</h5>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subCategories as $subCategory)
                <tr>
                    <td>{{ $subCategory->name }}</td>
                    <td>
                        <a href="{{ route('subcategories.edit', ['categoryId' => $categoryId, 'subCategoryId' => $subCategory->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('subcategories.destroy', ['categoryId' => $categoryId, 'subCategoryId' => $subCategory->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this subcategory?')">Delete</button>
                        </form>
                        <a href="{{ route('subcategories.show', ['categoryId' => $categoryId, 'subCategoryId' => $subCategory->id]) }}" class="btn btn-info btn-sm">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal for Create/Edit and Delete Confirmation removed: now using separate edit page and direct delete -->
</div>
