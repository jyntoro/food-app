@extends('layouts.main')

@section('title', 'Remove from Favorites')

@section('content')
<form method="post" action="{{ route('favorite.delete', ['id' => $id ] ) }}">
    @csrf
    <div class="mt-3 mb-3">
        <p>
            Are you sure you want to remove {{ $meal->name }} from your favorites?
        </p>
    </div>
    <button type="submit" class="btn btn-danger">
        Remove
    </button>
</form>
@endsection