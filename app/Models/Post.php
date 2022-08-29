<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id','title','description','number_applicants','min_salary','max_salary','start_date','end_date','is_pinned'
    ];
}
