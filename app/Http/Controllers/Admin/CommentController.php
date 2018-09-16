<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Compound;

class CommentController extends Controller
{
    public function index()
    {
       $comments = Comment::latest()->get();
       return view('admin.comment.index', compact('comments'));
    }

    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();
        Toastr::success('Comment Deleted successfully.', 'Success');
        return redirect()->back();
    }
}
