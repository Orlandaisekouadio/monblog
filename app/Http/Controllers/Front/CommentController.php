<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function __construct()
    {
        if (!app()->runningInConsole() && !request()->ajax()) {
            abort(403);
        }
    }

    public function store()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }

    public function comments(Post $post)
    {
        $commnents = $post->validComments()->withDepth()->latest()->get->toTree();

        return [
            'html' => view('front/comments', compact('comments'))->render(),
        ];
    }
}
