<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'text',
        'news_id',
        'date',
        'time',
    ];

    public function nw()
    {
        return $this->belongsTo(Nw::class,'news_id');
    }
}





