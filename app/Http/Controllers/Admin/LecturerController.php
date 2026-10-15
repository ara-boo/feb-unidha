<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LecturerController extends Controller
{
    public function index(Request $request)
    {
        $lecturers = Lecturer::with('studyProgram')
            ->when($request->q, function ($query, $q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('nidn', 'like', "%{$q}%");
                });
            })
            ->when($request->program, fn ($query, $id) => $query->where('study_program_id', $id))
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        $programs = StudyProgram::orderBy('sort_order')->get();

        return view('admin.lecturers.index', compact('lecturers', 'programs'));
    }

    public function create()
    {
        $programs = StudyProgram::orderBy('sort_order')->get();

        return view('admin.lecturers.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('lecturers', 'public');
        }

        Lecturer::create($data);

        return redirect()->route('admin.lecturers.index')
            ->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function edit(Lecturer $lecturer)
    {
        $programs = StudyProgram::orderBy('sort_order')->get();

        return view('admin.lecturers.edit', compact('lecturer', 'programs'));
    }

    public function update(Request $request, Lecturer $lecturer)
    {
        $data = $this->validated($request);

        if ($request->hasFile('photo')) {
            if ($lecturer->photo) {
                Storage::disk('public')->delete($lecturer->photo);
            }
            $data['photo'] = $request->file('photo')->store('lecturers', 'public');
        } else {
            unset($data['photo']);
        }

        $lecturer->update($data);

        return redirect()->route('admin.lecturers.index')
            ->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Lecturer $lecturer)
    {
        if ($lecturer->photo) {
            Storage::disk('public')->delete($lecturer->photo);
        }

        $lecturer->delete();

        return redirect()->route('admin.lecturers.index')
            ->with('success', 'Data dosen berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name'             => ['required', 'string', 'max:255'],
            'nidn'             => ['nullable', 'string', 'max:30'],
            'position'         => ['nullable', 'string', 'max:255'],
            'email'            => ['nullable', 'email', 'max:255'],
            'study_program_id' => ['nullable', 'exists:study_programs,id'],
            'photo'            => ['nullable', 'image', 'max:2048'],
            'sort_order'       => ['nullable', 'integer', 'min:0'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}