@extends('layouts.main')

@section('title', 'Food Diary')

@section('content')
@if ($meals->count() == 0)
    <div class="text-left mb-3">
        Your food diary is empty! Start one now with a <a href="{{ route('meal.create') }}">new food log</a>
    </div>
@else
    <div class="text-end mb-3">
        <a href="{{ route('meal.create') }}">New Food Log</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Meal Type</th>
                <th>Date Added</th>
                @if (Auth::user()->isAdmin())
                    <th>User</th>
                @endif
                <th>Action</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($meals as $meal)
                <tr>
                    <td>
                        {{ $meal->name }}
                    </td>
                    <td>
                        {{ $meal->meal_type->name }}
                    </td>
                    <td>
                        {{ date_format(date_create($meal->created_at),"D, F d, Y H:i") }}
                    </td>
                    @if (Auth::user()->isAdmin())
                        <td> {{ $meal->user->name }} </td>
                    @endif
                    <td>
                        <a href="{{ route('meal.edit', [ 'id' => $meal->id ]) }}">
                            Edit
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('meal.deleteForm', [ 'id' => $meal->id ]) }}">
                            Delete
                        </a>
                    </td>
                    <td>
                        @if ($meal->is_favorite == false)
                        <form action="{{ route('favorite.store', [ 'id' => $meal->id ]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="favorite">
                            <button type="submit" class="btn btn-warning">
                                Add to favorites
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection