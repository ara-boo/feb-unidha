<?php

namespace App\Http\Controllers;

use App\Models\Page;

class ProfileController extends Controller
{
    public function show(Page $page)
    {
        $others = Page::where('id', '!=', $page->id)
            ->orderBy('sort_order')
            ->get();

        return view('profile.show', compact('page', 'others'));
    }
}