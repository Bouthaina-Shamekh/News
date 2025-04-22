<?php

namespace App\Models;

use PhpParser\Node\Expr\New_;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publisher extends User implements CanResetPassword
{
    use HasFactory , Notifiable, CanResetPasswordTrait;



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

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetPasswordNotificationCustom($token));
    }
}
