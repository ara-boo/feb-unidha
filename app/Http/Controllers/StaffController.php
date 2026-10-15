<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class StaffController extends Controller
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
            ->paginate(12)
            ->withQueryString();

        $programs = StudyProgram::orderBy('sort_order')->get();
        $total = Lecturer::count();

        return view('lecturers.index', compact('lecturers', 'programs', 'total'));
    }
}