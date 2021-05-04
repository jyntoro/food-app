@extends('layouts.main')

@section('title', 'Profile')

@section('content')
    <p>Hello, {{ $user->name }}. Your email is {{ $user->email }}.</p>
    {{-- <div class="card text-dark bg-info mb-3">
        <div class="card-body">
        <h5 class="card-title">Food Log Summary</h5>
        <p class="card-text">
            You have eaten <b> {{  }}</b> meals<br>
            <b>{{  }}</b> breakfasts<br>
            <b>{{  }}</b> brunches<br>
            <b>{{  }}</b> lunches<br>
            <b>{{  }}</b> dinners<br>
            <b>{{  }}</b> brunches<br>

        </p>
        </div>
    </div> --}}
@endsection