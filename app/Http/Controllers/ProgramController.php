<?php

namespace App\Http\Controllers;

use App\Models\StudyProgram;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = StudyProgram::withCount('lecturers')
            ->orderBy('sort_order')
            ->get();

        return view('programs.index', compact('programs'));
    }

    public function show(StudyProgram $program)
    {
        $program->load(['lecturers' => function ($query) {
            $query->orderBy('sort_order')->orderBy('name');
        }]);

        $others = StudyProgram::where('id', '!=', $program->id)
            ->orderBy('sort_order')
            ->get();

        return view('programs.show', compact('program', 'others'));
    }
}