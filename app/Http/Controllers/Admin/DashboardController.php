<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $popular_post = Post::withCount('comments')
            ->withCount('favorite_to_users')
            ->orderBy('view_count', 'DESC')
            ->orderBy('comments_count', 'DESC')
            ->orderBy('favorite_to_users_count', 'DESC')
            ->take(5)->get();
        $total_pending_post = Post::where('is_approved', false)->count();

        $all_view_count = Post::sum('view_count');

        $authos_count = User::where('role_id', 2)->count();

        $new_authors_today = User::where('role_id', 2)
            ->whereDate('created_at', Carbon::today())->count();

        $active_authors = User::where('role_id', 2)
            ->withCount('posts')
            ->withCount('comments')
            ->withCount('favorite_posts')
            ->orderBy('posts_count', 'DESC')
            ->orderBy('comments_count', 'DESC')
            ->orderBy('favorite_posts_count', 'DESC')
            ->take(10)
            ->get();

        $category_count = Category::all()->count();
        $tag_count = Tag::all()->count();
        return view('admin.dashboard', compact('posts', 'popular_post', 'total_pending_post',
            'all_view_count', 'authos_count', 'new_authors_today', 'active_authors', 'category_count', 'tag_count'));
    }
}
