<?php

namespace App\Models;

use App\Models\Category;
use App\Models\PodcastEpisode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;
    
     protected $fillable = [
        'title_ar',
        'title_en',
        'img_view',
        'img_podcast',
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

    public function episodes()
    {
        return $this->hasMany(PodcastEpisode::class);
    }
}
