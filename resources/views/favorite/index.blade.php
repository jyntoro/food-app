@extends('layouts.main')

@section('title', 'Favorite Meals')

@section('content')
    @if ($meals->count() == 0)
        <div class="text-left mb-3">
            You have no favorite meals!
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Meal Type</th>
                    <th>Date Added to Favorites</th>
                    @if (Auth::user()->isAdmin())
                        <th>User</th>
                    @endif
                    <th>Action</th>
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
                            {{ date_format(date_create($meal->favorited_at),"D, F d, Y H:i") }}
                        </td>
                        @if (Auth::user()->isAdmin())
                            <td>{{ $meal->user->name }}</td>
                        @endif
                        <td>
                            <a href="{{ route('favorite.deleteForm', [ 'id' => $meal->id ]) }}">
                                Remove
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection