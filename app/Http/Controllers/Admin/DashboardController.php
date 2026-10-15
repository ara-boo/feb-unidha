<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Lecturer;
use App\Models\Page;
use App\Models\Post;
use App\Models\StudyProgram;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'programs'  => StudyProgram::count(),
            'lecturers' => Lecturer::count(),
            'published' => Post::where('status', 'published')->count(),
            'drafts'    => Post::where('status', 'draft')->count(),
            'pages'     => Page::count(),
        ];

        $programs = StudyProgram::withCount('lecturers')
            ->orderBy('sort_order')
            ->get();

        $unassigned = Lecturer::whereNull('study_program_id')->count();

        $categories = Category::withCount('posts')
            ->orderBy('name')
            ->get();

        $recentPosts = Post::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats', 'programs', 'unassigned', 'categories', 'recentPosts'
        ));
    }
}