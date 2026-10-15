<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('sort_order')->orderBy('title')->get();

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->makeSlug($data['title']);

        Page::create($data);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Halaman berhasil ditambahkan.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        // Slug sengaja tidak diubah supaya tautan lama tetap berfungsi.
        $page->update($this->validated($request));

        return redirect()->route('admin.pages.index')
            ->with('success', 'Halaman berhasil diperbarui.');
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Halaman berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title'      => ['required', 'string', 'max:255'],
            'content'    => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }

    private function makeSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'halaman';
        $slug = $base;
        $i = 2;

        while (Page::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}