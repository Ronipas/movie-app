@extends('layouts.app')

@section('title', 'Movies')

@section('content')

<h3>Movie List</h3>

<form method="GET" action="{{ route('movies') }}" class="d-flex flex-nowrap mb-3">
    <input type="text" name="search" value="{{ $search }}" class="form-control mr-2 flex-grow-1" placeholder="Search movie..." style="max-width: 300px;">
    <button type="submit" class="btn btn-primary flex-shrink-0">Search</button>
</form>

<div id="movie-container" class="row">

@if($movies->count())
    @foreach($movies as $movie)
        <div class="col-md-3 mb-4">
            <div class="card h-100 d-flex flex-column">
                <a href="{{ route('movies.detail', $movie['imdbID']) }}">
                    <img class="card-img-top"
                         src="{{ $movie['Poster'] != 'N/A' ? $movie['Poster'] : 'https://via.placeholder.com/300x450' }}"
                         loading="lazy"
                         alt="{{ $movie['Title'] }}">
                </a>
                <div class="card-body text-center d-flex flex-column">
                    <h6>{{ $movie['Title'] }}</h6>
                    <p>{{ $movie['Year'] }}</p>

                    <form method="POST" action="{{ route('favorites.add') }}" class="mt-auto">
                        @csrf
                        <input type="hidden" name="imdbID" value="{{ $movie['imdbID'] }}">
                        <input type="hidden" name="title" value="{{ $movie['Title'] }}">
                        <input type="hidden" name="poster" value="{{ $movie['Poster'] }}">
                        <button class="btn btn-sm btn-success w-100">Add Favorite</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-12 text-center">
        @if($search)
            <p>Film tidak ditemukan..</p>
            <p>Ketik Judul Film atau Genre Film yang ingin kamu cari dengan benar</p>
        @else
            <p>Silahkan cari Film di tombol Search</p>
            
        @endif
    </div>
@endif

</div>

@endsection

