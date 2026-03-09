<?php

namespace App\Models;

use App\Models\Podcast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PodcastEpisode extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ar',
        'title_en',
        'date',
        'time',
        'type',
        'vedio',
        'audio',
        'img_view',
        'img_episode',
        'text_ar',
        'text_en',
        'keyword_ar',
        'keyword_en',
        'podcast_id',
         'slug',
    ];

    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }
}
