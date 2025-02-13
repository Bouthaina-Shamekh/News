<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\New_;

class Publisher extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
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
