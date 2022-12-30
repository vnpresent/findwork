<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'title',
        'work_id',
        'level_id',
        'experience_id',
        'degree_id',
        'working_form_id',
        'sex',
        'city_id',
        'address',
        'min_salary',
        'max_salary',
        'number_applicants',
        'description',
        'benefit',
        'end_date',
        'status',
        'is_pinned',
        'note',
        'manager_id'
    ];

    public function getEmployer()
    {
        return $this->belongsTo(Employer::class)->withTimestamps();
    }

    public function getSkills()
    {
        return $this->belongsToMany(Skill::class)->withTimestamps();
    }

    public function getCvs()
    {
        return $this->belongsToMany(Cv::class)->withTimestamps();
    }
}
