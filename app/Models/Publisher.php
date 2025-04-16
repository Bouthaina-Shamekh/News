<?php

namespace App\Models;

use PhpParser\Node\Expr\New_;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publisher extends User
{
    use HasFactory , Notifiable;

   

    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'phone',
        'birth_of_date',
        'address',
        'about',
        'status',
        'visit',
        'attachments',
    ];

    public function article()
    {
        return $this->hasMany(Artical::class);
    }
    public function nw()
    {
        return $this->hasMany(Nw::class);
    }
}
