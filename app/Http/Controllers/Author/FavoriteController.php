<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function favoritePost()
    {
        $favoritePosts = Auth::user()->favorite_posts;
        return view('author.favorite.favorite', compact('favoritePosts'));
    }
}
