<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_ar',
        'about_en',
        'objective_ar',
        'objective_en',
        'mission_ar',
        'mission_en',
        'vission_ar',
        'vission_en',
        'goal_ar',
        'goal_en',
        'image',
    ];
}
