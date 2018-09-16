<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Notifications\AuthorPostApproval;
use App\Notifications\NewPostNotifyForSubscriber;
use App\Post;
use App\Subscriber;
use App\Tag;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\Types\Compound;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,bmp,png',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if (isset($image)){
            $currantDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currantDate.'-'.uniqid().'.'.$image->getclientoriginalextension();

            if (!Storage::disk('public')->exists('post')){
                Storage::disk('public')->makeDirectory('post');
            }
            $postResize = Image::make($image)->resize(1600,1066)->stream();
            Storage::disk('public')->put('post/'.$imageName, $postResize);
        }else{
            $imageName = 'post.png';
        }

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;

        if (isset($request->status)){
            $post->status = true;
        }else{
            $post->status = false;
        }

        $post->is_approved = true;
        $post->save();
        $post->tags()->attach($request->tags);
        $post->categories()->attach($request->categories);

        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber)
        {
            Notification::route('mail', $subscriber->email)
                ->notify(new NewPostNotifyForSubscriber($post));
        }

        Toastr::success('Post successfully saved', 'Success');
        return redirect()->route('admin.post.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'image|mimes:jpg,jpeg,bmp,png',
            'body' => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if (isset($image)){
            $currantDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currantDate.'-'.uniqid().'.'.$image->getclientoriginalextension();

            if (!Storage::disk('public')->exists('post/'.$post->image)){
                Storage::disk('public')->makeDirectory('post/'.$post->image);
            }
            if (Storage::disk('public')->exists('post/'.$post->image)){
                Storage::disk('public')->delete('post/'.$post->image);
            }
            $postResize = Image::make($image)->resize(1600,1066)->stream();
            Storage::disk('public')->put('post/'.$imageName, $postResize);
        }else{
            $imageName = $post->image;
        }

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;
        if (isset($request->status)){
            $post->status = true;
        }else{
            $post->status = false;
        }
        $post->is_approved = true;
        $post->save();
        $post->tags()->sync($request->tags);
        $post->categories()->sync($request->categories);
        Toastr::success('Post successfully updated', 'Success');
        return redirect()->route('admin.post.index');
    }

    public function pending()
    {
        $posts = Post::where('is_approved', false)->get();
        return view('admin.post.pending', compact('posts'));
    }

    public function approval($id)
    {
        $post = Post::find($id);
        if ($post->is_approved == false)
        {
            $post->is_approved = true;
            $post->save();

            $subscribers = Subscriber::all();
            $post->user->notify(new AuthorPostApproval($post));
            foreach ($subscribers as $subscriber)
            {
                Notification::route('mail', $subscriber->email)
                    ->notify(new NewPostNotifyForSubscriber($post));
            }
            Toastr::success('Post successfully Approved', 'Success');
        }else{
            Toastr::warning('Post is already Approved', 'Warning');
        }
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Storage::disk('public')->exists('post/'.$post->image)){
            Storage::disk('public')->delete('post/'.$post->image);
        }
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        Toastr::success('Post successfully deleted', 'Success');
        return redirect()->back();

    }
}
