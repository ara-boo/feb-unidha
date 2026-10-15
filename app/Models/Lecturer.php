<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $fillable = [
        'study_program_id', 'name', 'nidn', 'position',
        'email', 'photo', 'sort_order',
    ];

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }
}
