<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudyProgramController extends Controller
{
    public function index()
    {
        $programs = StudyProgram::orderBy('sort_order')->orderBy('name')->paginate(10);

        return view('admin.study-programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.study-programs.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->makeSlug($data['degree'] . ' ' . $data['name']);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        StudyProgram::create($data);

        return redirect()->route('admin.study-programs.index')
            ->with('success', 'Program studi berhasil ditambahkan.');
    }

    public function edit(StudyProgram $studyProgram)
    {
        return view('admin.study-programs.edit', ['program' => $studyProgram]);
    }

    public function update(Request $request, StudyProgram $studyProgram)
    {
        $data = $this->validated($request);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $studyProgram->update($data);

        return redirect()->route('admin.study-programs.index')
            ->with('success', 'Program studi berhasil diperbarui.');
    }

    public function destroy(StudyProgram $studyProgram)
    {
        $studyProgram->delete();

        return redirect()->route('admin.study-programs.index')
            ->with('success', 'Program studi berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'degree'        => ['required', 'in:D3,D4,S1,S2'],
            'accreditation' => ['nullable', 'string', 'max:50'],
            'head_name'     => ['nullable', 'string', 'max:255'],
            'website_url'   => ['nullable', 'url', 'max:255'],
            'description'   => ['nullable', 'string'],
            'sort_order'    => ['nullable', 'integer', 'min:0'],
        ]);
    }

    private function makeSlug(string $text): string
    {
        $base = Str::slug($text) ?: 'prodi';
        $slug = $base;
        $i = 2;

        while (StudyProgram::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}