<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nw extends Model
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
        'keyword_ar',
        'keyword_en',
        'place_new',
        'status',
        'category_id',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function newplace()
    {
        return $this->belongsTo(NewPlace::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function status()
    {
        return $this->belongsTo(Statu::class);
    }
}
