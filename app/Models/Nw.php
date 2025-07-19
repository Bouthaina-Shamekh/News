<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nw extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_org',
        'title_ar',
        'title_en',
        'date',
        'type_articles',
        'vedio',
        'img_view',
        'img_article',
        'text_org',
        'text_ar',
        'text_en',
        'keyword_org',
        'keyword_ar',
        'keyword_en',
        'place_new',
        'status',
        'visit',
        'category_id',
        'new_place_id',
        'statu_id',
        'publisher_id',
        'like',
        'dislike',
        'slug'
    ];

    // Scope
    public function scopeActive($query)
    {
        return $query->where('statu_id', 2);
    }

    // Relationship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    // public function newplace()
    // {
    //     return $this->belongsTo(NewPlace::class);
    // }

    public function newplace()
{
    return $this->belongsTo(NewPlace::class, 'new_place_id');
}


    public function comment()
    {
        return $this->hasMany(Comment::class,'news_id');
    }

    public function status()
    {
        return $this->belongsTo(Statu::class,'statu_id');
    }
}
