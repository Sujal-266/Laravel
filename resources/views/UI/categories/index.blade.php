@extends('UI.base.main')
@section('content')
<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('success') }}
        </div>
    @endif
    @livewire('category-list-component')
</div>
@endsection
