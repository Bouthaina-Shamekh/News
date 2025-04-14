<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'msg';
    public $timestamps = false;

    protected $fillable = [
        'msg',
        'subject',
        'fristname',
        'lastname',
        'email',
        'addDate',
        'placename',
        'phone'
    ];
}
