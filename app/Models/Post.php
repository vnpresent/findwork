<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employer_id', 'title', 'levels', 'description', 'number_applicants', 'min_salary', 'max_salary', 'start_date', 'end_date', 'is_pinned'
    ];

    public function getCvs()
    {
        return $this->belongsToMany(Cv::class);
    }
}
