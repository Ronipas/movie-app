<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input search, pakai default 'avengers' supaya tidak kosong
        $search = $request->get('search','avengers');
        $page   = $request->get('page', 1);

        $apiKey = env('OMDB_KEY');
        $url = "https://www.omdbapi.com/?apikey={$apiKey}&s=" . urlencode($search) . "&page=" . $page;

        // Ambil data dari OMDb
        $response = @file_get_contents($url);

        if (!$response) {
            $movies = collect(); // kosong jika gagal
        } else {
            $data = json_decode($response, true);
            $movies = isset($data['Search']) ? collect($data['Search']) : collect();
        }

        return view('movies.index', [
            'movies' => $movies,
            'search' => $search
        ]);
    }

    public function detail($id)
    {
        $apiKey = env('OMDB_KEY');
        $url = "https://www.omdbapi.com/?apikey={$apiKey}&i=" . urlencode($id);

        $response = @file_get_contents($url);
        $movie = $response ? json_decode($response, true) : null;

        return view('movies.detail', [
            'movie' => $movie
        ]);
    }
}
