<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield('title')</title>
</head>

<body>
    <div class="container mt-3 mb-3">
        <div class="row">
            <div class="col-3">
                <h1 class="mt-3 text-warning">Happy Meal</h1>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('meal.index') }}">Food Diary</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('favorite.index') }}">Favorites</a>
                    </li>
                    @if (Auth::check()) 
                    <li class="nav-item">
                        <a href="{{ route('profile.index') }}" class="nav-link">Profile</a>
                    </li>
                    <li>
                        <form method="post" action="{{ route('auth.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link">Logout</button>
                        </form>
                    </li>
                @else 
                    <li class="nav-item">
                        <a href="{{ route('registration.index') }}" class="nav-link">Register</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('auth.loginForm') }}" class="nav-link">Login</a>
                    </li>
                @endif 
                </ul>
            </div>
            <div class="col-lg-8">
                <header>
                    <h3 class="text-left mt-3 mb-3">@yield('title')</h3>
                </header>
                <main>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @yield('content') 
                </main>
            </div>
        </div>
    </div>
</body>
</html>