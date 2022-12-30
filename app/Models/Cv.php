<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cv extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'applicant_id', 'name', 'position', 'profile', 'objective', 'skills', 'work_experience', 'education', 'activities', 'certifications'
    ];

    protected $casts = [
        'profile' => 'array',
        'skills' => 'array',
        'work_experience' => 'array',
        'education' => 'array',
        'activities' => 'array',
        'certifications' => 'array',
    ];

    public function getPosts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

    public function getSkills()
    {
        return $this->belongsToMany(Skill::class)->withPivot('description')->withTimestamps();
    }
}
