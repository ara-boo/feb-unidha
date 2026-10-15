<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Post;
use App\Models\StudyProgram;

class HomeController extends Controller
{
    public function index()
    {
        $latestPosts = Post::with('category')
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        $programs = StudyProgram::orderBy('sort_order')->get();

        $stats = [
            'programs'  => $programs->count(),
            'lecturers' => Lecturer::count(),
            'posts'     => Post::published()->count(),
        ];

        return view('home', compact('latestPosts', 'programs', 'stats'));
    }
}