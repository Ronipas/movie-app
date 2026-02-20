@extends('layouts.app')

@section('title', 'Movie Detail')

@section('content')

@if($movie && $movie['Response'] == 'True')

<div class="row">
    <div class="col-md-4">
        <img class="img-fluid"
             src="{{ $movie['Poster'] != 'N/A' ? $movie['Poster'] : 'https://via.placeholder.com/300x450' }}">
    </div>

    <div class="col-md-8">
        <h3>{{ $movie['Title'] }} ({{ $movie['Year'] }})</h3>

        <p><strong>Genre:</strong> {{ $movie['Genre'] }}</p>
        <p><strong>Director:</strong> {{ $movie['Director'] }}</p>
        <p><strong>Actors:</strong> {{ $movie['Actors'] }}</p>
        <p><strong>IMDB Rating:</strong> {{ $movie['imdbRating'] }}</p>

        <p>{{ $movie['Plot'] }}</p>

        <form method="POST" action="{{ route('favorites.add') }}">
            @csrf
            <input type="hidden" name="imdbID" value="{{ $movie['imdbID'] }}">
            <input type="hidden" name="title" value="{{ $movie['Title'] }}">
            <input type="hidden" name="poster" value="{{ $movie['Poster'] }}">
            <button class="btn btn-success">Add to Favorite</button>
        </form>

        <br>
        <!-- <a href="{{ route('movies') }}" class="btn btn-secondary">Back</a> -->
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a> 

    </div>
</div>

@else
    <div class="text-center">
        <h4>Movie not found.</h4>
    </div>
@endif

@endsection
