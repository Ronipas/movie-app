<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

@auth
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('movies') }}">Movie App</a>

    <div class="ml-auto">
        <a class="btn btn-outline-light btn-sm mr-3" href="{{ route('movies') }}">Movies</a>
        <a class="btn btn-outline-light btn-sm mr-3" href="{{ route('favorites.index') }}">
            Favorites
            @if(isset($favoriteCount) && $favoriteCount > 0)
                <span class="badge badge-danger">{{ $favoriteCount }}</span>
            @endif
        </a>
        <a class="btn btn-danger btn-sm mr-2" href="{{ route('logout') }}">Logout</a>
    </div>
</nav>
@endauth

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>
