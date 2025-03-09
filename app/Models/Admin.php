<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;


class Admin extends User
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        // 'roles_name',
        // 'last_activity'
    ];


    public function category()
    {
        return $this->hasMany(Category::class);
    }

    public function ad()
    {
        return $this->hasMany(Ad::class);
    }


    public function tag()
    {
        return $this->hasMany(Tag::class);
    }
}
