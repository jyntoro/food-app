@extends('layouts.main')

@section('title', 'Delete')

@section('content')
<form method="post" action="{{ route('meal.delete', [ 'id' => $id ]) }}">
    @csrf
    <div class="mt-3 mb-3">
        <p>
            Are you sure you want to delete {{ $meal->name }}?
        </p>
    </div>
    <button type="submit" class="btn btn-danger">
        Delete
    </button>
</form>
@endsection