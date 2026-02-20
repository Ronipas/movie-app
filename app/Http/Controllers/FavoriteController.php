<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite; 
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())->get();
        return view('favorites.index', compact('favorites'));
    }

    public function add(Request $request)
    {
        Favorite::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'imdbID' => $request->imdbID
            ],
            [
                'title' => $request->title,
                'poster' => $request->poster
            ]
        );

        return redirect()->back()->with('success', 'Added to favorites!');
    }

    public function remove($id)
    {
        Favorite::where('id', $id)
                ->where('user_id', Auth::id())
                ->delete();

        return redirect()->back()->with('success', 'Removed from favorites!');
    }
}
