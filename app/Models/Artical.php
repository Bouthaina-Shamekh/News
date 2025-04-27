<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artical extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_ar',
        'title_en',
        'date',
        'type_articles',
        'vedio',
        'img_view',
        'img_article',
        'text_ar',
        'text_en',
        'status',
        'publisher_id',
        'category_id',
        'statu_id',
        'visit',
        'keyword_ar',
        'keyword_en',
        'like',
        'dislike',
        'slug'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function status()
    {
        return $this->belongsTo(Statu::class,'statu_id');
    }
}
