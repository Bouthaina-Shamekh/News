<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ar',
        'title_en',
        'date',
        'vedio',
        'time',
        'img_view',
        'img_video',
        'text_ar',
        'text_en',
        'keyword_ar',
        'keyword_en',
        'category_id',
         'slug',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
