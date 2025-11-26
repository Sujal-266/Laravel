<div>
    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Subcategory Name</label>
            <input type="text" wire:model.defer="name" class="form-control" id="name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" wire:model="image" class="form-control" id="image" accept="image/*">
            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail mt-2" width="120">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">{{ $mode === 'edit' ? 'Update' : 'Create' }}</button>
        <button type="button" class="btn btn-secondary" wire:click="$emitUp('closeModal')">Cancel</button>
    </form>
</div>
