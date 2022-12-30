<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employer extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password', 'balance', 'avatar', 'description', 'address'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getPosts()
    {
        return $this->hasMany(Post::class)->withTimestamps();
    }

//    public function getCvs()
//    {
//        return $this->belongsTo(Cv::class)->withTimestamps();
//    }

    public function getCvs()
    {
        return $this->belongsToMany(Cv::class)->orderBy('cv_employer.created_at','desc')->withTimestamps();
    }
}
