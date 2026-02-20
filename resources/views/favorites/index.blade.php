@extends('layouts.app')

@section('content')
<h3>My Favorite Movies</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($favorites->count())
<div class="row">
    @foreach($favorites as $fav)
    <div class="col-md-3 mb-4">
        <div class="card h-100 d-flex column">
            <img src="{{ $fav->poster != 'N/A' ? $fav->poster : 'https://via.placeholder.com/300x450' }}" class="card-img-top">
            <div class="card-body">
                <h6>{{ $fav->title }}</h6>
                <form action="{{ route('favorites.remove', $fav->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger btn-sm w-100">Remove</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="text-center mt-5"><h5>No favorites yet.</h5></div>
@endif
@endsection
