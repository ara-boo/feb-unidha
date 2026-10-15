<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $posts = Post::with('category')
            ->published()
            ->when($request->category, function ($query, $slug) {
                $query->whereHas('category', fn ($c) => $c->where('slug', $slug));
            })
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('news.index', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        abort_unless($post->status === 'published', 404);

        $related = Post::published()
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('news.show', compact('post', 'related'));
    }
}