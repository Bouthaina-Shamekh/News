<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'sender_name',
        'email',
        'text',
        'nw_id',
    ];

    public function nw()
    {
        return $this->belongsTo(Nw::class);
    }
}





