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
        'video_url',
        'time',
        'img_view',
        'img_video',
        'text_ar',
        'text_en',
        'keyword_ar',
        'keyword_en',
        'category_id',
         'slug',
        'views_count',
        'is_featured',
    ];

    protected $casts = [
        'views_count' => 'integer',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
