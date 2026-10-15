<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    protected $fillable = [
        'name', 'slug', 'degree', 'accreditation',
        'head_name', 'website_url', 'description', 'sort_order',
    ];

    public function getFullNameAttribute(): string
    {
        return $this->degree . ' ' . $this->name;
    }
    public function lecturers()
    {
    return $this->hasMany(Lecturer::class);
    }
}